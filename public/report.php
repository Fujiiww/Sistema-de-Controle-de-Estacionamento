<?php 

require "init.php";

$vehicles = $service->listAll();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Relatório de Veículos</title>
</head>
<body>

<h1>Relatório de Veículos</h1>

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Placa</th>
            <th>Tipo</th>
            <th>Entrada</th>
            <th>Saída</th>
            <th>Valor Pago</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($vehicles as $v): ?>
            <tr>
                <td><?= $v->id ?></td>
                <td><?= $v->plate ?></td>
                <td><?= $v->type ?></td>
                <td><?= $v->entryAt->format('d/m/Y H:i:s') ?></td>
                <td><?= $v->exitAt ? $v->exitAt->format('d/m/Y H:i:s') : '-' ?></td>
                <td>R$ <?= number_format($v->pricePaid, 2, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br>
<a href="index.php">Voltar</a>

</body>
</html>