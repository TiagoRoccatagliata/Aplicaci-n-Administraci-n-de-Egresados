<?php
session_start();
include '../includes/db.php';
include '../includes/functions.php';

redirect_if_not_logged_in();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="/public/styles.css">
    <nav>
        <a href="/public/registro.php">Registro de Egresados</a>
        <a href="login.php">Iniciar Sesion como Administrador</a>
    </nav>
</head>
<body>
<div class="container">
<h1>Panel de Administración</h1>
<nav>
    <ul>
        <li><a href="carreras.php">Administrar Carreras</a></li>
        <li><a href="emails.php">Administrar Emails</a></li>
        <li><a href="egresados.php">Administrar Egresados</a></li
        <li><a href="cambiar_contrasena.php">Cambiar Contraseña</a></li>
        <li><a href="logout.php">Cerrar Sesión</a></li>
    </ul>
</nav>
</div>
</body>
</html>

