<!DOCTYPE html>

<html lang="es">
    
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
        <title>Posada del Caos - Inicio</title>
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
                            <li class="active"><a href="<?= base_url('inicio') ?>">Inicio</a></li>
                            <li><a href="<?= base_url('noticias') ?>">Noticias</a></li>
                            <li><a href="<?= base_url('foro') ?>">Foro</a></li>
                            <li><a href="<?= base_url('partidas') ?>">Jugar a rol</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <span class="col-sm-8">
                                <input class="form-control input-sm" type="text" name="buscar" value="" id="buscar" placeholder="Buscar..."/>
                            </span>
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
            <!-- INICIO CABECERA PRINCIPAL -->
            <div id="jumbo" class="jumbotron">
                <h1 class="text-center text-black">LA POSADA DEL CAOS</h1>
            </div>
            <!-- FIN CABECERA PRINCIPAL -->
            
            <!-- INICIO PRESENTACION -->
            <section class="box sombreado">
                <div class="box-header with-border cabecera1">
                    <h2 class="box-title">NOS PRESENTAMOS</h2>
                </div>
                <article class="box-body bg-gray-light">
                    <h3 class="box-title">BIENVENIDOS A LA POSADA DEL CAOS</h3>
                    <p>
                        <video width="400" controls  style="width: 100% !important; height: auto;">
                            <source src="<?= base_url('assets/videos/intro.mp4') ?>" type="video/mp4">
                            Tu navegador no soporta videos HTML5.
                        </video>
                    </p>
                    <p>
                        Sed bienvenidos a esta humilde posada. Sentaos y disfrutad de una buena partida de rol.
                        Compartid opiniones, discutid, daos hachazos si es necesario! (en la ficción por supuesto jejeje).
                    </p>
                </article>
            </section>
            <!-- FIN PRESENTACION -->
            
            <!-- INICIO ULTIMAS NOTICIAS -->
            <section class="box sombreado">
                <div class="box-header with-border cabecera1">
                    <h2 class="box-title">ULTIMAS NOTICIAS</h2>
                </div>
                <article class="box-body bg-gray-light">
                    
                    <?php if (count($noticias) == 0): ?>
                        
                        Aún no se ha redactado ninguna noticia.
                        
                    <?php else: ?>
                        
                        <?php foreach ($noticias as $noticia): ?>
                            <article class="box interior">
                                <div class="box-header cabecera4">
                                    <h3 class="box-title"><?= $noticia['titulo'] ?></h3>
                                </div>
                                <div class="box-body">
                                    <?= nl2br($noticia['contenido']) ?>
                                </div>
                                <div class="box-footer">
                                    <span class="pull-leftt">Por: <?= $noticia['usuario']['usuario'] ?></span>
                                    <span class="pull-right label label-default"><?= date('d-m-Y', strtotime($noticia['updated_at']) ) ?> a las <?= date('H:i', strtotime($noticia['updated_at']) ) ?></span>
                                </div>
                            </article>
                        <?php endforeach ?>
                    
                    <?php endif ?>
                    
                </article>
            </section>
            <!-- FIN ULTIMAS NOTICIAS -->
            
            <!-- INICIO ULTIMOS POSTS -->
            <section class="box sombreado">
                <div class="box-header with-border cabecera1">
                    <h2 class="box-title">ULTIMOS POSTS</h2>
                </div>
                <article class="box-body bg-gray-light">
                    
                    <?php if (count($posts) == 0): ?>
                        
                        Aún no se ha redactado ningún post.
                        
                    <?php else: ?>
                    
                        <?php foreach ($posts as $post): ?>
                            <article class="box interior sombreado">
                                <div class="box-header cabecera4">
                                    <h3 class="box-title"><?= $post['titulo'] ?></h3>
                                    <div class="box-tools">
                                        <a class="btn btn-box-tool" href="<?= base_url('foro/' . $post['tema']['id'] . '/' . $post['id']) ?>"><i class="fa fa-eye"></i> Ver</a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <?= $post['contenido'] ?>
                                </div>
                                <div class="box-footer">
                                    <span class="pull-left">Por: <?= $post['autor']['usuario'] ?></span><span class="pull-right label label-default"><?= date('d-m-Y', strtotime($post['fecha'])) ?></span>
                                </div>
                            </article>
                        <?php endforeach ?>
                    
                    <?php endif ?>
                    
                </article>
            </section>
            <!-- FIN ULTIMOS POSTS -->
            
            <!-- INICIO ULTIMAS PARTIDAS CREADAS -->
            <section class="box sombreado">
                <div class="box-header with-border cabecera1">
                    <h2 class="box-title">ULTIMAS PARTIDAS CREADAS</h2>
                </div>
                <article class="box-body bg-gray-light">
                    
                    <?php if (count($partidas) == 0): ?>
                        
                        Aún no se ha creado ninguna partida.
                        
                    <?php else: ?>
                        
                        <?php foreach ($partidas as $partida): ?>
                            <article class="box interior sombreado">
                                <div class="box-header cabecera4">
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
                    
                </article>
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
                
                <?php if ($this->session->flashdata('acceso_denegado')): ?>
                
                    toastr.error('<?= $this->session->flashdata('acceso_denegado')['cuerpo'] ?>', '<?= $this->session->flashdata('acceso_denegado')['titulo'] ?>')
                
                <?php endif ?>
                
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
                
                // BUSCADOR
                $("#buscar").on('keyup', function(event) {
                    
                    var buscar = $(this).val();
                    
                    if (buscar != '')
                    {
                        if (event.keyCode === 13)
                        {
                            
                            window.location.href = "<?= base_url('buscador/index') ?>/" + buscar;
                            
                        }
                    }
                    
                });
                
            });
        </script>
        <!-- FIN SCRIPTS -->
    </body>
</html>