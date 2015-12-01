<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_panel extends CI_Controller
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
     *  FUNCION PRINCIPAL DE LA CLASE.
     */
    function index()
    {
        
        $this->load->view('admin/panel');
    }
    
    
    
    
    
    
    
    
    
    
    
}