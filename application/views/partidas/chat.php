<?php foreach ($mensajes as $mensaje): ?>

    <?php if ($mensaje['jugador'] == $this->session->userdata('usuario')['id']): ?>
        <div class="direct-chat-msg right">
            <div class="direct-chat-info clear-fix" style="margin-bottom: 15px;">
                <span class="direct-chat-name pull-right"><?= $mensaje['usuario']['usuario'] ?></span>
            </div>
            <div class="direct-chat-text pull-right" style="width: 60%;">
                <?= $mensaje['mensaje'] ?>
            </div>
        </div>
    <?php else: ?>
        <div class="direct-chat-msg">
            <div class="direct-chat-info clear-fix">
                <span class="direct-chat-name pull-left"><?= $mensaje['usuario']['usuario'] ?></span>
            </div>
            <div class="direct-chat-text" style="width: 60%">
                <?= $mensaje['mensaje'] ?>
            </div>
        </div>
    <?php endif ?>
<?php endforeach ?>