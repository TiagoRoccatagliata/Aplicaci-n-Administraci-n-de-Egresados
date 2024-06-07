<?php
include '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Egresados</title>
    <link rel="stylesheet" href="/public/styles.css" >
</head>
<body>
<div class="container">
<nav>
    <a href="/public/registro.php">Registro de Egresados</a>
    <a href="/admin/login.php">Iniciar Sesion como Administrador</a>
</nav>
<h1>Registro de Egresados</h1>
<form action="registro.php" method="post">
    <label for="nombre_apellido">Nombre y Apellido:</label>
    <input type="text" id="nombre_apellido" name="nombre_apellido" required><br>

    <label for="carrera_id">Carrera:</label>
    <select id="carrera_id" name="carrera_id" required>
        <?php
        $stmt = $pdo->query("SELECT * FROM carreras");
        while ($row = $stmt->fetch()) {
            echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
        }
        ?>
    </select><br>

    <label for="nro_matricula">Nro. de Matrícula:</label>
    <input type="text" id="nro_matricula" name="nro_matricula" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono" required><br>

    <input type="submit" value="Registrar">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_apellido = isset($_POST['nombre_apellido']) ? $_POST['nombre_apellido'] : '';
    $carrera_id = isset($_POST['carrera_id']) ? $_POST['carrera_id'] : '';
    $nro_matricula = isset($_POST['nro_matricula']) ? $_POST['nro_matricula'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';

    // Validar que todos los campos estén llenos
    if (empty($nombre_apellido) || empty($carrera_id) || empty($nro_matricula) || empty($email) || empty($telefono)) {
        echo "Todos los campos son obligatorios.";
    } else {
        // Insertar el egresado en la base de datos
        $stmt = $pdo->prepare("INSERT INTO egresados (nombre_apellido, carrera_id, nro_matricula, email, telefono) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$nombre_apellido, $carrera_id, $nro_matricula, $email, $telefono])) {
            // Enviar correo a las direcciones configuradas en la tabla emails_alertas
            $stmt = $pdo->query("SELECT email FROM emails_alertas");
            while ($row = $stmt->fetch()) {
                $to = $row['email'];
                $subject = "Nuevo Registro de Egresado";
                $message = "Se ha registrado un nuevo egresado:\n\nNombre: $nombre_apellido\nCarrera: $carrera_id\nNro. de Matrícula: $nro_matricula\nEmail: $email\nTeléfono: $telefono";
                $headers = "From: noreply@tuuniversidad.com";

                mail($to, $subject, $message, $headers);
            }

            echo "Registro exitoso!";
        } else {
            echo "Error al registrar el egresado.";
        }
    }
}
?>
</div>
</body>
</html>