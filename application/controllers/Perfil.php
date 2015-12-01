<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfil extends CI_Controller
{
    
    
    function index()
    {
        $usuario = $this->session->userdata('usuario')['id'];
        // PARTIDAS EN LAS QUE EL USUARIO ES MASTER
        $data['partidas_master'] = $this->Partida->get_many_by('master', $usuario);
        
        // PARTIDAS EN LAS QUE EL USUARIO ES JUGADOR
        $fichas = $this->Ficha->get_many_by('usuario_id', $usuario);
        $partidas = array();
        
        foreach ($fichas as $ficha)
        {
            $partidas[] = $this->Partida->get($ficha['partida_id']);
        }
        
        $data['partidas_jugador'] = $partidas;
        
        $this->load->view('perfil/perfil', $data);
    }
    
    
    function cambio_passwd()
    {
        $reglas = array(
                        array(
                            'field' => 'passwd',
                            'label' => 'Contraseña',
                            'rules' => 'trim|required'
                        ),
                        array(
                            'field' => 're_passwd',
                            'label' => 'Confirmar contraseña',
                            'rules' => 'trim|required|matches[passwd]'
                        )
        );
        
        $this->form_validation->set_rules($reglas);
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['mensaje'] = '';
            $this->load->view('perfil/cambio_passwd', $data);
        }
        else
        {
            $this->Usuario->update($this->session->userdata('usuario')['id'] ,array('passwd' => md5($this->input->post('passwd'))));
            
            $data['mensaje'] = 'Cambio realizado correctamente';
            $this->load->view('perfil/cambio_passwd', $data);
        }
    }
    
    
    
    
    
    
    
    
}