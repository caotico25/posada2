<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends MY_Model
{
    
    public $_table = 'chat';
    public $primary_key = 'id';
    protected $return_type = 'array';
    
    public $belongs_to = array( 'usuario' => array( 'model' => 'usuario', 'primary_key' => 'jugador'),
                                'partida' => array( 'model' => 'partida', 'primary_key' => 'partida')
                                );
    
}