<!DOCTYPE html>

<html>
    
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
        <title>Posada del Caos - Login</title>
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/dist/css/AdminLTE.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/fonts/font-awesome/css/font-awesome.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/plugins/iCheck/square/blue.css') ?>" type="text/css" />
    </head>
    
    <body>
        
        <!-- INICIO LOGIN BOX -->
        <div class="login-box bg-gray-light">
            <div class="login-logo">
                <a href="<?= base_url('inicio') ?>">La Posada del Caos</a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Logueate para empezar a rolear</p>
                
                <!-- FORMULARIO DE LOGIN -->
                
                <div id="error-usuario" class="alert alert-danger" style="display: none;">
                </div>
                <div class="form-group has-feedback">
                    <input name="usuario" id="usuario" type="text" class="form-control" placeholder="Usuario">
                    <span class="fa fa-user form-control-feedback"></span>
                </div>
                
                <div id="error-passwd" class="alert alert-danger" style="display: none;">
                </div>
                <div class="form-group has-feedback">
                    <input name="passwd" id="passwd" type="password" class="form-control" placeholder="Contraseña">
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>
                
                <div class="row">
                    <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                        <input id="recordar" type="checkbox"> Recordarme
                        </label>
                    </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                    <button id="login" type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                    </div><!-- /.col -->
                </div>
                <!-- FIN FORMULARIO DE LOGIN -->
                
                <!-- <a href="<?= base_url('login/recordar') ?>">Olvidé mi contraseña</a><br> -->
                <a href="<?= base_url('login/registrar') ?>" class="text-center">Aún no soy miembro</a>
    
            </div><!-- /.login-box-body -->
        </div>
        <!-- FIN LOGIN BOX -->
        
        <!-- SCRIPTS -->
        <script src="<?= base_url('assets/js/jquery-1.113.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/jquery.cookie.js') ?>"></script>
        <script src="<?= base_url('assets/dist/js/app.min.js') ?>"></script>
        <script src=" <?= base_url('assets/plugins/iCheck/icheck.min.js') ?>"></script>
        <script>
            $(function() {
                
                // CHECKBOX RECORDAR
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue'
                });
                // FIN CHECKBOX RECORDAR
                
                
                // COMPROBAR COOKIES
                // COMPROBAMOS SI EXISTEN COOKIE CON NOMBRE DE USUARIO (LA PASS NO LA RECORDAMOS POR SEGURIDAD)
                if ($.cookie('usuario'))
                {
                    $("#usuario").val($.cookie('usuario'));
                }
                // FIN COMPROBAR COOKIES
                
                
                // COMPROBAMOS QUE EL USUARIO EXISTE
                $("#login").on("click", function() {
                    
                    var usuario = $("#usuario").val();
                    var passwd = $("#passwd").val();
                    
                    $.ajax({
                        
                        type: "POST",
                        url: "<?= base_url('login/acceso') ?>",
                        data: {
                                'usuario': usuario,
                                'passwd': passwd
                            },
                        success: function(respuesta) {
                            
                            if (respuesta != "ok")
                            {
                                var respuesta = eval(respuesta);
                                
                                // VACIAMOS Y OCULTAMOS LOS CAMPOS DE ERROR SI LOS HUBIERA
                                $("div .alert").each(function(index) {
                                    
                                    var p = $(this).children("p");
                                    p.remove();
                                    
                                    $(this).hide();
                                    
                                });
                                
                                var errores = respuesta.split('\n');
                                
                                $.each(errores, function(i, error) {
                                    
                                    if (/Usuario/.test(error))
                                    {
                                        $("#error-usuario").show().append(error);
                                    }
                                    
                                    if (/Contraseña/.test(error))
                                    {
                                        $("#error-passwd").show().append(error);
                                    }
                                    
                                });
                            }
                            else
                            {
                                // GUARDAR DATOS CLIENTE EN COOKIE
                                $.cookie('usuario', usuario);
                                
                                location.href = "<?= base_url('inicio') ?>";
                            }
                            
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            
                            //toastr.error(textStatus, errorThrown);
                            
                        }
                        
                    });
                    
                });
                // FIN DE COMPROBACION DE USUARIO
                
            });
        </script>
        <!-- FIN SCRIPTS -->
    </body>
</html>