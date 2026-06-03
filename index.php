<?php
session_start();
if(isset($_SESSION['usuario_id'])) {
    if ($_SESSION['id_Rol'] == 1) {
        header("Location: php/admin_panel.php");
    } else {
        header("Location: php/dashboard.php");
    }
    exit();
}

$login_error = $_SESSION['login_error'] ?? null;
$login_username = $_SESSION['login_username'] ?? '';
unset($_SESSION['login_error'], $_SESSION['login_username']);

$register_success = $_SESSION['register_success'] ?? null;
$register_error = $_SESSION['register_error'] ?? null;
$register_data = $_SESSION['register_data'] ?? [];
unset($_SESSION['register_success'], $_SESSION['register_error'], $_SESSION['register_data']);

$show_register = isset($_GET['view']) && $_GET['view'] === 'register';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STEELYCO GYM | Iniciar Sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/zona_pierna.jpg') no-repeat center center/cover;
            padding: 20px;
        }
        .auth-container {
            width: 100%;
            max-width: 500px;
        }
        .modal-content {
            position: relative;
            transform: none;
            top: 0; left: 0;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        #registerView {
            display: none;
        }
        .login-error-msg {
            background-color: rgba(255, 51, 102, 0.15);
            border: 1px solid rgba(255, 51, 102, 0.3);
            color: #ff3366;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .field-error {
            color: #ff3366;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 4px;
            display: none;
        }
        .field-error.visible { display: block; }
        .register-success-msg {
            background-color: rgba(0, 240, 255, 0.15);
            border: 1px solid rgba(0, 240, 255, 0.3);
            color: var(--primary-color);
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- Pantalla de Login -->
        <div class="modal-content" id="loginView" <?= $show_register ? 'style="display:none"' : '' ?>>
            <div style="text-align: center; margin-bottom: 20px;">
                <a href="#" class="logo" style="font-size: 2.5rem;">STEELYCO<span>GYM</span></a>
            </div>
            <h2>Iniciar Sesión</h2>
            <p>Accede a tu panel de usuario</p>

            <?php if ($register_success): ?>
                <div class="register-success-msg"><?= htmlspecialchars($register_success) ?></div>
            <?php endif; ?>

            <?php if ($login_error): ?>
                <div class="login-error-msg"><?= htmlspecialchars($login_error) ?></div>
            <?php endif; ?>
            
            <form method="POST" action="php/login.php">
                <div class="input-group">
                    <label for="username">Usuario o Correo Electrónico</label>
                    <input type="text" id="username" name="username" placeholder="Usuario o Correo Electrónico" value="<?= htmlspecialchars($login_username) ?>" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="********" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                </div>
                <div class="form-link">
                    ¿No tienes cuenta? <a href="#" id="showRegister">Regístrate aquí</a>
                </div>
            </form>
        </div>

        <!-- Pantalla de Registro -->
        <div class="modal-content" id="registerView" <?= $show_register ? '' : 'style="display:none"' ?>>
            <div style="text-align: center; margin-bottom: 20px;">
                <a href="#" class="logo" style="font-size: 2.5rem;">STEELYCO<span>GYM</span></a>
            </div>
            <h2>Crear Cuenta</h2>
            <p>Únete a la familia STEELYCO GYM</p>

            <?php if ($register_error): ?>
                <div class="login-error-msg"><?= htmlspecialchars($register_error) ?></div>
            <?php endif; ?>
            
            <form method="POST" action="php/register.php">
                <div class="input-group">
                    <label>Usuario</label>
                    <input type="text" name="usuario" placeholder="Tu usuario" value="<?= htmlspecialchars($register_data['usuario'] ?? '') ?>" required>
                </div>
                <div class="input-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" placeholder="Tu nombre" value="<?= htmlspecialchars($register_data['nombre'] ?? '') ?>" required>
                </div>
                
                <div class="input-row">
                    <div class="input-group">
                        <label>Apellido Paterno</label>
                        <input type="text" name="ap_paterno" placeholder="Paterno" value="<?= htmlspecialchars($register_data['ap_paterno'] ?? '') ?>" required>
                    </div>
                    <div class="input-group">
                        <label>Apellido Materno</label>
                        <input type="text" name="ap_materno" placeholder="Materno" value="<?= htmlspecialchars($register_data['ap_materno'] ?? '') ?>">
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label>Sexo</label>
                        <select name="sexo" required>
                            <option value="">Selecciona...</option>
                            <option value="M" <?= ($register_data['sexo'] ?? '') === 'M' ? 'selected' : '' ?>>Masculino</option>
                            <option value="F" <?= ($register_data['sexo'] ?? '') === 'F' ? 'selected' : '' ?>>Femenino</option>
                            <option value="Otro" <?= ($register_data['sexo'] ?? '') === 'Otro' ? 'selected' : '' ?>>Otro</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nac" id="fechaNac" value="<?= htmlspecialchars($register_data['fecha_nac'] ?? '') ?>" required>
                        <div class="field-error"></div>
                    </div>
                </div>

                <div class="input-group">
                    <label>Correo Electrónico</label>
                    <input type="email" name="email" placeholder="correo@ejemplo.com" value="<?= htmlspecialchars($register_data['email'] ?? '') ?>" required>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label>Contraseña</label>
                        <input type="password" name="password" placeholder="********" required>
                    </div>
                    <div class="input-group">
                        <label>Confirmar Contraseña</label>
                        <input type="password" name="confirm_password" placeholder="********" required>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-block">Registrarme</button>
                </div>
                <div class="form-link">
                    ¿Ya tienes cuenta? <a href="#" id="showLogin">Inicia Sesión</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('showRegister').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('loginView').style.display = 'none';
            document.getElementById('registerView').style.display = 'block';
        });

        document.getElementById('showLogin').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('registerView').style.display = 'none';
            document.getElementById('loginView').style.display = 'block';
        });

        document.querySelector('#registerView form').addEventListener('submit', function(e) {
            const fechaInput = document.getElementById('fechaNac');
            const errorEl = fechaInput.nextElementSibling;
            errorEl.classList.remove('visible');

            if (!fechaInput.value) return;

            const fecha = new Date(fechaInput.value);
            const hoy = new Date();
            let edad = hoy.getFullYear() - fecha.getFullYear();
            const mes = hoy.getMonth() - fecha.getMonth();
            if (mes < 0 || (mes === 0 && hoy.getDate() < fecha.getDate())) edad--;

            if (fecha > hoy) {
                e.preventDefault();
                errorEl.textContent = 'La fecha no puede ser futura.';
                errorEl.classList.add('visible');
            } else if (edad < 10) {
                e.preventDefault();
                errorEl.textContent = 'Debes tener al menos 10 años.';
                errorEl.classList.add('visible');
            }
        });
    </script>
</body>
</html>
