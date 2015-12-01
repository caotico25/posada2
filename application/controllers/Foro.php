<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Foro extends CI_Controller
{
    
    /**
     *  CONSTRUCTOR DE LA CLASE
     * 
     *  Controla si el usuario está logueado. Si no lo está se redirige a inicio
     */
    function __construct()
    {
        parent::__construct();
    }
    
    
    /**
     *  MUESTRA LAS SECCIONES CON SUS DIFERENTES TEMAS
     */
    function index()
    {
        $data['secciones'] = $this->Seccion->with('temas')->get_all();
        
        $this->load->view('foro/foro',$data);
    }
    
    
    /**
     *  MUESTRA EL TEMA INDICADO CON SUS DIFERENTES POSTS
     */
    function tema($id_tema)
    {
        $data['tema'] = $this->Tema->with('seccion')->get($id_tema);
        $data['posts'] = $this->Post->with('autor')->with('comentarios')->get_many_by('tema', $id_tema);
        
        $this->load->view('foro/tema',$data);
    }
    
    
    /**
     *  MUESTRA EL POST INDICADO CON SUS COMENTARIOS
     */
    function post($id_post)
    {
        $data['post'] = $this->Post->with('tema')->with('autor')->get($id_post);
        $data['comentarios'] = $this->Comentario->with('autor')->get_many_by('post', $id_post);
        
        $this->load->view('foro/post',$data);
    }
    
    
    /**
     *  ADMINSITRACION DE SECCIONES
     */
    function administrar_secciones()
    {
        $data['secciones'] = $this->Seccion->get_all();
        
        $this->load->view('foro/secciones/secciones',$data);
    }
    
    
    /**
     *  ABRE LA VISTA PARA CREAR UNA SECCION
     */
    function nueva_seccion()
    {
        $this->load->view('foro/secciones/alta');
    }

    
    /**
     * ALTA DE SECCION
     */
    function alta_seccion()
    {
        $reglas = array(
                        array(
                            'field' => 'titulo',
                            'label' => 'Título',
                            'rules' => 'trim|required'
                        ),
                        array(
                            'field' => 'descripcion',
                            'label' => 'Descripcion',
                            'rules' => 'trim|required'
                        )
                        
                    );
        
        $this->form_validation->set_rules($reglas);
        
        if ($this->form_validation->run() == FALSE)
        {
            echo json_encode("no");
        }
        else
        {
            $datos = array(
                        'titulo' => $this->input->post('titulo'),
                        'descripcion' => $this->input->post('descripcion')
                        );
                        
            $this->Seccion->insert($datos);
            
            $this->session->set_flashdata('correcto', array('titulo' => 'Correcto', 'cuerpo' => 'Sección creada correctamente.'));
            
            echo json_encode("si");
        }
    }


    /**
     *  CARGA LA VISTA PARA EDITAR LA SECCION INDICADA
     */
    function editar_seccion($id_seccion)
    {
        $data['seccion'] = $this->Seccion->get($id_seccion);
        
        $this->load->view('foro/secciones/editar',$data);
    }
    
    
    /**
     *  EDITA LA SECCION INDICADA
     */
    function edit_seccion($id_seccion)
    {
        $reglas = array(
                        array(
                            'field' => 'titulo',
                            'label' => 'Título',
                            'rules' => 'trim|required'
                        ),
                        array(
                            'field' => 'descripcion',
                            'label' => 'Descripcion',
                            'rules' => 'trim|required'
                        )
                        
                    );
        
        $this->form_validation->set_rules($reglas);
        
        if ($this->form_validation->run() == FALSE)
        {
            echo json_encode("no");
        }
        else
        {
            $datos = array(
                        'titulo' => $this->input->post('titulo'),
                        'descripcion' => $this->input->post('descripcion')
                        );
                        
            $this->Seccion->update($id_seccion, $datos);
            
            $this->session->set_flashdata('correcto', array('titulo' => 'Correcto', 'cuerpo' => 'Sección editada correctamente.'));
            
            echo json_encode("si");
        }
    }
    
    
    /**
     *  ELIMINA LA SECCION INDICADA
     */
    function eliminar_seccion($id_seccion)
    {
        $temas = $this->Tema->with('posts')->get_many_by('seccion', $id_seccion);
        
        foreach ($temas as $tema)
        {
            foreach ($tema['posts'] as $post)
            {
                $comentarios = $this->Comentario->delete_by('post', $post['id']);
                
                $this->Post->delete($post['id']);
            }

            $this->Tema->delete($tema['id']);
        }
        
        $this->Seccion->delete($id_seccion);
        
        $this->session->set_flashdata('correcto', array('titulo' => 'Correcto', 'cuerpo' => 'Sección eliminada correctamente.'));
        
        redirect('foro/administrar_secciones');
    }
    
    
    /**
     *  ADMINSITRACION DE TEMAS
     */
    function administrar_temas()
    {
        $data['temas'] = $this->Tema->with('seccion')->get_all();
        
        $this->load->view('foro/temas/temas',$data);
    }
    
    
    /**
     *  ABRE LA VISTA PARA CREAR UN TEMA
     */
    function nuevo_tema()
    {
        $data['secciones'] = $this->Seccion->get_all();
        
        $this->load->view('foro/temas/alta', $data);
    }

    
    /**
     * ALTA DE TEMA
     */
    function alta_tema()
    {
        $reglas = array(
                        array(
                            'field' => 'titulo',
                            'label' => 'Título',
                            'rules' => 'trim|required'
                        ),
                        array(
                            'field' => 'descripcion',
                            'label' => 'Descripcion',
                            'rules' => 'trim|required'
                        ),
                        array(
                            'field' => 'seccion',
                            'label' => 'Sección',
                            'rules' => 'required'
                        )
                    );
        
        $this->form_validation->set_rules($reglas);
        
        if ($this->form_validation->run() == FALSE)
        {
            echo json_encode("no");
        }
        else
        {
            $datos = array(
                        'titulo' => $this->input->post('titulo'),
                        'descripcion' => $this->input->post('descripcion'),
                        'seccion' => $this->input->post('seccion')
                        );
                        
            $this->Tema->insert($datos);
            
            $this->session->set_flashdata('correcto', array('titulo' => 'Correcto', 'cuerpo' => 'Tema creado correctamente.'));
            
            echo json_encode("si");
        }
    }


    /**
     *  CARGA LA VISTA PARA EDITAR EL TEMA INDICADO
     */
    function editar_tema($id_tema)
    {
        $data['tema'] = $this->Tema->get($id_tema);
        $data['secciones'] = $this->Seccion->get_all();
        
        $this->load->view('foro/temas/editar',$data);
    }
    
    
    /**
     *  EDITA EL TEMA INDICADO
     */
    function edit_tema($id_tema)
    {
        $reglas = array(
                        array(
                            'field' => 'titulo',
                            'label' => 'Título',
                            'rules' => 'trim|required'
                        ),
                        array(
                            'field' => 'descripcion',
                            'label' => 'Descripcion',
                            'rules' => 'trim|required'
                        ),
                        array(
                            'field' => 'seccion',
                            'label' => 'Sección',
                            'rules' => 'required'
                        )
                        
                    );
        
        $this->form_validation->set_rules($reglas);
        
        if ($this->form_validation->run() == FALSE)
        {
            echo json_encode("no");
        }
        else
        {
            $datos = array(
                        'titulo' => $this->input->post('titulo'),
                        'descripcion' => $this->input->post('descripcion'),
                        'seccion' => $this->input->post('seccion')
                        );
                        
            $this->Tema->update($id_tema, $datos);
            
            $this->session->set_flashdata('correcto', array('titulo' => 'Correcto', 'cuerpo' => 'Tema editado correctamente.'));
            
            echo json_encode("si");
        }
    }
    
    
    /**
     *  ELIMINA EL TEMA INDICADO
     */
    function eliminar_tema($id_tema)
    {
        $posts = $this->Post->with('comentarios')->get_many_by('tema', $id_tema);
        
        foreach ($posts as $post)
        {
            $this->Comentario->delete_by('post', $post['id']);
            
            $this->Post->delete($post['id']);
        }
        
        $this->Tema->delete($id_tema);
        
        $this->session->set_flashdata('correcto', array('titulo' => 'Correcto', 'cuerpo' => 'Tema eliminado correctamente.'));
        
        redirect('foro/administrar_temas');
    }
    
    
    /**
     *  ADMINSITRACION DE POSTS
     */
    function administrar_posts()
    {
        $data['posts'] = $this->Post->with('tema')->with('autor')->with('comentarios')->get_all();
        
        $this->load->view('foro/posts/posts',$data);
    }
    
    
    /**
     *  MUESTRA LA VISTA DE CREACION DE NUEVO POST PARA EL TEMA INDICADO
     */
    function nuevo_post($id_tema)
    {
        $data['tema'] = $this->Tema->get($id_tema);
        
        $this->load->view('foro/posts/alta',$data);
    }
    
    
    /**
     *  CREA UN NUEVO POST
     */
    function alta_post()
    {
        $reglas = array(
                        array(
                            'field' => 'titulo',
                            'label' => 'Título',
                            'rules' => 'trim|required'
                        ),
                        array(
                            'field' => 'descripcion',
                            'label' => 'Descripcion',
                            'rules' => 'trim|required'
                        )
                    );
        
        $this->form_validation->set_rules($reglas);
        
        if ($this->form_validation->run() == FALSE)
        {
            echo json_encode("no");
        }
        else
        {
            $datos = array(
                        'titulo' => $this->input->post('titulo'),
                        'contenido' => $this->input->post('descripcion'),
                        'tema' => $this->input->post('tema'),
                        'autor' => $this->session->userdata('usuario')['id']
                        );
                        
            $this->Post->insert($datos);
            
            $this->session->set_flashdata('correcto', array('titulo' => 'Correcto', 'cuerpo' => 'Post creado correctamente.'));
            
            echo json_encode("si");
        }
    }


    /**
     *  CARGA LA VISTA PARA EDITAR EL TEMA INDICADO
     */
    function editar_post($id_post)
    {
        $data['post'] = $this->Post->get($id_post);
        
        $this->load->view('foro/posts/editar',$data);
    }
    
    
    /**
     *  EDITA EL TEMA INDICADO
     */
    function edit_post($id_post)
    {
        $reglas = array(
                        array(
                            'field' => 'titulo',
                            'label' => 'Título',
                            'rules' => 'trim|required'
                        ),
                        array(
                            'field' => 'descripcion',
                            'label' => 'Descripcion',
                            'rules' => 'trim|required'
                        )
                    );
        
        $this->form_validation->set_rules($reglas);
        
        if ($this->form_validation->run() == FALSE)
        {
            echo json_encode("no");
        }
        else
        {
            $datos = array(
                        'titulo' => $this->input->post('titulo'),
                        'contenido' => $this->input->post('descripcion')
                        );
                        
            $this->Post->update($id_post, $datos);
            
            $this->session->set_flashdata('correcto', array('titulo' => 'Correcto', 'cuerpo' => 'Post editado correctamente.'));
            
            echo json_encode("si");
        }
    }
    
    
    /**
     *  ELIMINA EL POST INDICADO
     */
    function eliminar_post($id_post)
    {
        $comentarios = $this->Comentario->delete_by('post', $id_post);
        
        $this->Post->delete($id_post);
        
        $this->session->set_flashdata('correcto', array('titulo' => 'Correcto', 'cuerpo' => 'Tema eliminado correctamente.'));
        
        redirect('foro/administrar_temas');
    }
    
    
    /**
     * 
     */
    function nuevo_comentario()
    {
        $datos = array(
                    'contenido' => $this->input->post('mensaje'),
                    'post' => $this->input->post('post'),
                    'autor' => $this->session->userdata('usuario')['id']
                    );
                    
        $this->Comentario->insert($datos);
        
        $this->session->set_flashdata('correcto', array('titulo' => 'Correcto', 'cuerpo' => 'Comentario creado correctamente.'));
        
        echo json_encode("si");
    }
    
    
    
    
    
    
    
    
    
    
    
}