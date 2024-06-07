<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <style>
        nav {
            margin-bottom: 20px;
        }
        nav a {
            margin-right: 10px;
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    <nav>
        <a href="/public/index.php">Inicio</a>
        <a href="registro.php">Registro de Egresados</a>
        <a href="login.php">Iniciar Sesión como Administrador</a>
        <a href="admin_panel.php">Panel de Administración</a>
        <a href="admin_abm_emails.php">Administrar Emails</a>
        <a href="admin_abm_carreras.php">Administrar Carreras</a>
        <a href="admin_confirmar_egresados.php">Confirmar/Rechazar Egresados</a>
        <a href="admin_listado_egresados.php">Listado de Egresados</a>
        <a href="admin_cambiar_password.php">Cambiar Contraseña</a>
    </nav>
<h1>Panel de Administración</h1>
<p>Bienvenido, administrador.</p>
<ul>
    <li><a href="admin_abm_emails.php">Administrar Emails</a></li>
    <li><a href="admin_abm_carreras.php">Administrar Carreras</a></li>
    <li><a href="admin_confirmar_egresados.php">Confirmar/Rechazar Egresados</a></li>
    <li><a href="admin_listado_egresados.php">Listado de Egresados</a></li>
    <li><a href="admin_cambiar_password.php">Cambiar Contraseña</a></li>
</ul>
</body>
</html>