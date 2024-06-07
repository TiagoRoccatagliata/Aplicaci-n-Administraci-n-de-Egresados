<?php
$host = 'localhost';
$db = 'egresados_db';
$user = 'root';
$pass = 'root';
$socket = '/Applications/MAMP/tmp/mysql/mysql.sock'; // Ruta al socket

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4;unix_socket=$socket";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}