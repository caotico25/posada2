<!DOCTYPE html>
<html lang="ES">
    
    <head>
        <meta charset="UTF-8" />
        <title>Posada del Caos</title>
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/dist/css/AdminLTE.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/fonts/font-awesome/css/font-awesome.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap-toastr/toastr.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/select2.min.css') ?>" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>" type="text/css" />
        
    </head>
    
    <body role="document" class="layout-boxed">
        
        <div class="container bg-gray-light">
            
            <section class="content-header">
                <h1><?= $partida['nombre'] ?></h1>
                <ol class="breadcrumb">
                    <li><button class="btn btn-default" id="cerrar_partida">Cerrar partida</button></li>
                </ol>
            </section>
            
            <section class="content">
                
                <div class="box direct-chat direct-chat-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chat</h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body">
                        
                        <div id="charla" class="direct-chat-messages">
                            <?= $chat ?>
                        </div>
                        
                    </div>
                    <div class="box-footer">
                        <div class="input-group">
                            <input name="mensaje" id="mensaje" type="text" class="form-control" />
                            <span class="input-group-btn">
                                <button id="enviar_mensaje" class="btn btn-default btn-flat">Enviar</button>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div id="tablero" name="tablero" >
                    
                </div>
                
                <div id="ficha">
                    
                    <?php if ($partida['master'] == $this->session->userdata('usuario')['id']): ?>
                        
                        <div id="lista-jugadores" class="form-group row">
                            <label class="col-sm-3" for="jugadores">Selecciona personaje para ver su ficha:</label>
                            <div class="col-sm-3">
                                <select class="form-control input-sm" name="jugadores" id="jugadores">
                                    <option value=""></option>
                                    <?php foreach ($fichas as $ficha): ?>
                                        <option value="<?= $ficha['jugador']['id'] ?>"><?= $ficha['jugador']['usuario'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                                
                        </div>
                        
                    <?php endif ?>
                    
                    <div id="ficha_ajax" style="margin-top: 20px;">
                        <!-- RECORREMOS CADA UNA DE LAS TABLAS -->
                        <?php foreach ($datos_tablas as $tabla => $datos): ?>
                            
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?= $tabla ?></h3>
                                </div>
                                <div class="box-body">
                                    <!-- RECORREMOS CADA UNA DE LAS COLUMNAS -->
                                    <?php foreach ($datos as $dato): 
                                        $nombre = $dato->name;
                                        $tipo = $dato->type;
                                        ?>
                                        <!-- DESCARTAMOS LAS COLUMNAS DE SEGUIMIENTO -->
                                        <?php if ($nombre != 'id' && $nombre != 'partida' && $nombre != 'ficha'): ?>
                                            <div class="form-group col-sm-6">
                                                <label class="" for="<?= $nombre ?>"><?= $nombre ?></label>
                                                <div class="">
                                                    
                                                    <!-- SI ES DE TIPO VARCHAR -->
                                                    <?php if ($tipo == 'character varying'): ?>
                                                        <input class="form-control" type="text" maxlength="<?= $dato->max_length ?>" name="<?= $nombre ?>" value="" id="<?= $nombre ?>" data-tabla="<?= $tabla ?>" />
                                                    <?php elseif ($tipo == 'integer'): ?>
                                                        <input class="form-control" type="number" min="0" maxlength="<?= $dato->max_length ?>" name="<?= $nombre ?>" value="0" id="<?= $nombre ?>" data-tabla="<?= $tabla ?>" />
                                                    <?php elseif ($tipo == 'text'): ?>
                                                        <textarea name="<?= $nombre ?>" id="<?= $nombre ?>" class="form-control" data-tabla="<?= $tabla ?>"></textarea>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            
                        <?php endforeach ?>
                    </div>
                </div>
                
            </section>
            
        </div>
        
        <script src="<?= base_url('assets/js/jquery-1.113.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/jquery-rol.js') ?>" type="text/javascript" charset="utf-8"></script>
        <script src="<?= base_url('assets/plugins/select2/select2.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/select2/i18n/es.js') ?>"></script>
        <script>
            
            $(document).ready(function() {
                
                $("select").select2({
                    placeholder: "Seleccionar...",
                    language: "es"
                });
                
                var id_partida = <?= $partida['id'] ?>;
                var id_ficha = <?php if ($ficha_usuario == ''): echo "''"; else: $ficha_usuario; endif; ?>;
                
                // SI ES CLIENTE CARGAR DATOS EN FICHA
                <?php if (isset($datos_ficha)): ?>
                    <?php foreach ($datos_ficha as $dato): ?>
                        <?php foreach ($dato as $key => $value): ?>
                            <?php if ($value != null): ?>
                                <?php foreach ($value as $key => $value): ?>
                                    <?php if ($key != 'id' && $key != 'partida' && $key != 'ficha'): ?>
                                        // DAMOS EL VALOR RECIBIDO AL CAMPO CORRESPONDIENTE
                                        $("#<?= $key ?>").val('<?= $value ?>');
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endif ?>
                        <?php endforeach ?>
                    <?php endforeach ?>
                <?php endif ?>
                // DIN CARGA DATOS
                
                $(window).load(function() {
                    
                    $(this).mostrar_mesa("#tablero");
                    $('#charla').animate({scrollTop: $("#charla").height()}, 1000);
                    
                });
                
                // LANZA DADOS
                $("body").on("click", "#lanzar", function() {
                    
                    $(this).tirar_dados();
                    
                    var msj = $("#resultado").children(".res-chat").html();
                    
                    $.ajax({
                                
                        url: "<?= base_url('partidas/nuevo_mensaje') ?>",
                        type: "POST",
                        data: {'mensaje': msj, 'jugador': <?= $this->session->userdata('usuario')['id'] ?>, 'partida': id_partida},
                        success: function(chat) {
                            
                            $('#charla').html(chat);
                            
                            $('#charla').animate({scrollTop: $("#charla").height()}, 1000);
                            
                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            
                            alert(textStatus + ', ' + errorThrown + ', ' + jqXHR.status);
                            
                        }
                        
                    });
                    
                });
                // FIN DADOS
                
                // GUARDAR CAMBIOS ON BLUR
                $("#ficha_ajax").on("blur", "input[type!='button'], textarea", function() {
                    
                    var tabla = $(this).data("tabla");
                    var columna = $(this).attr("name");
                    var valor = $(this).val();
                    
                    $.ajax({
                        
                        url: "<?= base_url('partidas/editar_campo') ?>",
                        type: "POST",
                        data: { 'tabla': tabla, 'columna': columna, 'valor': valor, 'ficha': id_ficha, 'partida': id_partida },
                        success: function (){
                            
                            // PROBAR A NO HACER NADA
                            
                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            
                            alert(textStatus + ' ' + errorThrown);
                            
                        }
                        
                    });
                    
                    
                });
                // FIN CAMBIOS ON BLUR
                
                // ENVIA MENSAJE EN CHAT
                $("#mensaje").keyup(function(event) {
                    
                    var msj = $(this).val().trim();
                    
                    if (msj != '')
                    {
                        if (event.keyCode === 13)
                        {
                            
                            $.ajax({
                                
                                url: "<?= base_url('partidas/nuevo_mensaje') ?>",
                                type: "POST",
                                data: {'mensaje': msj, 'jugador': <?= $this->session->userdata('usuario')['id'] ?>, 'partida': id_partida},
                                success: function(chat) {
                                    
                                    $('#charla').html(chat);
                                    
                                    $('#charla').animate({scrollTop: $("#charla").height()}, 1000);
                                    
                                },
                                error: function (jqXHR, textStatus, errorThrown){
                                    
                                    alert(textStatus + ', ' + errorThrown + ', ' + jqXHR.status);
                                    
                                }
                                
                            });
                            
                            $(this).val('');
                        }
                    }
                    else
                    {
                        $(this).val('');
                    }
                    
                });
                // ENVIO MENSAJE AL PULSAR BOTON
                $("#enviar_mensaje").on('click', function() {
                    
                    var msj = $('#mensaje').val().trim();
                    
                    if (msj != '')
                    {
                            
                        $.ajax({
                            
                            url: "<?= base_url('partidas/nuevo_mensaje') ?>",
                            type: "POST",
                            data: {'mensaje': msj, 'jugador': <?= $this->session->userdata('usuario')['id'] ?>, 'partida': id_partida},
                            success: function(chat) {
                                
                                $('#charla').html(chat);
                                
                            },
                            error: function (jqXHR, textStatus, errorThrown){
                                
                                alert(textStatus + ', ' + errorThrown + ', ' + jqXHR.status);
                                
                            }
                            
                        });
                        
                        $('#mensaje').val('');
                        
                    }
                    else
                    {
                        $('#mensaje').val('');
                    }
                    
                });
                // FIN ENVIAR MENSAJE
                
                // FUNCION PARA CERRAR PARTIDA
                $("#cerrar_partida").on("click", function (){
                    
                    <?php if ($partida['master'] == $this->session->userdata('usuario')['id']): ?>
                    
                        $.ajax({
                            
                            url: "<?= base_url('partidas/cerrar_partida') ?>",
                            type: "POST",
                            data: {'partida': id_partida},
                            success: function (){
                                
                                $.ajax({
                            
                                    url: "<?= base_url('partidas/nuevo_mensaje') ?>",
                                    type: "POST",
                                    data: {'mensaje': '¡HE ABANDONADO LA PARTIDA!', 'jugador': <?= $this->session->userdata('usuario')['id'] ?>, 'partida': id_partida},
                                    success: function(chat) {
                                        
                                        window.close();
                                        
                                    },
                                    error: function (jqXHR, textStatus, errorThrown){
                                        
                                        alert(textStatus + ', ' + errorThrown + ', ' + jqXHR.status);
                                        
                                    }
                                    
                                });
                                
                            },
                            error: function (jqXHR, textStatus, errorThrown){
                                
                                alert(textStatus + ' ' + errorThrown);
                                
                            }
                            
                        });
                    <?php else: ?>
                        $.ajax({
                            
                            url: "<?= base_url('partidas/nuevo_mensaje') ?>",
                            type: "POST",
                            data: {'mensaje': '¡HE ABANDONADO LA PARTIDA!', 'jugador': <?= $this->session->userdata('usuario')['id'] ?>, 'partida': id_partida},
                            success: function(chat) {
                                
                                window.close();
                                
                            },
                            error: function (jqXHR, textStatus, errorThrown){
                                
                                alert(textStatus + ', ' + errorThrown + ', ' + jqXHR.status);
                                
                            }
                            
                        });
                    <?php endif ?>
                    
                });
                // FIN CERRAR PARTIDA
                
                // PARA EL MASTER. SELECCION DE JUGADOR
                $("#jugadores").on('change', function() {
                    
                    var jugador = $(this).val();
                    
                    $.ajax({
                        
                        url: "<?= base_url('partidas/obtener_ficha') ?>",
                        type: "POST",
                        data: {'partida': id_partida, 'jugador': jugador},
                        success: function (ficha){
                            
                            
                            $('#ficha_ajax').empty().html(ficha);
                            
                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            
                            alert(textStatus + ' ' + errorThrown);
                            
                        }
                        
                    });
                    
                });
                // FIN SELECCION JUGADOR
                
            });
            
        </script>
    </body>
</html>
