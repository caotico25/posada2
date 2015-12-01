<h1>INFORME DE PARTIDAS</h1>
<table border="1">
    <tr>
        <th>NOMBRE</th>
        <th>DESCRIPCION</th>
        <th>ESTADO</th>
    </tr>
    <?php foreach ($partidas as $partida): ?>
        <tr>
            <td><?= $partida['nombre'] ?></td>
            <td><?= $partida['descripcion'] ?></td>
            <td><?php if ($partida['deleted'] == 't') { echo 'Eliminado'; } else{ echo 'Activo'; } ?></td>
        </tr>
    <?php endforeach ?>
</table>
