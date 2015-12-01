<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seccion extends MY_Model
{
    
    public $_table = 'secciones';
    public $primary_key = 'id';
    protected $return_type = 'array';
    
    public $has_many = array( 'temas' => array( 'model' => 'tema', 'primary_key' => 'seccion' ) );
    
}