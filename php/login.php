<?php
session_start();
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    try {
        // Buscar al usuario por nombre de usuario o correo
        $stmt = $conn->prepare("SELECT id_Usuario, username, id_Rol, contrasenia FROM Usuario WHERE username = ? OR correo = ?");
        $stmt->execute([$username, $username]);
        
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si existe y la contraseña coincide (actualmente en texto plano)
        if ($usuario && $usuario['contrasenia'] === $password) {
            
            // Iniciar variables de sesión
            $_SESSION['usuario_id'] = $usuario['id_Usuario'];
            $_SESSION['username'] = $usuario['username'];
            $_SESSION['id_Rol'] = $usuario['id_Rol'];
            
            // Buscar datos del cliente si es que es cliente
            if($usuario['id_Rol'] == 2) {
                $stmtCliente = $conn->prepare("SELECT nombreCliente, apPatCliente FROM Cliente WHERE id_Usuario = ?");
                $stmtCliente->execute([$usuario['id_Usuario']]);
                $cliente = $stmtCliente->fetch(PDO::FETCH_ASSOC);
                if($cliente) {
                    $_SESSION['nombre_completo'] = $cliente['nombreCliente'] . ' ' . $cliente['apPatCliente'];
                }
            }

            // Redirigir al dashboard
            header("Location: dashboard.php");
            exit();

        } else {
            $_SESSION['login_error'] = 'Usuario o contraseña incorrectos.';
            $_SESSION['login_username'] = $username;
            header("Location: ../index.php");
            exit();
        }

    } catch (PDOException $e) {
        die("Error en el login: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>
