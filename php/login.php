<?php
// ====================================================
// INICIO DE SESION
// ====================================================
// Este archivo recibe los datos del formulario de login,
// verifica las credenciales contra la base de datos y
// redirige al usuario segun su rol (admin, cliente, entrenador).
// ====================================================

session_start();
require_once 'conexion.php';

// Solo procesar peticiones POST (evitar acceso directo por GET)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);   // Puede ser username o correo
    $password = $_POST['password'];         // Contraseña en texto plano

    try {
        // Buscar al usuario por nombre de usuario o correo electronico
        $stmt = $conn->prepare("SELECT id_Usuario, username, id_Rol, contrasenia FROM Usuario WHERE username = ? OR correo = ?");
        $stmt->execute([$username, $username]);
        
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe y la contraseña coincide
        if ($usuario && $usuario['contrasenia'] === $password) {
            
            // Guardar datos basicos del usuario en la sesion
            $_SESSION['usuario_id'] = $usuario['id_Usuario'];
            $_SESSION['username'] = $usuario['username'];
            $_SESSION['id_Rol'] = $usuario['id_Rol'];   // 1=Admin, 2=Cliente, 3=Entrenador
            
            // Si es cliente (rol 2), obtener su nombre completo para mostrarlo en la interfaz
            if($usuario['id_Rol'] == 2) {
                $stmtCliente = $conn->prepare("SELECT nombreCliente, apPatCliente FROM Cliente WHERE id_Usuario = ?");
                $stmtCliente->execute([$usuario['id_Usuario']]);
                $cliente = $stmtCliente->fetch(PDO::FETCH_ASSOC);
                if($cliente) {
                    $_SESSION['nombre_completo'] = $cliente['nombreCliente'] . ' ' . $cliente['apPatCliente'];
                }
            }

            // Redirigir segun el rol del usuario
            if ($usuario['id_Rol'] == 1) {
                header("Location: admin_panel.php");    // Admin va al panel de control
            } else {
                header("Location: dashboard.php");      // Clientes y entrenadores van al dashboard
            }
            exit();

        } else {
            // Credenciales incorrectas: guardar error y volver al login
            $_SESSION['login_error'] = 'Usuario o contraseña incorrectos.';
            $_SESSION['login_username'] = $username;
            header("Location: ../index.php");
            exit();
        }

    } catch (PDOException $e) {
        die("Error en el login: " . $e->getMessage());
    }
} else {
    // Si alguien intenta acceder directo sin POST, redirigir al login
    header("Location: ../index.php");
    exit();
}
?>
