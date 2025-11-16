<?php

require "init.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    try {
        $service ->enter($_POST['plate'], $_POST['type']);
        $message = "Entrada registrada com sucesso! ";
    } catch (Exception $exception) {
        $message = $exception->getMessage();
    } 
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registrar Entrada</title>
</head>
<body>

<h1>Registrar Entrada</h1>

<p style="color: green;"><?= $message ?></p>

<form method="post">
    <label>
        Placa: 
        <input type="text" name="plate" required>
    </label>
    <br><br>

    <label>
        Tipo:
        <select name="type">
            <option value="car">Carro</option>
            <option value="motorcycle">Moto</option>
            <option value="truck">Caminhão</option>
        </select>
    </label>

    <br><br>
    <button type="submit">Registrar</button>
</form>

<br>
<a href="index.php">Voltar</a>

</body>
</html>