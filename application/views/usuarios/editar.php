<!DOCTYPE html>

<html>
    
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
        <title>Posada del Caos - Editar usuario</title>
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
                                            <?php if ($this->session->userdata('usuario')['admin']): ?>
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
                    <h1>Editar usuario</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('inicio') ?>"><i class="fa fa-home"></i>Inicio</a></li>
                        <li><a href="<?= base_url('admin_panel') ?>">Panel de administrador</a></li>
                        <li class="active">Editar usuario</li>
                    </ol>
                </section>
                
                <section class="content">
                    
                    <!-- INICIO INFO BASICA DE JUEGO -->
                    <article class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Datos del usuario</h3>
                        </div>
                        <div class="box-body">
                            
                            <form role="form" class="form-horizontal">
                                <div class="form-group has-feedback">
                                    <label for="usuario" class="col-sm-2 required">Usuario</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="usuario" value="<?= $usuario['usuario'] ?>" id="usuario" placeholder="Usuario"/>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="email" class="col-sm-2 required">Email</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="email" name="email" value="<?= $usuario['email'] ?>" id="email" placeholder="Email"/>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="contraseña" class="col-sm-2">Contraseña</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="password" name="passwd" value="" id="passwd" placeholder="Contraseña"/>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="r-passwd" class="col-sm-2">Repetir contraseña</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="password" name="r-passwd" value="" id="r-passwd" placeholder="Repetir contraseña"/>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="tipo" class="col-sm-2">Administrador</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="tipo" id="tipo">
                                            <option value="">Seleccionar...</option>
                                            <option value="t" <?php if ($usuario['admin'] == 't') echo 'selected'; ?>>Sí</option>
                                            <option value="f" <?php if ($usuario['admin'] == 'f') echo 'selected'; ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-6">
                                        <button id="crear_usuario" type="submit" class="btn btn-primary">Editar</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </article>
                    <!-- FIN INFO BASICA DE JUEGO -->
                    
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
                                <a href="#">
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
                                <a href="#">
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
                                <a href="#">
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
        
        <!-- SCRIPTS -->
        <script src="<?= base_url('assets/js/jquery-1.113.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/jquery.cookie.js') ?>"></script>
        <script src="<?= base_url('assets/dist/js/app.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/bootstrap-toastr/toastr.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/select2/select2.min.js') ?>"></script>
        <script type="text/javascript" charset="utf-8">
            
            $(document).ready(function() {
                
                $("select").select2({
                    placeholder: "Seleccionar...",
                    language: "es"
                });
                
                $("#usuario").on('blur', function() {
                    
                    var nombre = $(this).val();
                    
                    if (nombre == '')
                    {
                        $(this).parent().parent().addClass("has-error");
                        $(this).parent().append('<span class="fa fa-times form-control-feedback"></span>');
                        $(this).tooltip({'title': 'El campo no puede estar vacío.'});
                    }
                    else
                    {
                        $(this).parent().parent().removeClass("has-error").addClass("has-success");
                        $(this).parent().children('.fa-times').remove();
                        $(this).parent().append('<span class="fa fa-check form-control-feedback"></span>');
                        $(this).tooltip('destroy');
                    }
                    
                });
                
                $("#email").on('blur', function() {
                    
                    var nombre = $(this).val();
                    
                    if (nombre == '')
                    {
                        $(this).parent().parent().addClass("has-error");
                        $(this).parent().append('<span class="fa fa-times form-control-feedback"></span>');
                        $(this).tooltip({'title': 'El campo no puede estar vacío.'});
                    }
                    else
                    {
                        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                        
                        if (regex.test(nombre))
                        {
                            $(this).parent().parent().removeClass("has-error").addClass("has-success");
                            $(this).parent().children('.fa-times').remove();
                            $(this).parent().append('<span class="fa fa-check form-control-feedback"></span>');
                            $(this).tooltip('destroy');
                        }
                        else
                        {
                            $(this).parent().parent().removeClass("has-success").addClass("has-error");
                            $(this).parent().children('.fa-check').remove();
                            $(this).parent().append('<span class="fa fa-times form-control-feedback"></span>');
                            $(this).tooltip('destroy').tooltip({'title': 'El campo no tiene un formato válido.'});
                        }
                    }
                    
                });
                
                $("#tipo").on('blur', function() {
                    
                    var nombre = $(this).val();
                    
                    if (nombre == '')
                    {
                        $(this).parent().parent().addClass("has-error");
                        $(this).parent().append('<span class="fa fa-times form-control-feedback"></span>');
                        $(this).tooltip({'title': 'Debe seleccionar una opción.'});
                    }
                    else
                    {
                        $(this).parent().parent().removeClass("has-error").addClass("has-success");
                        $(this).parent().children('.fa-times').remove();
                        $(this).parent().append('<span class="fa fa-check form-control-feedback"></span>');
                        $(this).tooltip('destroy');
                    }
                    
                });
                
                
                $("#crear_usuario").on('click', function(event) {
                    
                    event.preventDefault();
                    
                    var usuario = $("#usuario").val();
                    var email = $("#email").val();
                    var passwd = $("#passwd").val();
                    var r_passwd = $("#r-passwd").val();
                    var tipo = $("#tipo").val();
                    
                    $("#usuario").trigger('blur');
                    $("#email").trigger('blur');
                    $("#tipo").trigger('blur');
                    
                    var usuario_valido = $("#usuario").parent().parent().hasClass("has-success");
                    var email_valido = $("#email").parent().parent().hasClass("has-success");
                    var tipo_valido = $("#tipo").parent().parent().hasClass("has-success");
                    
                    if (usuario_valido && email_valido && tipo_valido)
                    {
                        var data = "usuario=" + usuario + "&email=" + email + "&admin=" + tipo;
                        
                        if (passwd != '')
                        {
                            if (passwd == r_passwd)
                            {
                                data = data + "&passwd=" + passwd + "&re_passwd=" + r_passwd;
                            }
                        }
                        
                        $.ajax({
                        
                            url: "<?= base_url('usuarios/editar_usuario/' . $usuario['id']) ?>",
                            type: "POST",
                            data: data,
                            success: function (respuesta){
                                
                               window.location.href = "<?= base_url('usuarios') ?>";
                                
                            },
                            error: function (jqXHR, textStatus, errorThrown){
                                
                                toastr.error('Ha ocurrido un error de conexión.', 'Error en el servidor');
                                
                            }
                            
                        });
                    }
                    else
                    {
                        toastr.error('Campos con errores', 'Atención');
                    }
                    
                });
                
            });
            
        </script>
        <!-- FIN SCRIPTS -->
    </body>
</html>