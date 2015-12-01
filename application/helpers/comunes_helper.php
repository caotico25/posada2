<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *  --------------------------
 *  FUNCIONES SOBRE EL USUARIO
 *  --------------------------
 */


/**
 *  COMPRUEBA SI EL USUARIO ACTUAL ESTA LOGUEADO
 */
if (!function_exists('logueado'))
{
    function logueado()
    {
        $CI =& get_instance();
        
        return $CI->session->userdata('usuario') != FALSE;
    }
}

/**
 *  COMPRUEBA SI EL USUARIO ACTUAL ES ADMINISTRADOR
 */
if (!function_exists('es_admin'))
{
    function es_admin()
    {
        $CI =& get_instance();
        
        return $CI->session->userdata('usuario')['admin'] == 't';
    }
}

/**
 *  OBTIENE EL NOMBRE DEL USUARIO
 */
if (!function_exists('nombre'))
{
    function nombre($id_usuario)
    {
        $CI =& get_instance();
        
        $usuario = $CI->Usuario->get($id_usuario);
        
        return $usuario['usuario'];
    }
}


/*
 *  --------------------------
 *  FUNCIONES SOBRE LA PARTIDA
 *  --------------------------
 */

// OBTIENE EL ESTADO DE LA PARTIDA
if (!function_exists('estado_partida'))
{
    function estado_partida($id_estado)
    {
        $CI =& get_instance();
        
        $estado = $CI->Estado->get($id_estado);
        
        return $estado['estado'];
    }
}

// DEVUELVE TRUE SI EL USUARIO PARTICIPA EN LA PARTIDA
if (!function_exists('participa'))
{
    function participa($id_usuario, $id_partida)
    {
        $CI =& get_instance();
        
        $partida = $CI->Partida->get($id_partida);
        $ficha = $CI->Ficha->get_many_by(array('usuario_id' => $id_usuario, 'partida_id' => $id_partida));
        
        return $partida['master'] == $id_usuario || $ficha != null;
    }
}



// DEVUELVE TRUE SI EL USUARIO ES MASTER EN LA PARTIDA
if (!function_exists('es_master'))
{
    function es_master($id_usuario, $id_partida)
    {
        $CI =& get_instance();
        
        $partida = $CI->Partida->get($id_partida);
        
        return $partida['master'] == $id_usuario;
    }
}



/*
 *      ----------------------------
 *      FUNCIONES SOBRE LAS NOTICIAS
 *      ----------------------------
 */





/*
 *      -----------------------
 *      FUNCIONES SOBRE EL FORO
 *      -----------------------
 */





// Fin de comunes_helper
?>