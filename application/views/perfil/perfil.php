<!DOCTYPE html>

<html>
    
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
        <title>Posada del Caos - Mi perfil</title>
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/dist/css/AdminLTE.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/fonts/font-awesome/css/font-awesome.min.css') ?>" type="text/css" />
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
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- FIN CABECERA Y MENU -->
        
        <!-- INICIO CONTENIDO -->
        <div class="container bg-gray-light" style="margin-top: 80px; margin-bottom: 80px;">
            
            <section class="content-header">
                <h1>Mi perfil</h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('inicio') ?>"><i class="fa fa-home"></i>Inicio</a></li>
                    <li class="active"><a href=""><i class="fa fa-user"></i>Perfil</a></li>
                </ol>
            </section>
            
            <div class="content">
                
                <button class="btn btn-default" onclick="abrir_popup()">Cambiar contraseña</button>
                <input type="text" id="exito" name="exito" value="" style="display: none;"/>
                <!-- INICIO PARTIDAS EN LAS QUE PARTICIPO -->
                <section class="box">
                    <div class="box-header with-border cabecera1">
                        <h2 class="box-title">PARTIDAS EN LAS QUE PARTICIPO</h2>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        
                        <?php if (count($partidas_jugador) == 0): ?>
                            Aún no te has unido a ninguna partida. ¿A qué esperas?
                            
                            <a href="<?= base_url('partidas') ?>" class="btn btn-default">Buscar partida</a>
                        <?php else: ?>
                            
                            <?php foreach ($partidas_jugador as $partida): ?>
                                <article class="box">
                                    <div class="box-header cabecera2">
                                        <h2 class="box-title"><?= $partida['nombre'] ?></h2>
                                        <!-- <div class="box-tools pull-right">
                                            <div class="dropdown">
                                                <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                                    Opciones <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="<?= base_url('fichas/descargar/' . $partida['id']) ?>">Descargar ficha</a></li>
                                                </ul>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="box-body">
                                        
                                    </div>
                                    <div class="box-footer">
                                        <?php if($partida['activa'] == 't'): ?>
                                            <button class="btn btn-default pull-left jugar" data-partida="<?= $partida['id'] ?>">Jugar</button>
                                        <?php else: ?>
                                            <button class="btn btn-default pull-left disabled">Partida inactiva</button>
                                        <?php endif ?>
                                        <button class="btn btn-default pull-right salir" data-partida="<?= $partida['id'] ?>">Salir de la partida</button>
                                    </div>
                                </article>
                            <?php endforeach ?>
                            
                        <?php endif ?>
                        
                    </div>
                </section>
                <!-- FIN PARTIDAS EN LAS QUE PARTICIPO -->
                
                <!-- INICIO PARTIDAS QUE DIRIJO -->
                <section class="box">
                    <div class="box-header with-border cabecera1">
                        <h2 class="box-title">PARTIDAS QUE DIRIJO</h2>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        
                        <?php if (count($partidas_master) == 0): ?>
                            Aún no has creado ninguna partida. ¿A qué esperas?
                            
                            <a href="<?= base_url('partidas/nueva_partida') ?>" class="btn btn-default">Crear partida</a>
                        <?php else: ?>
                            
                            <?php foreach ($partidas_master as $partida): ?>
                                <article class="box" style="width: 90%; margin-left: 5%;">
                                    <div class="box-header cabecera2">
                                        <h2 class="box-title"><?= $partida['nombre'] ?></h2>
                                        <div class="box-tools pull-right">
                                            <div class="dropdown">
                                                <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                                    Opciones <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="">Opcion</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <?= $partida['descripcion'] ?>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-default pull-left jugar" data-partida="<?= $partida['id'] ?>">Jugar</button>
                                        <button class="btn btn-default pull-right finalizar" data-partida="<?= $partida['id'] ?>">Finalizar partida</button>
                                    </div>
                                </article>
                            <?php endforeach ?>
                            
                        <?php endif ?>
                        
                    </div>
                </section>
                <!-- FIN PARTIDAS QUE DIRIJO -->
            </div>
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
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
                
                $(".jugar").on('click', function() {
                    
                    var partida = $(this).data('partida');
                    
                    window.open("<?= base_url('partidas/iniciar') ?>/" + partida, '_blank');
                    
                });
                
                $(".salir").on('click', function() {
                    
                    var partida = $(this).data('partida');
                    
                    window.location.href = "<?= base_url('partidas/salir') ?>/" + partida;
                    
                    $(this).parent().parent().remove();
                    
                });
                
                $(".finalizar").on('click', function() {
                    
                    var partida = $(this).data('partida');
                    
                    window.location.href = "<?= base_url('partidas/finalizar') ?>/" + partida;
                    
                    $(this).parent().parent().remove();
                    
                });
                
                $("#mensaje").on('change', function() {
                    
                    if ($("#mensaje").val() != '')
                    {
                        toastr.success("Contraseña cambiada correctamente", "Correcto");
                    }
                });
                    
                
            });
            
            function abrir_popup()
            {
                document.getElementById('exito').value = "";
                var ventan = window.open("<?= base_url('perfil/cambio_passwd')?>", '_blank', 'height=200, width=300, top=500, left=200');
                ventan.focus();
                return false;
            }
            
        </script>
        <!-- FIN SCRIPTS -->
    </body>
</html>