<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticias extends CI_Controller
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
     * 
     */
    function index($pagina = 1)
    {
        // CONFIGURACION DE  PAGINACION
        $elementos = $this->Noticia->count_all();
        $fpp = 5;
        
        $config['base_url'] = base_url('noticias/index');
        $config['uri_segment'] = 3;
        $config['total_rows'] = $elementos;
        $config['per_page'] = $fpp;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $elementos;
        
        $config['next_link'] = 'Siguiente';
        $config['prev_link'] = "Anterior";
        
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';            
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        
        $data['noticias'] = $this->Noticia->with('usuario')->limit($fpp, $pagina - 1)->get_all();
        
        $this->load->view('noticias/ver_noticias',$data);
    }
    
    
    /**
     * 
     */
    function administrar_noticias()
    {
        if (es_admin())
        {
            $data['noticias'] = $this->Noticia->with('usuario')->get_all();
            
            $this->load->view('noticias/noticias',$data);
        }
        else
        {
            $this->session->set_flashdata('acceso_denegado', array('titulo' => 'Acceso denegado', 'cuerpo' => 'Ha intentado acceder a una zona restringida.'));
            
            redirect('inicio');
        }
    }
    
    
    /**
     *  
     */
    function alta()
    {
        if (es_admin())
        {
            $this->load->view('noticias/alta');
        }
        else
        {
            $this->session->set_flashdata('acceso_denegado', array('titulo' => 'Acceso denegado', 'cuerpo' => 'Ha intentado acceder a una zona restringida.'));
            
            redirect('inicio');
        }
    }
    
    
    /**
     * REGISTRO DE NUEVO USUARIO POR ADMIN
     */
    function nueva_noticia()
    {
        $reglas = array(
                        array(
                            'field' => 'titulo',
                            'label' => 'Título',
                            'rules' => 'trim|required'
                        ),
                        array(
                            'field' => 'contenido',
                            'label' => 'Contenido',
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
                        'contenido' => $this->input->post('contenido'),
                        'autor' => $this->session->userdata('usuario')['id']
                        );
                        
            $this->Noticia->insert($datos);
            
            $this->session->set_flashdata('correcto', array('titulo' => 'Correcto', 'cuerpo' => 'Noticia creada correctamente.'));
            
            echo json_encode("si");
        }
    }
    
    
    /**
     * 
     */
    function editar($id_noticia)
    {
        if (es_admin())
        {
            $data['noticia'] = $this->Noticia->get($id_noticia);
        
            $this->load->view('noticias/editar',$data);
        }
        else
        {
            $this->session->set_flashdata('acceso_denegado', array('titulo' => 'Acceso denegado', 'cuerpo' => 'Ha intentado acceder a una zona restringida.'));
            
            redirect('inicio');
        }
        
    }


    /**
     * 
     */
    function editar_noticia($id_noticia)
    {
        $reglas = array(
                        array(
                            'field' => 'titulo',
                            'label' => 'Título',
                            'rules' => 'trim|required'
                        ),
                        array(
                            'field' => 'contenido',
                            'label' => 'Contenido',
                            'rules' => 'trim|required'
                        )
                        
                    );
        
        $this->form_validation->set_rules($reglas);
        
        if ($this->form_validation->run() == FALSE)
        {
            echo json_encode(validation_errors());
        }
        else
        {
            $datos = array(
                        'titulo' => $this->input->post('titulo'),
                        'contenido' => $this->input->post('contenido')
                        );
                        
            $this->Noticia->update($id_noticia, $datos);
            
            $this->session->set_flashdata('correcto', array('titulo' => 'Correcto', 'cuerpo' => 'Noticia ediatada correctamente.'));
            
            echo json_encode("si");
        }
    }


    /**
     *  ELIMINA LA NOTICIA INDICADA
     */
    function eliminar($id_noticia)
    {
        if (es_admin())
        {
            $this->Noticia->delete($id_noticia);
            
            //$this->Usuario->update($id_usuario, array('deletedd_at' => date('Y-m-d H:i:s')));
            $this->session->set_flashdata('correcto', array('titulo' => 'Correcto', 'cuerpo' => 'Noticia eliminada correctamente.'));
            
            redirect('noticias/administrar_noticias');
        }
        else
        {
            $this->session->set_flashdata('acceso_denegado', array('titulo' => 'Acceso denegado', 'cuerpo' => 'Ha intentado acceder a una zona restringida.'));
            
            redirect('inicio');
        }
    }
    
    
    
    
    
    
    
    
    
}