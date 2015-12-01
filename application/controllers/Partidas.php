<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partidas extends CI_Controller
{
    
    /**
     *  CONSTRUCTOR DE LA CLASE
     * 
     *  Controla si el usuario está logueado. Si no lo está se redirige a inicio
     */
    function __construct()
    {
        parent::__construct();
    }
    
    
    /**
     *  MUESTRA LA VISTA CON LA LISTA DE PARTIDAS CREADAS
     */
    function index()
    {
        $data['partidas'] = $this->Partida->get_all();
        
        $this->load->view('partidas/partidas',$data);
    }


    /**
     * 
     */
    function nueva_partida()
    {
        // SI EL USUARIO NO ESTÁ LOGUEADO, REDIRIGE A INICIO
        if (! logueado())
        {
            $this->session->set_flashdata('acceso_denegado', array('titulo' => 'No estás logueado', 'cuerpo' => 'Haz loguin o regístrate para crear una partida.'));
            
            redirect('inicio');
        }
        else
        {
            $data['juegos'] = $this->Juego->get_all();
            $data['estados'] = $this->Estado->get_all();
            $data['usuarios'] = $this->Usuario->get_all();
            
            $this->load->view('partidas/alta_partida',$data);
        }
    }
    
    
    /**
     * 
     */
    function alta_partida()
    {
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        $formato = $this->input->post('formato');
        $estado = $this->input->post('estado');
        $jugadores = $this->input->post('jugadores');
        
        $master = $this->session->userdata('usuario')['id'];
        
        $datos_partida = array(
                                'nombre' => $nombre,
                                'descripcion' => $descripcion,
                                'master' => $master,
                                'tipo_juego' => $formato,
                                'estado' => $estado
                            );
        
        $id_partida = $this->Partida->insert($datos_partida);
        
        if ($jugadores != '')
        {
            foreach ($jugadores as $jugador)
            {
                $datos_ficha = array(
                                        'usuario_id' => $jugador,
                                        'partida_id' => $id_partida
                                    );
                
                $this->Ficha->insert($datos_ficha);
                
                // ADEMÁS, PARA INFORMAR A LOS DEMÁS PARTICIPANTES, AÑADIMOS MENSAJE INFORMANDO DE QUE SE UNE A LA PARTIDA
                $usuario = $this->Usuario->get($jugador);
                $mensaje = array(
                                    'jugador' => $jugador,
                                    'partida' => $id_partida,
                                    'mensaje' => $usuario['usuario'] . ' se ha unido a la partida.'
                                );
                                
                $this->Chat->insert($mensaje);
            }
        }
        
        echo json_encode($id_partida);
    }
    
    
    /**
     *  INICIA LA PARTIDA. CAMBIAR NOMBRE DE FUNCION POR JUGAR
     */
    function iniciar($id_partida)
    {
        // PRIMERO ACTIVAMOS LA PARTIDA
        $this->Partida->update($id_partida, array('activa' => 't'));
        
        // OBTENEMOS LA CONVERSACION DEL CHAT
        $chat = $this->Chat->with('usuario')->get_many_by('partida', $id_partida);
        $data['mensajes'] = $chat;
        $vista_chat = $this->load->view('partidas/chat',$data,TRUE);
        
        $partida = $this->Partida->get($id_partida);
        $juego = $this->Juego->get($partida['tipo_juego']);
        
        // OBTENEMOS LAS TABLAS CORRESPONDIENTES AL JUEGO
        $tablas = $this->Tabla->get_many_by('juego', $juego['id']);
        
        $this->load->dbforge();
        
        $datos_tablas = array();
        // POR CADA TABLA OBTENEMOS SUS CAMPOS Y TIPOS
        foreach ($tablas as $tabla)
        {
            $datos = $this->db->field_data($tabla['tabla']);
            
            $datos_tablas[$tabla['tabla']] = $datos;
        }
        
        $datos_ficha = array();
        $ficha = '';
        // SI EL USUARIO NO ES MASTER, OBTENEMOS SUS DATOS DE LA FICHA
        if ($partida['master'] != $this->session->userdata('usuario')['id'])
        {
            $ficha = $this->Ficha->get_by(array('usuario_id' => $this->session->userdata('usuario')['id'], 'partida_id' => $id_partida));
            foreach ($tablas as $tabla)
            {
                $datos = $this->Ficha->obtener_datos($tabla['tabla'], $ficha['id']);
                
                $datos_ficha[] = array($tabla['tabla'] => $datos);
            }
        }
        
        $data['datos_tablas'] = $datos_tablas;
        $data['partida'] = $partida;
        $data['chat'] = $vista_chat;
        
        if ($ficha == '')
        {
            $data['ficha_usuario'] = '';
        }
        else
        {
            $data['ficha_usuario'] = $ficha['id'];
        }
        
        
        if (count($datos_ficha) > 0)
        {
            $data['datos_ficha'] = $datos_ficha;
        }
        
        // SI ES MASTER, OBTENGO LOS DATOS DE TODOS LOS JUGADORES
        $usuarios = array();
        if ($partida['master'] == $this->session->userdata('usuario')['id'])
        {
            $data['fichas'] = $this->Ficha->with('jugador')->get_many_by('partida_id', $id_partida);
        }
        
        $this->load->view('partidas/partida',$data);
    }
    
    
    /**
     * RECIBE NUEVO MENSAJE POR AJAX
     */
    function nuevo_mensaje()
    {
        // INSERTAMOS EL MENSAJE
        $mensaje = array(
                        'mensaje' => $this->input->post('mensaje'),
                        'jugador' => $this->input->post('jugador'),
                        'partida' => $this->input->post('partida')
                        );
        
        $this->Chat->insert($mensaje);
        
        $chat = $this->Chat->with('usuario')->get_many_by('partida', $this->input->post('partida'));
        $data['mensajes'] = $chat;
        $this->load->view('partidas/chat',$data);
    }
    
    
    /**
     *  AÑADE UN NUEVO JUGADOR A LA PARTIDA
     */
    function nuevo_jugador($id_partida)
    {
        $datos_ficha = array(
                                'usuario_id' => $this->session->userdata('usuario')['id'],
                                'partida_id' => $id_partida
                            );
        
        $this->Ficha->insert($datos_ficha);
        
        // ADEMÁS, PARA INFORMAR A LOS DEMÁS PARTICIPANTES, AÑADIMOS MENSAJE INFORMANDO DE QUE SE UNE A LA PARTIDA
        $mensaje = array(
                            'jugador' => $this->session->userdata('usuario')['id'],
                            'partida' => $id_partida,
                            'mensaje' => $this->session->userdata('usuario')['usuario'] . ' se ha unido a la partida.'
                        );
                        
        $this->Chat->insert($mensaje);
        
        redirect('perfil');
    }
    
    
    /**
     *  EDITA EL CAMPO INDICADO VIA AJAX
     */
    function editar_campo()
    {
        $tabla = $this->input->post('tabla');
        $columna = $this->input->post('columna');
        $valor = $this->input->post('valor');
        $ficha = $this->input->post('ficha');
        $partida = $this->input->post('partida');
        
        if ($ficha == '')
        {
            $fila = null;
        }
        else
        {
            $fila = $this->Ficha->obtener_datos($tabla, $ficha);
        }
        
        // SI NO EXISTA LA ENTRADA, CREAMOS UNA AÑADIENDO EL NUEVO VALOR AL CAMPO INDICADO
        if ($fila == null)
        {
            $datos = array(
                            'partida' => $partida,
                            'ficha' => $ficha,
                            $columna => $valor
                            );
                            
            $this->Ficha->insertar_dato($tabla, $datos);
        }
        // SI EXISTE, REALIZAMOS UN UPDATE DEL CAMPO
        else
        {
            $datos = array(
                            $columna => $valor
                            );
            
            $this->Ficha->actualizar_dato($tabla, $fila['id'], $datos);
        }
    }


    /*
     * 
     */
    function obtener_ficha()
    {
        $jugador = $this->input->post('jugador');
        $partida = $this->input->post('partida');
        
        $datos_ficha = array();
        
        $ficha = $this->Ficha->get_by(array('usuario_id' => $jugador, 'partida_id' => $partida));
        
        $datos_partida = $this->Partida->get($partida);
        
        $juego = $this->Juego->get($datos_partida['tipo_juego']);
        
        // OBTENEMOS LAS TABLAS CORRESPONDIENTES AL JUEGO
        $tablas = $this->Tabla->get_many_by('juego', $juego['id']);
        
        $this->load->dbforge();
        
        $datos_tablas = array();
        // POR CADA TABLA OBTENEMOS SUS CAMPOS Y TIPOS
        foreach ($tablas as $tabla)
        {
            $datos = $this->db->field_data($tabla['tabla']);
            
            $datos_tablas[$tabla['tabla']] = $datos;
        }
        
        foreach ($tablas as $tabla)
        {
            $datos = $this->Ficha->obtener_datos($tabla['tabla'], $ficha['id']);
            
            $datos_ficha[] = array($tabla['tabla'] => $datos);
        }
        
        $data['datos_ficha'] = $datos_ficha;
        $data['datos_tablas'] = $datos_tablas;
        
        $this->load->view('partidas/ficha',$data);
    }


    /*
     * 
     */
    function cerrar_partida()
    {
        $partida = $this->input->post('partida');
        
        $this->Partida->update($id_partida, array('activa' => 'f'));
    }






    
    
}