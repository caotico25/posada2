<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Juego extends MY_Model
{
    
    public $_table = 'juegos';
    public $primary_key = 'id';
    protected $return_type = 'array';
    protected $soft_delete = TRUE;
    
    
}