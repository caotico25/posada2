<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ficha extends MY_Model
{
    
    public $_table = 'fichas';
    public $primary_key = 'id';
    protected $return_type = 'array';
    protected $soft_delete = TRUE;
    
    public $belongs_to = array( 'jugador' => array( 'model' => 'usuario', 'primary_key' => 'usuario_id'),
                                'partida' => array( 'model' => 'partida', 'primary_key' => 'partida_id')
                                );
    
    
    /**
     *  OBTIENE LOS DATOS DEL USUARIO DE LA TABLA INDICADA
     */
    function obtener_datos($tabla, $ficha)
    {
        $res = $this->db->query("select * from " . $tabla . " where ficha = $ficha");
        $res = $res->row_array();
        
        return $res;
    }
    
    
    /**
     *  INSERTA NUEVO DATO EN TABLA CUANDO NO EXISTE
     */
    function insertar_dato($tabla, $datos)
    {
        $this->db->insert($tabla,$datos);
    }
    
    
    /**
     *  ACTUALIZA UN DATO EN TABLA INDICADA
     */
    function actualizar_dato($tabla, $fila, $datos)
    {
        $this->db->where('id',$fila);
        $this->db->update($tabla,$datos);
    }
    
    
    
    
    
    
    
    
    
    
}