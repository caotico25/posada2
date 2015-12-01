<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
    
    /**
     *  CONSTRUCTOR DE LA CLASE
     * 
     *  Controla si el usuario está logueado. Si no lo está se redirige a inicio
     */
    function __construct()
    {
        parent::__construct();
        
        if (! logueado() || ! es_admin())
        {
            $this->session->set_flashdata('acceso_denegado', array('titulo' => 'Acceso denegado', 'cuerpo' => 'Ha intentado acceder a una zona restringida.'));
            
            redirect('inicio');
        }
    }
    
    
    /**
     * 
     */
    function index()
    {
        $data['usuarios'] = $this->Usuario->with_deleted()->get_all();
        
        $this->load->view('usuarios/usuarios',$data);
    }
    
    
    /**
     *  
     */
    function alta()
    {
        $this->load->view('usuarios/alta');
    }
    
    
    /**
     * REGISTRO DE NUEVO USUARIO POR ADMIN
     */
    function nuevo_usuario()
    {
        $reglas = array(
                        array(
                            'field' => 'usuario',
                            'label' => 'Usuario',
                            'rules' => 'trim|required'
                        ),
                        array(
                            'field' => 'email',
                            'label' => 'Email',
                            'rules' => 'trim|required|valid_email'
                        ),
                        array(
                            'field' => 'passwd',
                            'label' => 'Contraseña',
                            'rules' => 'trim|required'
                        ),
                        array(
                            'field' => 're_passwd',
                            'label' => 'Repetir contraseña',
                            'rules' => 'trim|required|matches[passwd]'
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
                        'usuario' => $this->input->post('usuario'),
                        'email' => $this->input->post('email'),
                        'passwd' => md5($this->input->post('passwd')),
                        'admin' => $this->input->post('admin') == "t" ? 'TRUE' : 'FALSE'
                        );
                        
            $this->Usuario->insert($datos);
            
            $this->session->set_flashdata('correcto', array('titulo' => 'Correcto', 'cuerpo' => 'Usuario creado correctamente.'));
            
            echo json_encode("si");
        }
    }
    
    
    /**
     * 
     */
    function editar($id_usuario)
    {
        $data['usuario'] = $this->Usuario->with_deleted()->get($id_usuario);
        
        $this->load->view('usuarios/editar',$data);
    }


    /**
     * 
     */
    function editar_usuario($id_usuario)
    {
        $reglas = array(
                        array(
                            'field' => 'usuario',
                            'label' => 'Usuario',
                            'rules' => 'trim|required'
                        ),
                        array(
                            'field' => 'email',
                            'label' => 'Email',
                            'rules' => 'trim|required|valid_email'
                        ),
                        array(
                            'field' => 'passwd',
                            'label' => 'Contraseña',
                            'rules' => 'trim'
                        ),
                        array(
                            'field' => 're_passwd',
                            'label' => 'Repetir contraseña',
                            'rules' => 'trim'
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
                        'usuario' => $this->input->post('usuario'),
                        'email' => $this->input->post('email'),
                        'admin' => $this->input->post('admin') == "t" ? 'TRUE' : 'FALSE'
                        );
                        
            if ($this->input->post('passwd'))
            {
                $datos['passwd'] = md5($this->input->post('passwd'));
            }
                        
            $this->Usuario->update($id_usuario,$datos);
            
            echo json_encode("si");
        }
    }


    /**
     *  ELIMINA EL USUARIO INDICADO
     */
    function eliminar($id_usuario)
    {
        $this->Usuario->delete($id_usuario);
        
        $this->Usuario->update($id_usuario, array('deletedd_at' => date('Y-m-d H:i:s')));
        
        $this->session->set_flashdata('correcto', array('titulo' => 'Correcto', 'cuerpo' => 'Usuario eliminado correctamente.'));
        
        redirect('usuarios');
    }
    
}