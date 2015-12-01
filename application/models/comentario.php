<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comentario extends MY_Model
{
    
    public $_table = 'comentarios';
    public $primary_key = 'id';
    protected $return_type = 'array';
    
    public $belongs_to = array( 'post' => array( 'model' => 'post', 'primary_key' => 'post'),
                                'autor' => array( 'model' => 'usuario', 'primary_key' => 'autor')
                                );
    
}