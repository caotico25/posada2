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

<script src="<?= base_url('assets/js/jquery-1.113.min.js') ?>"></script>
<script type="text/javascript" charset="utf-8">
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
</script>