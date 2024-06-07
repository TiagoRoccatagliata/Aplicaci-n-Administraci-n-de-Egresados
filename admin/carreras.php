<?php
session_start();
include '../includes/db.php';
include '../includes/functions.php';

redirect_if_not_logged_in();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $nombre = $_POST['nombre'];
        $stmt = $pdo->prepare("INSERT INTO carreras (nombre) VALUES (?)");
        $stmt->execute([$nombre]);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM carreras WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/public/styles.css">
    <title>Administrar Carreras</title>
    <nav>
        <a href="/public/registro.php">Registro de Egresados</a>
        <a href="/admin/login.php">Iniciar Sesión como Administrador</a>
    </nav>
</head>
<body>
<div class="container">
<h1>Administrar Carreras</h1>
<form action="carreras.php" method="post">
    <input type="text" name="nombre" required>
    <input type="submit" name="add" value="Agregar">
</form>
<h2>Lista de Carreras</h2>
<ul>
    <?php
    $stmt = $pdo->query("SELECT * FROM carreras");
    while ($row = $stmt->fetch()) {
        echo "<li>{$row['nombre']} <form action='carreras.php' method='post' style='display:inline;'>
                <input type='hidden' name='id' value='{$row['id']}'>
                <input type='submit' name='delete' value='Eliminar'>
            </form></li>";
    }
    ?>
</ul>
</div>
</body>
</html>