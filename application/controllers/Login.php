<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    
    
    function index()
    {
        $this->load->view('portal/login');
    }
    
    
    function acceso()
    {
        $usuario = $this->input->post('usuario');
        $reglas = array(
                        array(
                            'field' => 'usuario',
                            'label' => 'Usuario',
                            'rules' => 'trim|required|callback__usuario_existe'
                        ),
                        array(
                            'field' => 'passwd',
                            'label' => 'Contraseña',
                            'rules' => 'trim|required|callback__pass_valido[' . $usuario. ']'
                        )
                    );
        
        $this->form_validation->set_rules($reglas);
        
        if ($this->form_validation->run() == FALSE)
        {
            echo json_encode(validation_errors());
        }
        else
        {
            $usuario = $this->Usuario->get_by('usuario', $this->input->post('usuario'));
            $this->session->set_userdata('usuario', $usuario);
            
            echo "ok";
        }
    }
    
    
    /**
     *  COMPRUEBA SI EL USUARIO EXISTE EN LA BASE DE DATOS
     */
    function _usuario_existe($usuario)
    {
        $existe = $this->Usuario->count_by('usuario', $usuario);
        
        if ($existe == 0)
        {
            $this->form_validation->set_message('_usuario_existe', 'Usuario no válido.');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    
    
    /**
     *  COMPRUEBA SI LA CONTRASEÑA ES CORRECTA
     */
    function _pass_valido($pass, $user)
    {
        $usuario = $this->Usuario->get_by('usuario', $user);
        
        if ($usuario['passwd'] == md5($pass))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('_pass_valido','Contraseña incorrecta.');
            return FALSE;
        }
    }
    
    
    /**
     *  TERMINA LA SESION DEL USUARIO
     */
    function logout()
    {
        $this->session->sess_destroy();
        redirect('inicio');
    }
    
    
    /**
     *  REGISTRO DE NUEVO USUARIO
     */
    function registrar()
    {
        $reglas = array(
                        array(
                            'field' => 'usuario',
                            'label' => 'Usuario',
                            'rules' => 'trim|required|is_unique[usuarios.usuario]'
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
                        ),
                        
                    );
        
        $this->form_validation->set_rules($reglas);
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('portal/registro');
        }
        else
        {
            $datos = array(
                        'usuario' => $this->input->post('usuario'),
                        'email' => $this->input->post('email'),
                        'passwd' => md5($this->input->post('passwd'))
                        );
            
            $id_usuario = $this->Usuario->insert($datos);
            
            $usuario = $this->Usuario->get($id_usuario);
            $this->session->set_userdata('usuario', $usuario);
            
            redirect('inicio');
        }
        
        
    }
    
    
    
    
    
    
    
}