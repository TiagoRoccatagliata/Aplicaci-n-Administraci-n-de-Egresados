<?php
session_start();
include '../includes/db.php';
include '../includes/functions.php';

redirect_if_not_logged_in();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm'])) {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("UPDATE egresados SET confirmado = 1 WHERE id = ?");
        $stmt->execute([$id]);
    } elseif (isset($_POST['reject'])) {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM egresados WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrar Egresados</title>
    <link rel="stylesheet" href="/public/styles.css">
    <nav>
        <a href="/public/registro.php">Registro de Egresados</a>
        <a href="/admin/login.php">Iniciar Sesión como Administrador</a>

    </nav>
</head>
<body>
<div class="container">
<h1>Administrar Egresados</h1>
<h2>Solicitudes Pendientes</h2>
<ul>
    <?php
    $stmt = $pdo->query("SELECT * FROM egresados WHERE confirmado = 0");
    while ($row = $stmt->fetch()) {
        echo "<li>{$row['nombre_apellido']} ({$row['email']}) <form action='egresados.php' method='post' style='display:inline;'>
                <input type='hidden' name='id' value='{$row['id']}'>
                <input type='submit' name='confirm' value='Confirmar'>
                <input type='submit' name='reject' value='Rechazar'>
            </form></li>";
    }
    ?>
</ul>
<h2>Lista de Egresados</h2>
<ul>
    <?php
    $stmt = $pdo->query("SELECT * FROM egresados WHERE confirmado = 1");
    while ($row = $stmt->fetch()) {
        echo "<li>{$row['nombre_apellido']} ({$row['email']} - {$row['telefono']})</li>";
    }
    ?>
</ul>
</div>
</body>
</html>