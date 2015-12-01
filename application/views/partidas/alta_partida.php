<!DOCTYPE html>

<html>
    
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
        <title>Posada del Caos - Nueva partida</title>
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/dist/css/AdminLTE.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/fonts/font-awesome/css/font-awesome.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/select2.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap-toastr/toastr.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>" type="text/css" />
    </head>
    
    <body role="document" class="layout-boxed">
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
                            <li class="active"><a href="<?= base_url('partidas') ?>">Jugar a rol</a></li>
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
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- FIN CABECERA Y MENU -->
        
        <!-- INICIO CONTENIDO -->
        <div class="container bg-gray-light" style="margin-top: 80px; margin-bottom: 80px;">
            
            <section class="content-header">
                <h1>Nueva partida</h1>
                <small>Comienza una nueva aventura</small>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('inicio') ?>"><i class="fa fa-home"></i>Inicio</a></li>
                    <li><a href="<?= base_url('partidas') ?>">Jugar a rol</a></li>
                    <li class="active">Nueva partida</li>
                </ol>
            </section>
            
            <!-- INICIO ULTIMAS PARTIDAS CREADAS -->
            <section class="box">
                <div class="box-header with-border">
                </div>
                <div class="box-body">
                    
                    <!-- FORMULARIO PARA NUEVA PARTIDA -->
                    <form role="form" class="form-horizontal">
                        <div class="form-group has-feedback">
                            <label for="nombre" class="col-sm-2 required">Nombre</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" name="nombre" value="" id="nombre" placeholder="Nombre" required/>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="descripcion" class="col-sm-2 required">Descripción</label>
                            <div class="col-sm-6">
                                <textarea required name="descripcion" id="descripcion" cols="56" rows="8" class="form-control" placeholder="Descripción del juego..."></textarea>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="formato" class="col-sm-2 required">Formato de juego</label>
                            <div class="col-sm-6">
                                <select name="formato" id="formato" required class="form-control">
                                    <option value="">Seleccionar...</option>
                                    
                                    <?php foreach ($juegos as $juego): ?>
                                        <option value="<?= $juego['id'] ?>"><?= $juego['nombre'] ?></option>
                                    <?php endforeach ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="estados" class="col-sm-2 required">Estado inicial de  partida</label>
                            <div class="col-sm-6">
                                <select name="estado" id="estado" required class="form-control">
                                    <option value="">Seleccionar...</option>
                                    
                                    <?php foreach ($estados as $estado): ?>
                                        <option value="<?= $estado['id'] ?>"><?= $estado['estado'] ?></option>
                                    <?php endforeach ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jugadores" class="col-sm-2">Añadir jugadores</label>
                            <div class="col-sm-6">
                                <select name="jugadores[]" id="jugadores" multiple class="form-control">
                                    <option value="">Seleccionar...</option>
                                    
                                    <?php foreach ($usuarios as $usuario): ?>
                                        <?php if ($this->session->userdata('usuario')['id'] != $usuario['id']): ?>
                                            <option value="<?= $usuario['id'] ?>"><?= $usuario['usuario'] ?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <button id="crear_partida" type="submit" class="btn btn-primary">Crear partida</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </section>
            <!-- FIN ULTIMAS PARTIDAS CREADAS -->
            
        </div>
        <!-- FIN CONTENIDO -->
        
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
                                    <li><a href="#">Noticias</a></li>
                                    <li><a href="#">Foro</a></li>
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
        
        <!-- SCRIPTS -->
        <script src="<?= base_url('assets/js/jquery-1.113.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/jquery.cookie.js') ?>"></script>
        <script src="<?= base_url('assets/dist/js/app.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/bootstrap-toastr/toastr.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/select2/select2.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/select2/i18n/es.js') ?>"></script>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
                
                $("select").select2({
                    placeholder: "Seleccionar...",
                    language: "es"
                });
                
                
                $("#nombre").on('blur', function() {
                    
                    var nombre = $(this).val();
                    
                    if (nombre == '')
                    {
                        $("#nombre").parent().parent().addClass("has-error");
                        $("#nombre").parent().append('<span class="fa fa-times form-control-feedback"></span>');
                        $(this).tooltip({'title': 'El campo no puede estar vacío.'});
                    }
                    else
                    {
                        $("#nombre").parent().parent().removeClass("has-error");
                        $("#nombre").parent().children('.fa-times').remove();
                        $("#nombre").parent().parent().addClass("has-success");
                        $("#nombre").parent().append('<span class="fa fa-check form-control-feedback"></span>');
                    }
                    
                });
                
                
                $("#descripcion").on('blur', function() {
                    
                    var descripcion = $(this).val();
                    
                    if (descripcion == '')
                    {
                        $("#descripcion").parent().parent().addClass("has-error");
                        $("#descripcion").parent().append('<span class="fa fa-times form-control-feedback"></span>');
                    }
                    else
                    {
                        $("#descripcion").parent().parent().removeClass("has-error");
                        $("#descripcion").parent().children('.fa-times').remove();
                        $("#descripcion").parent().parent().addClass("has-success");
                        $("#descripcion").parent().append('<span class="fa fa-check form-control-feedback"></span>');
                    }
                    
                });
                
                
                $("#crear_partida").on('click', function(event) {
                    
                    event.preventDefault();
                    
                    // OBTENEMOS LOS VALORES DE LOS CAMPOS A VALIDAR
                    var nombre = $.trim( $("#nombre").val() );
                    var descripcion = $("#descripcion").val();
                    var formato = $("#formato").val();
                    var estado = $("#estado").val();
                    
                    var jugadores = $("#jugadores").val(); // SI ESTA VACIO ES NULL
                    
                    // VALIDAMOS LOS CAMPOS
                    
                    $("#nombre").trigger('blur');
                    $("#descripcion").trigger('blur');
                    
                    if (formato == '')
                    {
                        $("#formato").parent().parent().addClass("has-error");
                        $("#formato").parent().append('<span class="fa fa-times form-control-feedback"></span>');
                    }
                    else
                    {
                        $("#formato").parent().parent().removeClass("has-error");
                        $("#formato").parent().children('.fa-times').remove();
                        $("#formato").parent().parent().addClass("has-success");
                        $("#formato").parent().append('<span class="fa fa-check form-control-feedback"></span>');
                    }
                    
                    if (estado == '')
                    {
                        $("#estado").parent().parent().addClass("has-error");
                        $("#estado").parent().append('<span class="fa fa-times form-control-feedback"></span>');
                    }
                    else
                    {
                        $("#estado").parent().parent().removeClass("has-error");
                        $("#estado").parent().children('.fa-times').remove();
                        $("#estado").parent().parent().addClass("has-success");
                        $("#estado").parent().append('<span class="fa fa-check form-control-feedback"></span>');
                    }
                    
                    if ( ! $("#nombre").parent().parent().hasClass("has-error") &&
                         ! $("#descripcion").parent().parent().hasClass("has-error") &&
                         formato != '' && estado != '')
                    {
                        // SI TODAS LAS CONDICIONES SE CUMPLEN SE ENVIA LA INFORMACION RECOGIDA A SERVIDOR
                        $.ajax({
                        
                            url: "<?= base_url('partidas/alta_partida') ?>",
                            type: "POST",
                            data: { 'nombre': nombre, 'descripcion': descripcion, 'formato': formato, 'estado': estado, 'jugadores': jugadores },
                            success: function (datos){
                                
                                partida = eval(datos);
                                
                                toastr.success('Ya puedes comenzar a dirigirla.', 'Partida creada');
                                
                                // REDIRIGIR AL PERFIL DEL USUARIO PARA QUE LA INICIE DESDE AHÍ
                                setTimeout(function() { window.location.href = "<?= base_url('perfil') ?>"; }, 2000);
                                
                            },
                            error: function (jqXHR, textStatus, errorThrown){
                                
                                toastr.error('Ha ocurrido un error de conexión.', 'Error en el servidor');
                                
                            }
                            
                        });
                    }
                    
                });
                
            });
        </script>
        <!-- FIN SCRIPTS -->
    </body>
</html>