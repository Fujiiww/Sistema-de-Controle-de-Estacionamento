<?php

require "init.php";

use App\Domain\Validator\PlateValidator;

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $plate = strtoupper(trim($_POST['plate']));

    if (!PlateValidator::isValid($plate)) {
        $message = "Placa inválida. Formatos permitidos: ABC1234 e ABC1D23.";
    } else {
        try {
            $service->enter($plate, $_POST['type']);
            $message = "Entrada registrada com sucesso!";
        } catch (Exception $exception) {
            $message = $exception->getMessage();
        }
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
        <input type="text" name="plate" 
            pattern="[A-Za-z]{3}-?[0-9]{4}|[A-Za-z]{3}[0-9][A-Za-z][0-9]{2}"
            title="Use ABC1234 ou ABC1D23"
            required>
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