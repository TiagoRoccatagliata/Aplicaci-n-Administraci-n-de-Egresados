<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM administradores WHERE username = ? AND password = ?");
    $stmt->execute([$username, $password]);
    $admin = $stmt->fetch();

    if ($admin) {
        $_SESSION['user_id'] = $admin['id'];
        header('Location: index.php');
        exit;
    } else {
        $error = "Credenciales incorrectas";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/public/styles.css" >
    <title>Inicar Sesion como Administrdor</title>
</head>
<body>
<div class="container">
<nav>
    <a href="/public/registro.php">Registro de Egresados</a>
    <a href="login.php">Iniciar Sesion como Administrador</a>
</nav>
<h1>Inicar Sesion como Administrador</h1>
<form action="login.php" method="post">
    <label for="username">Usuario:</label>
    <input type="text" id="username" name="username" required><br>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="submit" value="Ingresar">
</form>
<?php if (isset($error)) { echo "<p>$error</p>"; } ?>
</div>
</body>

</html>
