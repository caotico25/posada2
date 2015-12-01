<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticia extends MY_Model
{
    
    public $_table = 'noticias';
    public $primary_key = 'id';
    protected $return_type = 'array';
    protected $soft_delete = TRUE;
    
    public $before_create = array('create_timestamps');
    public $before_update = array('update_timestamps');
    public $before_delete = array('delete_timestamps');
    
    public $belongs_to = array( 'usuario' => array( 'model' => 'usuario', 'primary_key' => 'autor'));
    
    
    protected function create_timestamps($noticia)
    {
        $noticia['created_at'] = $noticia['updated_at'] = date('Y-m-d H:i:s');
        
        return $noticia;
    }
    
    
    protected function update_timestamps($noticia)
    {
        $noticia['updated_at'] = date('Y-m-d H:i:s');
        
        return $noticia;
    }
    
    
    protected function delete_timestamps($noticia)
    {
        $noticia['deleted_at'] = date('Y-m-d H:i:s');
        
        return $noticia;
    }
    
}