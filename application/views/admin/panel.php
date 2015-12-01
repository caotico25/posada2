<!DOCTYPE html>

<html>
    
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
        <title>Posada del Caos - Panel de administrador</title>
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/dist/css/AdminLTE.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/fonts/font-awesome/css/font-awesome.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>" type="text/css" />
    </head>
    
    <body role="document" class="layout-boxed skin-blue">
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
        
        <div class="wrapper bg-gray-light">
            
            <!-- INICIO CONTENIDO -->
            <div class="container">
                
                <section class="content-header">
                    <h1>Panel de administrador</h1>
                    <small>Gestión de datos</small>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('inicio') ?>"><i class="fa fa-home"></i>Inicio</a></li>
                        <li class="active">Panel de administrador</li>
                    </ol>
                </section>
                
                <section class="content">
                    
                    <!-- OPCIONES -->
                    <article class="box">
                        <div class="box-header with-border">
                            
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-4 col-xs-12">
                                    <div class="small-box cabecera1">
                                        <div class="inner">
                                            <h3 class="">JUEGOS</h3>
                                            <p>Gestionar</p>
                                        </div>
                                        <div class="icon"></i><i class="fa fa-gamepad"></i></div>
                                        <a href="<?= base_url('juegos') ?>" class="small-box-footer">Acceder <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 col-xs-12">
                                    <div class="small-box cabecera2">
                                        <div class="inner">
                                            <h3 class="">USUARIOS</h3>
                                            <p>Gestionar</p>
                                        </div>
                                        <div class="icon"></i><i class="fa fa-gamepad"></i></div>
                                        <a href="<?= base_url('usuarios') ?>" class="small-box-footer">Acceder <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 col-xs-12">
                                    <div class="small-box cabecera4">
                                        <div class="inner">
                                            <h3 class="">NOTICIAS</h3>
                                            <p>Gestionar</p>
                                        </div>
                                        <div class="icon"></i><i class="fa fa-gamepad"></i></div>
                                        <a href="<?= base_url('noticias/administrar_noticias') ?>" class="small-box-footer">Acceder <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    <!-- FIN OPCIONES -->
                    
                    <!-- INICIO ADMIN FORO -->
                    <article class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Foro</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                
                                <div class="col-lg-4 col-xs-6">
                                    <div class="small-box cabecera1">
                                        <div class="inner">
                                            <h3>SECCIONES</h3>
                                            <p>Gestionar secciones</p>
                                        </div>
                                        <div class="icon"><i class="fa fa-folder-open"></i></div>
                                        <a href="<?= base_url('foro/administrar_secciones') ?>" class="small-box-footer">Gestionar <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 col-xs-6">
                                    <div class="small-box cabecera2">
                                        <div class="inner">
                                            <h3>TEMAS</h3>
                                            <p>Gestionar temas</p>
                                        </div>
                                        <div class="icon"><i class="fa fa-comment"></i></div>
                                        <a href="<?= base_url('foro/administrar_temas') ?>" class="small-box-footer">Gestionar <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 col-xs-6">
                                    <div class="small-box cabecera3">
                                        <div class="inner">
                                            <h3>POSTS</h3>
                                            <p>Gestionar posts</p>
                                        </div>
                                        <div class="icon"><i class="fa fa-comments"></i></div>
                                        <a href="<?= base_url('foro/administrar_posts') ?>" class="small-box-footer">Gestionar <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    <!-- FIN ADMIN FORO -->
                </section>
                
            </div>
            <!-- FIN CONTENIDO -->
            
            <!-- INICIO ADMIN SIDEBAR -->
            <aside class="control-sidebar control-sidebar-dark">
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
        
        
        
        <!-- SCRIPTS -->
        <script src="<?= base_url('assets/js/jquery-1.113.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/js/app.min.js') ?>"></script>
        <!-- FIN SCRIPTS -->
    </body>
</html>