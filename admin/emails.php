<?php
session_start();
include '../includes/db.php';
include '../includes/functions.php';

redirect_if_not_logged_in();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $email = $_POST['email'];
        $stmt = $pdo->prepare("INSERT INTO emails_alertas (email) VALUES (?)");
        $stmt->execute([$email]);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM emails_alertas WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Emails</title>
    <link rel="stylesheet" href="/public/styles.css">
</head>
<body>
<div class="container">
    <nav>

        <a href="registro.php">Registro de Egresados</a>
        <a href="login.php">Iniciar Sesión como Administrador</a>

    </nav>
    <h1>Administrar Emails</h1>
    <form action="admin_abm_emails.php" method="post">
        <input type="email" name="email" required>
        <input type="submit" name="add" value="Agregar">
    </form>
    <h2>Lista de Emails para Alertas</h2>
    <ul>
        <?php
        $stmt = $pdo->query("SELECT * FROM emails_alertas");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<li>{$row['email']} <form action='admin_abm_emails.php' method='post' style='display:inline;'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <input type='submit' name='delete' value='Eliminar'>
                    </form></li>";
        }
        ?>
    </ul>

    <h2>Lista de Emails de Egresados</h2>
    <table>
        <thead>
        <tr>
            <th>Email</th>
            <th>Nombre y Apellido</th>
            <th>Carrera</th>
            <th>Teléfono</th>
        </tr>
        </thead>
        <tbody>
        <?php
        try {
            $stmt = $pdo->query("SELECT e.email, e.nombre_apellido, c.nombre AS carrera, e.telefono 
                                         FROM egresados e 
                                         JOIN carreras c ON e.carrera_id = c.id");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['nombre_apellido']}</td>";
                echo "<td>{$row['carrera']}</td>";
                echo "<td>{$row['telefono']}</td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            echo "Error al recuperar emails: " . $e->getMessage();
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>