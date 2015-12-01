<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tema extends MY_Model
{
    
    public $_table = 'temas';
    public $primary_key = 'id';
    protected $return_type = 'array';
    
    public $belongs_to = array( 'seccion' => array( 'model' => 'seccion', 'primary_key' => 'seccion'));
    public $has_many = array( 'posts' => array( 'model' => 'post', 'primary_key' => 'tema' ) );
    
}