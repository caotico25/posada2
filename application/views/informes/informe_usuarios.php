<h1>INFORME DE PARTIDAS</h1>
<table border="1">
    <tr>
        <th>USUARIO</th>
        <th>EMAIL</th>
        <th>Nº PARTIDAS MASTER</th>
        <th>Nº PARTIDAS PARTICIPA</th>
        <th>Nº POSTS</th>
    </tr>
    <?php foreach ($partidas as $partida): ?>
        <tr>
            <td><?= $partida['usuario'] ?></td>
            <td><?= $partida['email'] ?></td>
            <td><?= count($partida['partidas']) ?></td>
            <td><?= count($partida['fichas']) ?></td>
            <td><?= count($partida['posts']) ?></td>
        </tr>
    <?php endforeach ?>
</table>
