<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tabla extends MY_Model
{
    
    public $_table = 'tablas';
    public $primary_key = 'id';
    protected $return_type = 'array';
    
    public $belongs_to = array( 'juego' => array( 'model' => 'juego', 'primary_key' => 'juego') );
    
}