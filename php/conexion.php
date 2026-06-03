<?php
// ====================================================
// CONEXION A LA BASE DE DATOS
// ====================================================
// Este archivo establece la conexion con MySQL usando PDO.
// Es incluido por todos los archivos que necesitan BD.
// ====================================================

$serverName = "localhost";   // Servidor de la base de datos
$database = "BD_Gimnasio";   // Nombre de la base de datos
$username = "admin_gym";     // Usuario de MySQL
$password = "gym2024";       // Contraseña de MySQL

try {
    // Crear conexion PDO con charset utf8 para soportar acentos y caracteres especiales
    $conn = new PDO("mysql:host=$serverName;dbname=$database;charset=utf8", $username, $password);
    // Configurar PDO para que lance excepciones en caso de error
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si falla la conexion, mostrar mensaje de error y detener la ejecucion
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>
