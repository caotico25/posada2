<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends MY_Model
{
    
    public $_table = 'posts';
    public $primary_key = 'id';
    protected $return_type = 'array';
    
    public $belongs_to = array( 'tema' => array( 'model' => 'tema', 'primary_key' => 'tema'),
                                'autor' => array( 'model' => 'usuario', 'primary_key' => 'autor')
                                );
                                
    public $has_many = array( 'comentarios' => array( 'model' => 'comentario', 'primary_key' => 'post' ) );
    
}