<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends MY_Model
{
    
    public $_table = 'usuarios';
    public $primary_key = 'id';
    protected $return_type = 'array';
    protected $soft_delete = TRUE;
    
    public $before_create = array('create_timestamps');
    public $before_update = array('update_timestamps');
    //public $before_delete = array('delete_timestamps'); // DA PROBLEMAS Y NO SE POR QUE
                                
    public $has_many = array( 'fichas' => array( 'model' => 'ficha', 'primary_key' => 'usuario_id' ),
                              'noticias' => array( 'model' => 'noticia', 'primary_key' => 'autor' ),
                              'posts' => array( 'model' => 'post', 'primary_key' => 'autor' ),
                              'comentarios' => array( 'model' => 'comentario', 'primary_key' =>'autor' ),
                              'mensajes' => array( 'model' => 'chat', 'primary_key' => 'jugador' ),
                              'partidas' => array( 'model' => 'partida', 'primary_key' => 'master' ));
    
    
    protected function create_timestamps($usuario)
    {
        $usuario['created_at'] = $usuario['updated_at'] = date('Y-m-d H:i:s');
        
        return $usuario;
    }
    
    
    protected function update_timestamps($usuario)
    {
        $usuario['updated_at'] = date('Y-m-d H:i:s');
        
        return $usuario;
    }
    
    
    protected function delete_timestamps($usuario)
    {
        $usuario['deleted_at'] = date('Y-m-d H:i:s');
        
        return $usuario;
    }
    
}