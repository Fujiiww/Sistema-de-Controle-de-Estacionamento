<?php
require "init.php";

if (!isset($_GET['id'])) {
    die("ID não informado.");
}

try {
    $repo->delete((int) $_GET['id']);
    header("Location: report.php?deleted=1");
    exit;
} catch (Exception $e) {
    echo "Erro ao excluir: " . $e->getMessage();
}
