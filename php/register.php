<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Recibir y sanitizar los datos del formulario
    $usuario = trim($_POST['usuario']);
    $nombre = trim($_POST['nombre']);
    $ap_paterno = trim($_POST['ap_paterno']);
    $ap_materno = trim($_POST['ap_materno']);
    $sexo = $_POST['sexo'];
    $fecha_nac = $_POST['fecha_nac'];
    $email = trim($_POST['email']);
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    // 2. Validaciones básicas
    if ($pass !== $confirm_pass) {
        die("<script>alert('Las contraseñas no coinciden.'); window.history.back();</script>");
    }

    try {
        // Verificar si el usuario o correo ya existen
        $stmtCheck = $conn->prepare("SELECT COUNT(*) FROM Usuario WHERE username = ? OR correo = ?");
        $stmtCheck->execute([$usuario, $email]);
        if ($stmtCheck->fetchColumn() > 0) {
            die("<script>alert('El nombre de usuario o el correo ya están registrados.'); window.history.back();</script>");
        }

        // Iniciar transacción
        $conn->beginTransaction();

        // 3. Insertar en Usuario (id_Rol = 2 para Cliente)
        $id_Rol_Cliente = 2;
        $sqlUsuario = "INSERT INTO Usuario (username, correo, contrasenia, id_Rol) VALUES (?, ?, ?, ?)";
        $stmtUsuario = $conn->prepare($sqlUsuario);
        $stmtUsuario->execute([$usuario, $email, $pass, $id_Rol_Cliente]);

        // 4. Obtener el id_Usuario generado por AUTO_INCREMENT
        $lastIdUsuario = $conn->lastInsertId();

        // 5. Insertar en Cliente
        $sqlCliente = "INSERT INTO Cliente (nombreCliente, apPatCliente, apMatCliente, fechaNac, sexo, id_Usuario) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtCliente = $conn->prepare($sqlCliente);
        $stmtCliente->execute([$nombre, $ap_paterno, $ap_materno, $fecha_nac, $sexo, $lastIdUsuario]);

        // Confirmar la transacción
        $conn->commit();

        header("Location: ../index.php");
        exit();

    } catch (PDOException $e) {
        // En caso de error, revertir los cambios si hay una transacción activa
        if ($conn->inTransaction()) {
            $conn->rollBack();
        }
        die("Error al registrar: " . $e->getMessage());
    }
} else {
    // Si no es POST, redirigir al index
    header("Location: ../index.php");
    exit();
}
?>
