<?php
$serverName = "127.0.0.1";
$database = "BD_Gimnasio";
$username = "root";
$password = "root";
try {
    $conn = new PDO("mysql:host=$serverName;dbname=$database;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>
