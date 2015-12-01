<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller
{
    
    /**
     *  FUNCION PRINCIPAL
     */
    function index()
    {
        $data['noticias'] = $this->Noticia->with('usuario')->limit(5)->get_all();
        $data['posts'] = $this->Post->with('autor')->with('tema')->limit(5)->get_all();
        $data['partidas'] = $this->Partida->limit(5)->get_all();
        
        $this->load->view('portal/inicio', $data);
    }
    
}