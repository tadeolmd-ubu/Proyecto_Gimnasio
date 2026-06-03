<?php
// ====================================================
// REGISTRO DE NUEVOS CLIENTES
// ====================================================
// Procesa el formulario de registro. Crea un usuario con
// rol Cliente y su correspondiente registro en la tabla
// Cliente. Incluye validaciones de edad, duplicados y
// confirmacion de contraseña. Usa transacciones para
// asegurar que ambos inserts se completen o se reviertan.
// ====================================================

session_start();
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar los datos del formulario
    $usuario = trim($_POST['usuario']);
    $nombre = trim($_POST['nombre']);
    $ap_paterno = trim($_POST['ap_paterno']);
    $ap_materno = trim($_POST['ap_materno']);
    $sexo = $_POST['sexo'];
    $fecha_nac = $_POST['fecha_nac'];
    $email = trim($_POST['email']);
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    // Guardar los datos del formulario para rellenarlos en caso de error
    $form_data = compact('usuario', 'nombre', 'ap_paterno', 'ap_materno', 'sexo', 'fecha_nac', 'email');

    // Validar que las contraseñas coincidan
    if ($pass !== $confirm_pass) {
        $_SESSION['register_error'] = 'Las contraseñas no coinciden.';
        $_SESSION['register_data'] = $form_data;
        header("Location: ../index.php?view=register");
        exit();
    }

    // Validar fecha de nacimiento: no futura y edad minima de 10 años
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
        // Verificar que el nombre de usuario o correo no esten duplicados
        $stmtCheck = $conn->prepare("SELECT COUNT(*) FROM Usuario WHERE username = ? OR correo = ?");
        $stmtCheck->execute([$usuario, $email]);
        if ($stmtCheck->fetchColumn() > 0) {
            $_SESSION['register_error'] = 'El nombre de usuario o el correo ya están registrados.';
            $_SESSION['register_data'] = $form_data;
            header("Location: ../index.php?view=register");
            exit();
        }

        // Iniciar transaccion para insertar en Usuario y Cliente
        $conn->beginTransaction();
        $id_Rol_Cliente = 2;  // Rol Cliente

        // Insertar en la tabla Usuario
        $sqlUsuario = "INSERT INTO Usuario (username, correo, contrasenia, id_Rol) VALUES (?, ?, ?, ?)";
        $stmtUsuario = $conn->prepare($sqlUsuario);
        $stmtUsuario->execute([$usuario, $email, $pass, $id_Rol_Cliente]);
        $lastIdUsuario = $conn->lastInsertId();

        // Insertar en la tabla Cliente con el ID del usuario recien creado
        $sqlCliente = "INSERT INTO Cliente (nombreCliente, apPatCliente, apMatCliente, fechaNac, sexo, id_Usuario) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtCliente = $conn->prepare($sqlCliente);
        $stmtCliente->execute([$nombre, $ap_paterno, $ap_materno, $fecha_nac, $sexo, $lastIdUsuario]);

        // Confirmar la transaccion
        $conn->commit();
        $_SESSION['register_success'] = '¡Registro exitoso! Ahora puedes iniciar sesión.';
        header("Location: ../index.php");
        exit();
    } catch (PDOException $e) {
        // Si algo falla, revertir la transaccion
        if ($conn->inTransaction()) {
            $conn->rollBack();
        }
        $_SESSION['register_error'] = 'Error al registrar: ' . $e->getMessage();
        $_SESSION['register_data'] = $form_data;
        header("Location: ../index.php?view=register");
        exit();
    }
} else {
    // Acceso directo sin POST: redirigir al formulario
    header("Location: ../index.php");
    exit();
}
?>
