<?php 

require "init.php";

$message = "";

if ($_SERVER['REQUEST_METHOD'] === "POST")
{
    try {
        $price = $service->exit($_POST['plate']);
        $message = "Valor a pagar: R$ " . number_format($price, 2, ',', '.');
    } catch (Exception $exception) {
        $message = $exception->getMessage();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registrar Saída</title>
</head>
<body>

<h1>Registrar Saída</h1>

<p style="color: blue;"><?= $message ?></p>

<form method="post">
    <label>
        Placa:
        <input type="text" name="plate" required>
    </label>
    <br><br>

    <button type="submit">Registrar Saída</button>
</form>

<br>
<a href="index.php">Voltar</a>

</body>
</html>