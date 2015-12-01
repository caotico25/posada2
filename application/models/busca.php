<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Busca extends CI_Model
{
    
    function buscar($buscar)
    {
        $resultados = array();
        
        $res = $this->db->query("select * from posts where titulo like '%" . $buscar . "%' or contenido like '%" . $buscar . "%'");
        $res = $res->result_array();
        
        foreach ($res as $fila)
        {
            $resultados[] = array(
                                    'titulo' => $fila['titulo'],
                                    'url' => 'foro/' . $fila['tema'] . '/' . $fila['id'],
                                    'tipo' => 'post'
                                );
        }
        
        $res = $this->db->query("select * from partidas where nombre like '%" . $buscar . "%' or descripcion like '%" . $buscar . "%'");
        $res = $res->result_array();
        
        foreach ($res as $fila)
        {
            $resultados[] = array(
                                    'titulo' => $fila['nombre'],
                                    'url' => 'partidas',
                                    'tipo' => 'partida'
                                );
        }
        
        $res = $this->db->query("select * from noticias where titulo like '%" . $buscar . "%' or contenido like '%" . $buscar . "%'");
        $res = $res->result_array();
        
        foreach ($res as $fila)
        {
            $resultados[] = array(
                                    'titulo' => $fila['titulo'],
                                    'url' => 'noticias',
                                    'tipo' => 'noticia'
                                );
        }
        
        return $resultados;
    }
    
}