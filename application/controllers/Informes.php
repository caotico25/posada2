<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Informes extends CI_Controller
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
    
    
    function informe_partidas()
    {
        $this->load->library('m_pdf');
        $this->m_pdf->load();
        
        $data['partidas'] = $this->Partida->with('master')->with('estado')->with('juego')->with('fichas')->get_all();
        
        $html = $this->load->view('informes/informe_partidas', $data, TRUE);
        
        $mpdf =new mPDF('c', 'A4');
        
        $mpdf->SetHeader('LA POSADA DEL CAOS');
        $mpdf->SetFooter('{PAGENO}');
        $mpdf->WriteHTML($html);
        
        $mpdf->Output();
    }
    
    
    function informe_juegos()
    {
        $this->load->library('m_pdf');
        $this->m_pdf->load();
        
        $data['partidas'] = $this->Juego->get_all();
        
        $html = $this->load->view('informes/informe_juegos', $data, TRUE);
        
        $mpdf =new mPDF('c', 'A4');
        
        $mpdf->SetHeader('LA POSADA DEL CAOS');
        $mpdf->SetFooter('{PAGENO}');
        $mpdf->WriteHTML($html);
        
        $mpdf->Output();
    }
    
    
    function informe_usuarios()
    {
        $this->load->library('m_pdf');
        $this->m_pdf->load();
        
        $data['partidas'] = $this->Usuario->with('fichas')->with('posts')->with('partidas')->get_all();
        
        $html = $this->load->view('informes/informe_usuarios', $data, TRUE);
        
        $mpdf =new mPDF('c', 'A4');
        
        $mpdf->SetHeader('LA POSADA DEL CAOS');
        $mpdf->SetFooter('{PAGENO}');
        $mpdf->WriteHTML($html);
        
        $mpdf->Output();
    }
    
    
}