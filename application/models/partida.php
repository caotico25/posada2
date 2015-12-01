<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partida extends MY_Model
{
    
    public $_table = 'partidas';
    public $primary_key = 'id';
    protected $return_type = 'array';
    protected $soft_delete = TRUE;
    
    public $before_create = array('create_timestamps');
    public $before_update = array('update_timestamps');
    //public $before_delete = array('delete_timestamps');
    
    public $belongs_to = array( 'master' => array( 'model' => 'usuario', 'primary_key' => 'master'),
                                'estado' => array( 'model' => 'estado', 'primary_key' => 'estado'),
                                'juego' => array( 'model' => 'juego', 'primary_key' => 'juego')
                                );
                                
    public $has_many = array( 'fichas' => array( 'model' => 'ficha', 'primary_key' => 'partida_id' ) );
    
    
    protected function create_timestamps($partida)
    {
        $partida['created_at'] = $partida['updated_at'] = $partida['deleted_at'] = date('Y-m-d H:i:s');
        
        return $partida;
    }
    
    
    protected function update_timestamps($partida)
    {
        $partida['updated_at'] = date('Y-m-d H:i:s');
        
        return $partida;
    }
    
    
    protected function delete_timestamps($partida)
    {
        $partida['deleted_at'] = date('Y-m-d H:i:s');
        
        return $partida;
    }
    
}