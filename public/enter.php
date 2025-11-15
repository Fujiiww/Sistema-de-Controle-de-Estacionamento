<?php

require "init.php";

$message = "";

if ($SERVER["REQUEST_METHOD"] === "POST")
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