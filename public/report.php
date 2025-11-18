<?php 

require "init.php";

$vehicles = $service->listAll();
$revenue = $service->getRevenue();

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
                <td>
                    <a href="delete.php?id=<?= $v->id ?>" 
                        onclick="return confirm('Tem certeza que deseja excluir?')">
                        Excluir
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<br><hr><br>

<h2>Faturamento Total</h2>

<p>
    Total arrecadado até agora: 
    <strong style="font-size: 20px;">
        R$ <?= number_format($revenue, 2, ',', '.') ?>
    </strong>
</p>

<br>
<a href="index.php">Voltar</a>

</body>
</html>