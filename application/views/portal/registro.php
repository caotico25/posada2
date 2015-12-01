<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
        <title>Posada del Caos - Registro</title>
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/dist/css/AdminLTE.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/fonts/font-awesome/css/font-awesome.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/plugins/iCheck/square/blue.css') ?>" type="text/css" />
    </head>
    <body>
        <div class="register-box bg-gray-light">
                <div class="login-logo">
                    <a href="<?= base_url('inicio') ?>">La Posada del Caos</a>
                </div>
    
            <div class="register-box-body">
                <p class="login-box-msg">Registro de nuevo usuario</p>
                <form action="<?= base_url('login/registrar') ?>" method="post">
                    <?php if (form_error('usuario') != ""): ?>
                        <div class="alert alert-danger">
                            <?= form_error('usuario') ?>
                        </div>
                    <?php endif ?>
                    <div class="form-group has-feedback">
                        <input name="usuario" id="usuario" type="text" class="form-control" placeholder="Nombre de usuario">
                        <span class="fa fa-user form-control-feedback"></span>
                    </div>
                    
                    <?php if (form_error('email') != ""): ?>
                        <div class="alert alert-danger">
                            <?= form_error('email') ?>
                        </div>
                    <?php endif ?>
                    <div class="form-group has-feedback">
                        <input name="email" id="email" type="email" class="form-control" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    
                    <?php if (form_error('passwd') != ""): ?>
                        <div class="alert alert-danger">
                            <?= form_error('passwd') ?>
                        </div>
                    <?php endif ?>
                    <div class="form-group has-feedback">
                        <input name="passwd" id="passwd" type="password" class="form-control" placeholder="Contraseña">
                        <span class="fa fa-lock form-control-feedback"></span>
                    </div>
                    
                    <?php if (form_error('re_passwd') != ""): ?>
                        <div class="alert alert-danger">
                            <?= form_error('re_passwd') ?>
                        </div>
                    <?php endif ?>
                    <div class="form-group has-feedback">
                        <input name="re_passwd" id="re_passwd" type="password" class="form-control" placeholder="Repetir contraseña">
                        <span class="fa fa-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                <input id="terms" type="checkbox"> Acepto los <a href="#">términos de uso</a>
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <button id="registrar" type="submit" class="btn btn-primary btn-block btn-flat">Registro</button>
                        </div>
                    </div>
                </form>
    
                <a href="<?= base_url('login') ?>" class="text-center">Ya tengo una cuenta</a>
            </div>
        </div>

        <script src="<?= base_url('assets/js/jquery-1.113.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/jquery.cookie.js') ?>"></script>
        <script src="<?= base_url('assets/dist/js/app.min.js') ?>"></script>
        <script src=" <?= base_url('assets/plugins/iCheck/icheck.min.js') ?>"></script>
        <script>
            $(function () {
                
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
                
                
                $("#registrar").on('click', function() {
                    
                    
                    
                });
                
                
                
                
            });
        </script>
    </body>
</html>
