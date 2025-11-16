<?php 

require "init.php";

use App\Domain\Validator\PlateValidator;

$message = "";

if ($_SERVER['REQUEST_METHOD'] === "POST")
{
        $plate = strtoupper(trim($_POST['plate']));

    if (!PlateValidator::isValid($plate)) {
        $message = "Placa inválida. Formatos permitidos: ABC1234 e ABC1D23.";
    } else {
        try {
            $price = $service->exit($_POST['plate']);
            $message = "Valor a pagar: R$ " . number_format($price, 2, ',', '.');
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
    <title>Registrar Saída</title>
</head>
<body>

<h1>Registrar Saída</h1>

<p style="color: blue;"><?= $message ?></p>

<form method="post">
    <label>
        Placa:
         <input type="text" name="plate" 
            pattern="[A-Za-z]{3}-?[0-9]{4}|[A-Za-z]{3}[0-9][A-Za-z][0-9]{2}"
            title="Use ABC1234 ou ABC1D23"
            required>
    </label>
    <br><br>

    <button type="submit">Registrar Saída</button>
</form>

<br>
<a href="index.php">Voltar</a>

</body>
</html>