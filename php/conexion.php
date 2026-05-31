<?php
$serverName = "127.0.0.1"; // Servidor de XAMPP (TCP, evita error de socket)
$database = "BD_Gimnasio";
$username = "root"; // Usuario por defecto en phpMyAdmin XAMPP
$password = "root"; // Contraseña de root

try {
    // Conexión usando PDO para MySQL
    $conn = new PDO("mysql:host=$serverName;dbname=$database;charset=utf8", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>
