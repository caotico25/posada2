<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Juegos extends CI_Controller
{
    
    /**
     *  CONSTRUCTOR DE LA CLASE
     * 
     *  Controla si el usuario está logueado. Si no lo está se redirige a inicio
     */
    function __construct()
    {
        parent::__construct();
        
        if (! logueado() || ! es_admin())
        {
            $this->session->set_flashdata('acceso_denegado', array('titulo' => 'Acceso denegado', 'cuerpo' => 'Ha intentado acceder a una zona restringida.'));
            
            redirect('inicio');
        }
    }
    
    
    /**
     *  MUESTRA LISTA DE JUEGOS EXISTENTES Y OPCIONES
     */
    function index()
    {
        $data['juegos'] = $this->Juego->get_all();
        
        $this->load->view('juegos/juegos',$data);
    }
    
    
    /**
     *  CARGA LA VISTA INICIAL
     */
    function alta()
    {
        $this->load->view('juegos/alta');
    }
    
    
    /**
     *  CREA UN NUEVO JUEGO EN LA BD
     */
    function crear_juego()
    {
        $datos = array(
                        'nombre' => $this->input->post('nombre'),
                        'descripcion' => $this->input->post('descripcion')
                    ); 
        
        $id_juego_nuevo = $this->Juego->insert($datos);
        
        echo json_encode($id_juego_nuevo);
    }
    
    
    /**
     *  CREA UNA NUEVA TABLA CON LA CATEGORIA INDICADA
     *  AÑADE TAMBIEN UN REGISTRO A TABLAS_JUEGOS QUE RELACIONA CADA TABLA CON EL JUEGO CORRESPONDIENTE
     */
    function crear_categoria()
    {
        $juego = $this->input->post('juego');
        $categoria = $this->input->post('categoria');
        
        // EL NOMBRE DE LA TABLA SERA EL NOMBRE DE LA CATEGORIA MAS EL ID DEL JUEGO PARA EVITAR CONFLICTOS
        $nombre_tabla = $categoria . '_' . $juego;
        
        // INSERTAMOS REGISTRO EN LA TABLA TABLAS_JUEGOS
        $this->Tabla->insert(array(
                                    'juego' => $juego,
                                    'tabla' => $nombre_tabla
                                    ));
        
        // CREAMOS LA TABLA CON FORGE
        $this->load->dbforge();
        
        // AÑADIMOS LOS CAMPOS MINIMOS QUE POSEERA CADA TABLA(ID, ID DEL JUEGO E ID DEL USUARIO)
        $this->dbforge->add_field("id bigserial constraint pk_" . $nombre_tabla . " primary key");
        $this->dbforge->add_field("partida bigint constraint fk_" . $nombre_tabla . "_juegos references juegos (id)");
        $this->dbforge->add_field("ficha bigint constraint fk_" . $nombre_tabla . "_fichas references fichas (id)");
        
        $this->dbforge->create_table($nombre_tabla);
    }


    /**
     *  CREA UNA NUEVA COLUMNA EN LA TABLA INDICADA
     */
    function crear_campo()
    {
        $juego = $this->input->post('juego');
        $categoria = $this->input->post('categoria');
        $columna = $this->input->post('columna');
        $tipo = $this->input->post('tipo');
        
        $tabla = $categoria . '_' . $juego;
        
        $this->load->dbforge();
        
        if ($tipo == 'varchar')
        {
            $col = array(
                            $columna => array(
                                                'type' => 'varchar',
                                                'constraint' =>50
                                            )
                        );
        }
        else if ($tipo == 'text')
        {
            $col = array(
                            $columna => array(
                                                'type' => 'text',
                                                'null' => TRUE
                                            )
                        );
        }
        else if ($tipo == 'int')
        {
            $col = array(
                            $columna => array(
                                                'type' => 'integer',
                                                'default' => 0
                                            )
                        );
        }
        
        $this->dbforge->add_column($tabla, $col);
    }
    
    
    /**
     *  ELLIMINA UNA COLUMNA DE LA TABLA INDICADA
     */
    function eliminar_campo()
    {
        $juego = $this->input->post('juego');
        $categoria = $this->input->post('categoria');
        $columna = $this->input->post('columna');
        
        $tabla = $categoria . '_' . $juego;
        
        $this->load->dbforge();
        
        $this->dbforge->drop_column($tabla, $columna);
    }
    
    
    /**
     *  ELIMINA EL JUEGO SELECCIONADO
     */
    function eliminar($id_juego)
    {
        $this->Juego->delete($id_juego);
        
        // AL ELIMINAR EL JUEGO SE DEBEN "ELIMINAR" TAMBIEN TODAS LAS PARTIDAS
        $partidas = $this->Partida->get_many_by('tipo_juego', $id_juego);
        
        foreach ($partidas as $partida)
        {
            $this->Partida->delete($partida['id']);
        }
        
        redirect('juegos');
    }
    
    
    /**
     *  EDITA EL JUEGO INDICADO
     */
    function editar($id_juego = '')
    {
        if ($id_juego == '')
        {
            $this->session->set_flashdata('error',array('cabecera' => 'Atención', 'cuerpo' => 'No se ha seleccionado ningún juego.'));
            
            redirect('juegos');
        }
        else
        {
            $juego = $this->Juego->get($id_juego);
            
            if ($juego == FALSE)
            {
                $this->session->set_flashdata('error',array('cabecera' => 'Atención', 'cuerpo' => 'El juego indicado no existe.'));
            
                redirect('juegos');
            }
            else
            {
                $this->load->dbforge();
                
                // RECOGEMOS LOS NOMBRES DE LAS TABLAS
                $tablas = $this->Tabla->get_many_by('juego', $id_juego);
                
                $datos_tablas = array();
                
                foreach ($tablas as $tabla)
                {
                    // POR CADA TABLA OBTENEMOS EL NOMBRE DE SUS COLUMNAS CON DBFORGE
                }
                
                // ENVIAMOS TODOS LOS DATOS A LA VISTA PARA EDICION
                $this->load->view('juegos/editar',$data);
            }
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}