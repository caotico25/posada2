<!DOCTYPE html>

<html>
    
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
        <title>Posada del Caos - Alta de juego</title>
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/dist/css/AdminLTE.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/fonts/font-awesome/css/font-awesome.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap-toastr/toastr.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/select2.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>" type="text/css" />
    </head>
    
    <body role="document" class="layout-boxed skin-blue rellenar">
        <!-- INICIO CABECERA Y MENU -->
        <header>
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <i class="fa fa-bars"></i>
                        </button>
                        <a href="<?= base_url('inicio') ?>" class="navbar-brand">La Posada del Caos</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="<?= base_url('inicio') ?>">Inicio</a></li>
                            <li><a href="<?= base_url('noticias') ?>">Noticias</a></li>
                            <li><a href="<?= base_url('foro') ?>">Foro</a></li>
                            <li><a href="<?= base_url('partidas') ?>">Jugar a rol</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php if (logueado()): ?>
                                
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span><?= $this->session->userdata('usuario')['usuario'] ?></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="user-header bg-black-gradient">
                                            <!-- <img src="" class="img-circle" alt="User Image"> -->
                                            <p>
                                                <?= $this->session->userdata('usuario')['usuario'] ?>
                                                <small>Miembro desde <?= $this->session->userdata('usuario')['created_at'] ?></small>
                                            </p>
                                        </li>
                                        <li class="user-body">
                                            <?php if (es_admin()): ?>
                                                <a href="<?= base_url('admin_panel') ?>" class="btn btn-app">Panel de administrador</a>
                                            <?php endif ?>
                                        </li>
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="<?= base_url('perfil') ?>" class="btn btn-vk btn-flat">Perfil</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="<?= base_url('login/logout') ?>" class="btn btn-danger btn-flat">Salir</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                
                            <?php else: ?>
                                <li>
                                    <a href="<?= base_url('login') ?>">Login/registro</a>
                                </li>
                            <?php endif ?>
                            
                            <li>
                                <a href="#" data-toggle="control-sidebar" data-toggle="tooltip" title="Informes"><i class="fa fa-file-pdf-o"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- FIN CABECERA Y MENU -->
        
        <div class="wrapper bg-gray-light rellenar">
            
            <!-- INICIO CONTENIDO -->
            <div class="container rellenar">
                
                <section class="content-header">
                    <h1>Alta de nuevo juego</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('inicio') ?>"><i class="fa fa-home"></i>Inicio</a></li>
                        <li><a href="<?= base_url('admin_panel') ?>">Panel de administrador</a></li>
                        <li class="active">Alta de juego</li>
                    </ol>
                </section>
                
                <section class="content">
                    
                    <!-- INICIO INFO BASICA DE JUEGO -->
                    <article class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Datos del nuevo juego</h3>
                        </div>
                        <div class="box-body">
                            
                            <form role="form" class="form-horizontal">
                                <div class="form-group">
                                    <label for="nombre" class="col-sm-2 required">Nombre</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="nombre" value="" id="nombre" placeholder="Nombre"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion" class="col-sm-2 required">Descripción</label>
                                    <div class="col-sm-6">
                                        <textarea name="descripcion" id="descripcion" cols="56" rows="8" class="form-control" placeholder="Descripción del juego..."></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-6">
                                        <button id="crear_juego" type="submit" class="btn btn-primary">Crear y continuar</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </article>
                    <!-- FIN INFO BASICA DE JUEGO -->
                    
                    <!-- INICIO INFO FICHA -->
                    <article class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Datos de la nueva ficha</h3>
                        </div>
                        <div class="box-body">
                            
                            <form role="form" class="form-horizontal">
                                <div class="form-group">
                                    <label for="categoria" class="col-sm-2">Nueva categoría</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="categoria" value="" id="categoria"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-6">
                                        <button id="crear_categoria" type="submit" class="btn btn-primary disabled">Crear</button>
                                    </div>
                                </div>
                                <div class="form-group" id="boton_finalizar">
                                    <div class="col-sm-offset-2 col-sm-6">
                                        <button id="finalizar" type="submit" class="btn btn-success disabled">Terminar</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </article>
                    <!-- FIN INFO FICHA -->
                    
                </section>
                
            </div>
            <!-- FIN CONTENIDO -->
            
            <!-- INICIO ADMIN SIDEBAR -->
            <aside class="control-sidebar control-sidebar-dark" style="padding-top: 0px;">
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li class="active"><a href="#tab-inicio" data-toggle="tab" aria-expanded="true"><i class="fa fa-file-pdf-o"></i> INFORMES</a></li>
                </ul>
                <div class="tab-content">
                    
                    <!-- INICIO TAB INFORMES -->
                    <section class="tab-pane active" id="tab-inicio">
                        
                        <!-- INICIO INFORMES JUEGOS -->
                        <h3 class="control-sidebar-heading"><i class="fa fa-gamepad"></i> Juegos</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="<?= base_url('informes/informe_juegos') ?>" target="_blank">
                                    <span class="menu-icon bg-red">
                                        <i class="fa fa-plus"></i>
                                        <i class="fa fa-file-pdf-o"></i>
                                    </span>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Lista de juegos</h4>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('informes/informe_partidas') ?>" target="_blank">
                                    <span class="menu-icon bg-red">
                                        <i class="fa fa-plus"></i>
                                        <i class="fa fa-file-pdf-o"></i>
                                    </span>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Lista de partidas</h4>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- FIN INFORMES JUEGOS -->
                        
                        <!-- INICIO OPCIONES USUARIOS -->
                        <h3 class="control-sidebar-heading"><i class="fa fa-users"></i> Usuarios</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="<?= base_url('informes/informe_usuarios') ?>" target="_blank">
                                    <span class="menu-icon bg-red">
                                        <i class="fa fa-plus"></i>
                                        <i class="fa fa-file-pdf-o"></i>
                                    </span>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Lista de usuarios</h4>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- FIN OPCIONES USUARIOS -->
                    </section>
                    <!-- FIN TAB INFORMES -->
                    
                </div>
            </aside>
            <!-- FIN ADMIN SIDEBAR -->
            
        </div>
        
        <!-- INICIO FOOTER -->
        <footer class="navbar navbar-inverse navbar-fixed-bottom">
            <div class="container">
                <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#footer" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div id="footer" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" aria-espanded="false" aria-haspopup="true" role="button" data-toggle="dropdown">
                                    Mapa del sitio
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= base_url('inicio') ?>">Inicio</a></li>
                                    <li><a href="<?= base_url('noticias') ?>">Noticias</a></li>
                                    <li><a href="<?= base_url('foro') ?>">Foro</a></li>
                                    <li><a href="<?= base_url('partidas') ?>">Jugar a rol</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" aria-espanded="false" aria-haspopup="true" role="button" data-toggle="dropdown">
                                    Realizado por:
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="">SoftCaos</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" aria-espanded="false" aria-haspopup="true" role="button" data-toggle="dropdown">
                                    Tests superados:
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><img class="img-responsive" src="<?= base_url('assets/imagenes/valid-css.png') ?>" alt="CSS válido" /></li>
                                    <li><img src="<?= base_url('assets/imagenes/valid-html5.png') ?>" alt="HTML5 válido" /></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
        </footer>
        <!-- FIN FOOTER -->
        
        <!-- INICIO VENTANA MODAL CREACION DE CAMPOS -->
        <div class="modal fade" role="dialog" id="modal_campos">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Creación de campos</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped" data-elementos="" data-categoria="">
                            <thead>
                                <tr>
                                	<th>Nombre</th>
                                	<th>Tipo</th>
                                </tr>
                            </thead>
                            <tbody id="datos_campos">
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="button" id="confirmar_campos">Crear</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN VENTANA MODAL -->
        
        <!-- SCRIPTS -->
        <script src="<?= base_url('assets/js/jquery-1.113.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/jquery.cookie.js') ?>"></script>
        <script src="<?= base_url('assets/dist/js/app.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/bootstrap-toastr/toastr.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/select2/select2.min.js') ?>"></script>
        <script type="text/javascript" charset="utf-8">
            
            $(document).ready(function() {
                
                // VARIABLE QUE ALMACENARA EL ID DEL JUEGO QUE SE ESTA CREANDO
                var juego = 0;
                
                // CREA UN NUEVO JUEGO
                $("#crear_juego").on("click", function(event) {
                    
                    event.preventDefault();
                    
                    var nombre = $.trim( $("#nombre").val() );
                    var descripcion = $.trim( $("#descripcion").val() );
                    
                    // COMPROBAR QUE LOS CAMPOS NO ESTEN VACIOS
                    if (nombre != '' && descripcion != '')
                    {
                        $.ajax({
                        
                            url: "<?= base_url('juegos/crear_juego') ?>",
                            type: "POST",
                            data: { 'nombre': $("#nombre").val(), 'descripcion': $("#descripcion").val() },
                            success: function (datos){
                                
                                juego = eval(datos);
                                
                                toastr.success('Continúe con la creación de la ficha.', 'Juego creado');
                                $("#crear_categoria, #finalizar").removeClass('disabled');
                                
                            },
                            error: function (jqXHR, textStatus, errorThrown){
                                
                                toastr.error('Ha ocurrido un error de conexión.', 'Error en el servidor');
                                
                            }
                            
                        });
                        
                    }
                    else
                    {
                        if (nombre == '')
                        {
                            toastr.warning('No ha introducido un nombre para el juego.', 'Atención');
                        }
                        
                        if (descripcion == '')
                        {
                            toastr.warning('No ha introducido una descripción para el juego.', 'Atención');
                        }
                    }
                    
                });
                
                
                // CREA UNA NUEVA CATEGORIA
                $("#crear_categoria").on("click", function(event) {
                    
                    event.preventDefault();
                    
                    var categoria = $.trim( $("#categoria").val() );
                    
                    if (categoria != "")
                    {
                        // ID DE LA CATEGORIA Y NOMBRE DE LA TABLA
                        var id_categoria = normalize(categoria.replace(/\s+/g, "_").toLowerCase());
                        
                        // LLAMADA AJAX PARA CREAR LA TABLA CORRESPONDIENTE
                        $.ajax({
                        
                            url: "<?= base_url('juegos/crear_categoria') ?>",
                            type: "POST",
                            data: { 'juego': juego, 'categoria': id_categoria},
                            success: function (){
                                
                                $("#categoria").val('');
                                
                                // CREAMOS LA CAJA CORRESPONDIENTE A LA CATEGORIA Y LA COLGAMOS DELANTE DEL BOTON FINALIZAR
                                $("<article id='" + id_categoria + "' class='box box-success' style='width: 80%; margin-left: 10%;'></article>").insertBefore("#boton_finalizar");
                                
                                // CREAMOS LA CABECERA DE LA CATEGORIA
                                $("#" + id_categoria).append("<div class='box-header with-border'><h3 class='box-title'>" + categoria + "</h3></div>");
                                
                                // CREAMOS EL CUERPO DE LA CATEGORIA
                                $("#" + id_categoria).append("<div class='box-body form-horizontal' id='body_" + id_categoria + "'></div>");
                                
                                // CREAMOS CONTENEDOR DE LOS CAMPOS DE LA CATEGORIA
                                $("#body_" + id_categoria).append("<div class='row' id='contenedor_" + id_categoria + "'></div>");
                                
                                // CREAMOS EL CONTENIDO DEL CUERPO DE LA CATEGORIA. BOTONES PARA CREAR CAMPOS Y SUBCATEGORIA
                                var crear_campos =  "<div class='form-group' id='form_" + id_categoria + "'>" +
                                                        "<label for='campos' class='col-sm-2'>Número de campos a añadir</label>" +
                                                        "<div class='col-sm-4'>" +
                                                            "<input class='form-control' type='number' name='campos_" + id_categoria + "' value='' id='campos_" + id_categoria + "'/>" +
                                                        "</div>" +
                                                    "</div>" +
                                                    "<div class='form-group'><div class='col-sm-offset-2 col-sm-6'>" +
                                                        "<button id='crear_campos_" + id_categoria + "' type='submit' class='btn btn-primary crear-campos'>Crear campos</button>" +
                                                    "</div></div>";
                                                    
                                $("#body_" + id_categoria).append(crear_campos);
                                
                            },
                            error: function (jqXHR, textStatus, errorThrown){
                                
                                toastr.error('Ha ocurrido un error de conexión.', 'Error en el servidor');
                                
                            }
                            
                        });
                    }
                    else
                    {
                        toastr.warning('No ha introducido un nombre para la categoría.', 'Atención');
                    }
                    
                });
                
                
                /*
                 *
                 *  CREACION DE CAMPOS DE LA CATEGORIA
                 *  
                 *  SE ABRIRA UNA VENTANA MODAL CON UN FORMULARIO GENERADO CON LOS CAMPOS NECESARIOS PARA
                 *  CADA COLUMNA - NOMBRE - TIPO(CADENA, NUMERO)
                 * 
                 */
                $("article").on('click', '.crear-campos', function(event) {
                    
                    event.preventDefault();
                    
                    // DESDE EL ID DEL BOTON OBTENEMOS EL ID DE LA CATEGORIA PARA LA QUE ESTAMOS CREANDO LOS CAMPOS
                    var id_boton = $(this).attr('id');
                    
                    // CONVERTIMOS EL ID DEL BOTON EN UN ARRAY Y ELIMINAMOS LA PARTE QUE NO NOS INTERESA
                    var array_categoria = id_boton.split("_").splice(2);
                    
                    // VOLVEMOS A CREAR UNA CADENA CON EL RESULTADO QUE NOS QUEDA
                    var id_categoria = array_categoria.join("_");
                    
                    // OBTENEMOS EL NUMERO DE CAMPOS A CREAR
                    var campos = $("#campos_" + id_categoria).val();
                    $("#campos_" + id_categoria).val('');
                    
                    if ( !isNaN(campos))
                    {
                        // CREAMOS LA ESTRUCTURA PARA LA CREACION DE CAMPOS
                        var estructura = "";
                        $("#datos_campos").empty();
                        
                        // ALMACENAMOS EL NUMERO DE CAMPOS QUE VA A CONTENER LA TABLA
                        $("#datos_campos").data("elementos", campos);
                        $("#datos_campos").data("categoria", id_categoria);
                        
                        while(campos > 0)
                        {
                            estructura =    "<tr>" +
                                                "<td><input type='text' class='form-control' name='campo_" + campos + "' id='campo_" + campos + "' /></td>" +
                                                "<td><select class='form-control select2' name='tipo_" + campos + "' id='tipo_" + campos + "'></select></td>" +
                                            "</tr>";
                            // COLGAMOS LA ESTRUCTURA CREADA
                            $("#datos_campos").append(estructura);
                            
                            estructura = "";
                            campos = campos -1;
                        }
                        
                        // DATOS DEL SELECT
                        var data = [{id: 'varchar', text: 'Texto'}, {id: 'text', text: 'Texto largo'}, {id: 'int', text: 'Número'}];
                        
                        // INICIALIZAMOS LOS SELECT
                        $(".select2").select2({
                            
                            data: data,
                            placeholder: "Seleccionar"
                            
                        });
                        
                        $("#modal_campos").modal();
                    }
                    else
                    {
                        toastr.warning('No ha introducido un número.', 'Atención');
                    }
                    
                });
                
                
                $("#confirmar_campos").on('click', function() {
                    
                    // OBTENEMOS EL NUMERO DE CAMPOS QUE SE ESTAN AÑADIENDO A LA TABLA
                    var numero_campos = $("#datos_campos").data('elementos');
                    var categoria = $("#datos_campos").data('categoria');
                    
                    while (numero_campos > 0)
                    {
                        var nombre = $.trim( $("#campo_" + numero_campos).val() );
                        var tipo = $("#tipo_" + numero_campos).val();
                        
                        // CREAMOS EL ELEMENTO A MOSTRAR DURANTE EL PROCESO DE CREACION EN LA SECCION CORREPONDIENTE
                        var campo = "<div class='col-sm-2'><div class='box box-danger'>" +
                                        "<div class='box-header with-border'>" +
                                            "<h3 class='box-title'>" + nombre + "</h3>" +
                                            "<div class='box-tools pull-right'>" +
                                                "<button class='btn btn-box-tool eliminar_campo' data-widget='remove'>" +
                                                    "<i class='fa fa-times'></i>" +
                                                "</button>" +
                                            "</div>" +
                                        "</div>" +
                                    "</div></div>";
                        
                        
                        
                        // NOMBRE DE LA COLUMNA DE LA TABLA
                        var nombre_columna = nombre.replace(/\s+/g, "_").toLowerCase();
                        
                        // POR CADA CAMPO HACEMOS LLAMADA AJAX PARA AÑADIR LA COLUMNA A LA TABLA CORRESPONDIENTE
                        $.ajax({
                            
                            url: "<?= base_url('juegos/crear_campo') ?>",
                            type: "POST",
                            data: { 'juego': juego, 'categoria': categoria, 'columna': nombre_columna, 'tipo': tipo},
                            success: function (){
                                
                                $("#contenedor_" + categoria).append(campo);
                                
                            },
                            error: function (jqXHR, textStatus, errorThrown){
                                
                                toastr.error('Ha ocurrido un error de conexión.', 'Error en el servidor');
                                
                            }
                            
                        });
                        
                        numero_campos = numero_campos - 1;
                    }
                    
                    $("#modal_campos").modal('hide');
                    
                });
                // FIN CREACION DE CAMPOS DE LA CATEOGRIA
                
                
                // INICIO ELIMINACION DE CAMPO
                $(document).on('click', '.eliminar_campo', function() {
                    
                    var columna = $(this).parent().parent().children("h3").html();
                    columna = columna.replace(/\s+/g, "_").toLowerCase();
                    
                    // OBTENEMOS EL NOMBRE DE LA TABLA
                    var tabla = $(this).parent().parent().parent().parent().parent().parent().parent().attr('id');
                    
                    // ELIMINAMOS LA COLUMNA
                    $.ajax({
                        
                        url: "<?= base_url('juegos/eliminar_campo') ?>",
                        type: "POST",
                        context: this,
                        data: { 'juego': juego, 'categoria': tabla, 'columna': columna },
                        success: function (){
                            
                            $(this).parent().parent().parent().parent().fadeOut("slow", function() { $(this).remove(); });
                            
                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            
                            toastr.error('Ha ocurrido un error de conexión.', 'Error en el servidor');
                            
                        }
                        
                    });
                    
                });
                // FIN ELIMINACION DE CAMPO
                
                
                // TERMINA LA CREACION DEL NUEVO JUEGO
                $("#finalizar").on("click", function(event) {
                    
                    event.preventDefault();
                    
                    toastr.success('Ha finalizado la creación del nuevo juego.', 'Trabajo terminado');
                    
                    setTimeout(function() { window.location.href = "<?= base_url('juegos') ?>"; }, 2000);
                    
                });
                
            });
            
            
            // ELIMINA ACENTOS Y CARACTERES ESPECIALES
            var normalize = (function() {
                var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç", 
                    to   = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc",
                    mapping = {};
             
                for(var i = 0, j = from.length; i < j; i++ )
                    mapping[ from.charAt( i ) ] = to.charAt( i );
             
                return function( str ) {
                    var ret = [];
                    for( var i = 0, j = str.length; i < j; i++ ) {
                        var c = str.charAt( i );
                        if( mapping.hasOwnProperty( str.charAt( i ) ) )
                            ret.push( mapping[ c ] );
                        else
                            ret.push( c );
                    }      
                    return ret.join( '' );
                }
             
            })();
            
        </script>
        <!-- FIN SCRIPTS -->
    </body>
</html>