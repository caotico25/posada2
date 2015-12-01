<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buscador extends CI_Controller
{
    
    /**
     *  FUNCION PRINCIPAL
     */
    function index($busca)
    {
        $this->load->model('Busca');
        $data['resultados'] = $this->Busca->buscar($busca);
        $data['busca'] = $busca;
        
        $this->load->view('portal/busca', $data);
    }
    
}