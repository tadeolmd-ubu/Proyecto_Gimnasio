<?php
session_start();
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $nombre = trim($_POST['nombre']);
    $ap_paterno = trim($_POST['ap_paterno']);
    $ap_materno = trim($_POST['ap_materno']);
    $sexo = $_POST['sexo'];
    $fecha_nac = $_POST['fecha_nac'];
    $email = trim($_POST['email']);
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    $form_data = compact('usuario', 'nombre', 'ap_paterno', 'ap_materno', 'sexo', 'fecha_nac', 'email');

    if ($pass !== $confirm_pass) {
        $_SESSION['register_error'] = 'Las contraseñas no coinciden.';
        $_SESSION['register_data'] = $form_data;
        header("Location: ../index.php?view=register");
        exit();
    }

    if ($fecha_nac) {
        $nacimiento = new DateTime($fecha_nac);
        $hoy = new DateTime();
        $edad = $hoy->diff($nacimiento)->y;
        if ($nacimiento > $hoy) {
            $_SESSION['register_error'] = 'La fecha de nacimiento no puede ser futura.';
            $_SESSION['register_data'] = $form_data;
            header("Location: ../index.php?view=register");
            exit();
        }
        if ($edad < 10) {
            $_SESSION['register_error'] = 'Debes tener al menos 10 años para registrarte.';
            $_SESSION['register_data'] = $form_data;
            header("Location: ../index.php?view=register");
            exit();
        }
    }

    try {
        $stmtCheck = $conn->prepare("SELECT COUNT(*) FROM Usuario WHERE username = ? OR correo = ?");
        $stmtCheck->execute([$usuario, $email]);
        if ($stmtCheck->fetchColumn() > 0) {
            $_SESSION['register_error'] = 'El nombre de usuario o el correo ya están registrados.';
            $_SESSION['register_data'] = $form_data;
            header("Location: ../index.php?view=register");
            exit();
        }

        $conn->beginTransaction();

        $id_Rol_Cliente = 2;
        $sqlUsuario = "INSERT INTO Usuario (username, correo, contrasenia, id_Rol) VALUES (?, ?, ?, ?)";
        $stmtUsuario = $conn->prepare($sqlUsuario);
        $stmtUsuario->execute([$usuario, $email, $pass, $id_Rol_Cliente]);

        $lastIdUsuario = $conn->lastInsertId();

        $sqlCliente = "INSERT INTO Cliente (nombreCliente, apPatCliente, apMatCliente, fechaNac, sexo, id_Usuario) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtCliente = $conn->prepare($sqlCliente);
        $stmtCliente->execute([$nombre, $ap_paterno, $ap_materno, $fecha_nac, $sexo, $lastIdUsuario]);

        $conn->commit();

        $_SESSION['register_success'] = '¡Registro exitoso! Ahora puedes iniciar sesión.';
        header("Location: ../index.php");
        exit();

    } catch (PDOException $e) {
        if ($conn->inTransaction()) {
            $conn->rollBack();
        }
        $_SESSION['register_error'] = 'Error al registrar: ' . $e->getMessage();
        $_SESSION['register_data'] = $form_data;
        header("Location: ../index.php?view=register");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>
