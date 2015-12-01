<!DOCTYPE html>

<html>
    
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
        <title>Posada del Caos - Jugar a rol</title>
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/dist/css/AdminLTE.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/fonts/font-awesome/css/font-awesome.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap-toastr/toastr.min.css') ?>" type="text/css" />
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
                <h1>Jugar a rol</h1>
                <small>Únete a una aventura!</small>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('inicio') ?>"><i class="fa fa-home"></i>Inicio</a></li>
                    <li class="active">Jugar a rol</li>
                </ol>
            </section>
            
            <section class="content">
            
                <!-- INICIO ULTIMAS PARTIDAS CREADAS -->
                <article class="box">
                    <div class="box-header with-border cabecera2">
                        <h2 class="box-title">PARTIDAS</h2>
                        <div class="box-tools pull-right">
                            <button id="nueva_partida" class="btn btn-box-tool">
                                <i class="fa fa-plus"></i>
                                Nueva partida
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        
                        <?php if (count($partidas) == 0): ?>
                            
                            Aún no se ha creado ninguna partida.
                            
                        <?php else: ?>
                            
                            <?php foreach ($partidas as $partida): ?>
                                <article class="box interior sombreado">
                                    <div class="box-header cabecera1">
                                        <h3 class="box-title"><?= $partida['nombre'] ?></h3>
                                    </div>
                                    <div class="box-body">
                                        <?= $partida['descripcion'] ?>
                                    </div>
                                    <div class="box-footer">
                                        <span class="label label-default"><?= estado_partida($partida['estado']) ?></span>
                    
                                        <?php if (logueado()): ?>
                                        
                                            <?php if (participa($this->session->userdata('usuario')['id'], $partida['id'])): ?>
                                                
                                                <?php if (es_master($this->session->userdata('usuario')['id'], $partida['id'])): ?>
                                                    
                                                    <button class="btn btn-default pull-right jugar" data-partida="<?= $partida['id'] ?>">Jugar</button>
                                                    
                                                <?php else: ?>
                                                    
                                                    <?php if($partida['activa'] == 't'): ?>
                                                        <button class="btn btn-default pull-right jugar" data-partida="<?= $partida['id'] ?>">Jugar</button>
                                                    <?php else: ?>
                                                        <button class="btn btn-default pull-right disabled">Partida inactiva</button>
                                                    <?php endif ?>
                                                    
                                                <?php endif ?>
                                                
                                            <?php else: ?>
                                            
                                                <?php if ($partida['estado'] == 1): ?>
                                                    <button class="btn btn-default pull-right unirse" data-partida="<?= $partida['id'] ?>">Unirse a la aventura</button>
                                                <?php else: ?>
                                                    <button class="btn btn-default pull-right disabled" data-partida="<?= $partida['id'] ?>">No se admiten jugadores</button>
                                                <?php endif ?>
                                                
                                            <?php endif ?>
                                        
                                        <?php endif ?>
                                    </div>
                                </article>
                            <?php endforeach ?>
                        
                        <?php endif ?>
                        
                    </div>
                </article>
                <!-- FIN ULTIMAS PARTIDAS CREADAS -->
            </section>
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
                
                //CREAR UNA NUEVA PARTIDA
                $("#nueva_partida").on("click", function() {
                    
                    window.location.href = "<?= base_url('partidas/nueva_partida') ?>";
                    
                });
                
                // JUGAR A LA PARTIDA SELECCIONADA
                $(".jugar").on('click', function() {
                    
                    var partida = $(this).data('partida');
                    
                    window.open("<?= base_url('partidas/iniciar') ?>/" + partida, '_blank');
                    
                });
                
                // UNIRSE A LA PARTIDA SELECCIONADA
                $(".unirse").on('click', function() {
                    
                    var partida = $(this).data('partida');
                    
                    window.location.href = "<?= base_url('partidas/nuevo_jugador') ?>" + "/" + partida;
                    
                });
                
            });
        </script>
        <!-- FIN SCRIPTS -->
    </body>
</html>