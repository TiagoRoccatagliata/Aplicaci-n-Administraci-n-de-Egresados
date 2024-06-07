<?php
session_start();
include '../includes/db.php';
include '../includes/functions.php';

redirect_if_not_logged_in();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = md5($_POST['password']);
    $id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("UPDATE administradores SET password = ? WHERE id = ?");
    $stmt->execute([$password, $id]);

    echo "Contraseña cambiada exitosamente";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="/public/styles.css">
    <nav>
        <a href="/public/registro.php">Registro de Egresados</a>
        <a href="/admin/login.php">Iniciar Sesión como Administrador</a>
    </nav>
</head>
<body>
<div class="container">
<h1>Cambiar Contraseña</h1>
<form action="cambiar_contrasena.php" method="post">
    <label for="password">Nueva Contraseña:</label>
    <input type="password" id="password" name="password" required><br>
    <input type="submit" value="Cambiar">
</form>
</div>
</body>
</html>