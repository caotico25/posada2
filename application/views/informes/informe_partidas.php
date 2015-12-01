<h1>INFORME DE PARTIDAS</h1>
<table border="1">
    <tr>
        <th>NOMBRE</th>
        <th>MASTER</th>
        <th>JUEGO</th>
        <th>ESTADO</th>
        <th>FECHA CREACION</th>
        <th>FECHA FIN</th>
    </tr>
    <?php foreach ($partidas as $partida): ?>
        <tr>
            <td><?= $partida['nombre'] ?></td>
            <td><?= $partida['master']['usuario'] ?></td>
            <td><?= $partida['juego']['nombre'] ?></td>
            <td><?= $partida['estado']['estado'] ?></td>
            <td><?= $partida['created_at'] ?></td>
            <td><?= $partida['deleted_at'] ?></td>
        </tr>
    <?php endforeach ?>
</table>
