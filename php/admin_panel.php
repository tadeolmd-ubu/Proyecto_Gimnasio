<?php
// ====================================================
// PANEL DE ADMINISTRADOR
// ====================================================
// Interfaz de gestion de clientes y entrenadores.
// Solo accesible para usuarios con rol Administrador (id_Rol=1).
// Permite crear, listar, editar y eliminar registros
// mediante procedimientos almacenados.
// ====================================================

session_start();

// Verificar que el usuario sea administrador
if (!isset($_SESSION['usuario_id']) || $_SESSION['id_Rol'] != 1) {
    header("Location: ../index.php");
    exit();
}
require_once 'conexion.php';

$mensaje = '';
$mensaje_tipo = '';
$is_ajax = isset($_POST['ajax']) && $_POST['ajax'] == '1';

// Funcion auxiliar para ejecutar procedimientos almacenados y capturar errores
function ejecutarProcedimiento($conn, $sql, $params = []) {
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $stmt->closeCursor();  // Importante: cerrar el cursor para liberar la conexion
        return true;
    } catch (Exception $e) {
        return $e->getMessage();  // Devuelve el mensaje de error del SP
    }
}

// Procesar las acciones CRUD enviadas por formulario o AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'create_cliente') {
        $resultado = ejecutarProcedimiento($conn, "CALL sp_insertar_cliente(?,?,?,?,?,?,?,?)", [
            $_POST['username'], $_POST['correo'], $_POST['contrasenia'],
            $_POST['nombre'], $_POST['apPat'], $_POST['apMat'] ?? '',
            $_POST['fechaNac'], $_POST['sexo']
        ]);
        if ($resultado === true) {
            $mensaje = 'Cliente creado exitosamente.';
            $mensaje_tipo = 'success';
        } else {
            $mensaje = 'Error al crear cliente: ' . $resultado;
            $mensaje_tipo = 'error';
        }
    } elseif ($action === 'update_cliente') {
        $resultado = ejecutarProcedimiento($conn, "CALL sp_actualizar_cliente(?,?,?,?,?,?,?,?,?)", [
            $_POST['id'], $_POST['username'], $_POST['correo'], $_POST['contrasenia'] ?? '',
            $_POST['nombre'], $_POST['apPat'], $_POST['apMat'] ?? '',
            $_POST['fechaNac'], $_POST['sexo']
        ]);
        if ($resultado === true) {
            $mensaje = 'Cliente actualizado exitosamente.';
            $mensaje_tipo = 'success';
        } else {
            $mensaje = 'Error al actualizar cliente: ' . $resultado;
            $mensaje_tipo = 'error';
        }
    } elseif ($action === 'delete_cliente') {
        $resultado = ejecutarProcedimiento($conn, "CALL sp_eliminar_cliente(?)", [$_POST['id']]);
        if ($resultado === true) {
            $mensaje = 'Cliente eliminado exitosamente.';
            $mensaje_tipo = 'success';
        } else {
            $mensaje = 'Error al eliminar cliente: ' . $resultado;
            $mensaje_tipo = 'error';
        }
    } elseif ($action === 'create_entrenador') {
        $resultado = ejecutarProcedimiento($conn, "CALL sp_insertar_entrenador(?,?,?,?,?,?,?,?)", [
            $_POST['username'], $_POST['correo'], $_POST['contrasenia'],
            $_POST['nombre'], $_POST['apPat'], $_POST['apMat'] ?? '',
            $_POST['sexo'], $_POST['id_Turno'] ?: null
        ]);
        if ($resultado === true) {
            $mensaje = 'Entrenador creado exitosamente.';
            $mensaje_tipo = 'success';
        } else {
            $mensaje = 'Error al crear entrenador: ' . $resultado;
            $mensaje_tipo = 'error';
        }
    } elseif ($action === 'update_entrenador') {
        $resultado = ejecutarProcedimiento($conn, "CALL sp_actualizar_entrenador(?,?,?,?,?,?,?,?,?)", [
            $_POST['id'], $_POST['username'], $_POST['correo'], $_POST['contrasenia'] ?? '',
            $_POST['nombre'], $_POST['apPat'], $_POST['apMat'] ?? '',
            $_POST['sexo'], $_POST['id_Turno'] ?: null
        ]);
        if ($resultado === true) {
            $mensaje = 'Entrenador actualizado exitosamente.';
            $mensaje_tipo = 'success';
        } else {
            $mensaje = 'Error al actualizar entrenador: ' . $resultado;
            $mensaje_tipo = 'error';
        }
    } elseif ($action === 'delete_entrenador') {
        $resultado = ejecutarProcedimiento($conn, "CALL sp_eliminar_entrenador(?)", [$_POST['id']]);
        if ($resultado === true) {
            $mensaje = 'Entrenador eliminado exitosamente.';
            $mensaje_tipo = 'success';
        } else {
            $mensaje = 'Error al eliminar entrenador: ' . $resultado;
            $mensaje_tipo = 'error';
        }
    }

    if ($is_ajax) {
        header('Content-Type: application/json');
        $msg_limpio = preg_replace('/^Error al (crear|actualizar|eliminar) (cliente|entrenador): /', '', $mensaje);
        $msg_limpio = preg_replace('/^SQLSTATE\[\d+\]:.*?: \d+ /', '', $msg_limpio);
        echo json_encode([
            'success' => $mensaje_tipo === 'success',
            'message' => $msg_limpio
        ]);
        exit();
    }
}

$clientes = [];
try {
    $stmt = $conn->query("CALL sp_listar_clientes()");
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
} catch (Exception $e) { $clientes = []; }

$entrenadores = [];
try {
    $stmt = $conn->query("CALL sp_listar_entrenadores()");
    $entrenadores = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
} catch (Exception $e) { $entrenadores = []; }

$turnos = [];
try {
    $stmt = $conn->query("SELECT * FROM Turno");
    $turnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) { $turnos = []; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STEELYCO GYM | Panel Administrador</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        .admin-body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .admin-main {
            flex: 1;
            padding: 40px 5%;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }
        .admin-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 5px;
            text-align: left;
        }
        .admin-title span {
            text-shadow: 0 0 10px rgba(0, 240, 255, 0.5);
        }
        .admin-subtitle {
            color: var(--text-muted);
            margin-bottom: 30px;
            font-size: 0.95rem;
        }
        .admin-tabs {
            display: flex;
            gap: 4px;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 30px;
        }
        .admin-tab {
            padding: 14px 28px;
            background: none;
            border: none;
            color: var(--text-muted);
            font-family: inherit;
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.25s ease;
            border-bottom: 2px solid transparent;
            margin-bottom: -1px;
        }
        .admin-tab:hover {
            color: var(--primary-color);
        }
        .admin-tab.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
            text-shadow: 0 0 8px rgba(0, 240, 255, 0.3);
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .admin-table-container {
            overflow-x: auto;
            border-radius: 14px;
            border: 1px solid var(--border-color);
            background-color: var(--card-bg);
            margin-bottom: 20px;
        }
        .admin-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 700px;
        }
        .admin-table th {
            background-color: var(--bg-main);
            color: var(--primary-color);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.8rem;
            padding: 16px 16px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
            white-space: nowrap;
        }
        .admin-table td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        .admin-table tbody tr:last-child td {
            border-bottom: none;
        }
        .admin-table tbody tr:hover {
            background-color: #1A1A1A;
        }
        .admin-table .col-acciones {
            white-space: nowrap;
            text-align: right;
        }
        .btn-accion {
            padding: 7px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: none;
            color: var(--text-muted);
            font-family: inherit;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-left: 6px;
        }
        .btn-accion.editar:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            box-shadow: 0 0 10px rgba(0, 240, 255, 0.2);
        }
        .btn-accion.eliminar:hover {
            border-color: #ff3366;
            color: #ff3366;
            box-shadow: 0 0 10px rgba(255, 51, 102, 0.2);
        }
        .admin-header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }
        .admin-header-bar h3 {
            margin: 0;
            text-align: left;
            font-size: 1.2rem;
            color: var(--text-main);
            font-weight: 700;
        }
        .admin-alert {
            padding: 14px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.3s ease;
        }
        .admin-alert.success {
            background-color: rgba(0, 240, 255, 0.12);
            border: 1px solid rgba(0, 240, 255, 0.3);
            color: var(--primary-color);
        }
        .admin-alert.error {
            background-color: rgba(255, 51, 102, 0.12);
            border: 1px solid rgba(255, 51, 102, 0.3);
            color: #ff3366;
        }
        .admin-modal {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(5,5,5,0.85);
            backdrop-filter: blur(8px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        .admin-modal.active {
            display: flex;
        }
        .admin-modal-content {
            background-color: var(--bg-light);
            width: 550px;
            max-width: 95%;
            padding: 35px 40px;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            box-shadow: 0 0 40px rgba(0,0,0,0.8);
            max-height: 85vh;
            overflow-y: auto;
            position: relative;
            animation: modalFadeIn 0.4s cubic-bezier(0.16,1,0.3,1);
        }
        .admin-modal-content h2 {
            font-size: 1.6rem;
            margin-top: 0;
            margin-bottom: 5px;
            text-align: center;
            color: var(--text-main);
        }
        .admin-modal-content p {
            text-align: center;
            color: var(--text-muted);
            margin-bottom: 25px;
            font-size: 0.9rem;
        }
        .admin-modal-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 25px;
        }
        .admin-modal-actions .btn {
            min-width: 120px;
            text-align: center;
        }
        .btn-cancelar {
            background: none;
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            padding: 12px 28px;
            border-radius: 30px;
            cursor: pointer;
            font-family: inherit;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.25s ease;
        }
        .btn-cancelar:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        .btn-peligro {
            background-color: #ff3366;
            color: #000 !important;
            box-shadow: 0 0 15px rgba(255,51,102,0.4);
        }
        .btn-peligro:hover {
            background-color: #fff;
            box-shadow: 0 0 25px rgba(255,51,102,0.6);
        }
        .text-muted {
            color: var(--text-muted);
        }
        .text-main {
            color: var(--text-main);
        }
        .badge-turno {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            border: 1px solid rgba(0,240,255,0.2);
            color: var(--primary-color);
        }
        .admin-empty {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }
        .admin-empty h3 {
            color: var(--text-muted);
            font-weight: 600;
            margin-bottom: 8px;
        }
        .nombre-admin {
            color: var(--primary-color);
            font-weight: 800;
            font-size: 0.85rem;
            margin-right: 15px;
        }
        .modal-error {
            padding: 12px 16px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .modal-error.error {
            background-color: rgba(255, 51, 102, 0.12);
            border: 1px solid rgba(255, 51, 102, 0.3);
            color: #ff3366;
        }
        .modal-error.success {
            background-color: rgba(0, 240, 255, 0.12);
            border: 1px solid rgba(0, 240, 255, 0.3);
            color: var(--primary-color);
        }
    </style>
</head>
<body>
<div class="admin-body">

    <header class="header">
        <div class="nav-container">
            <a href="dashboard.php" class="logo">STEELYCO<span>GYM</span></a>
            <nav class="navbar">
                <ul class="nav-links">
                    <li><a href="dashboard.php">Inicio</a></li>
                    <li><a href="admin_panel.php" style="color:var(--primary-color);">Panel Admin</a></li>
                </ul>
            </nav>
            <span class="nombre-admin">👤 Admin: <?= htmlspecialchars($_SESSION['username']) ?></span>
            <a href="logout.php" class="btn btn-logout">Cerrar Sesión</a>
            <button class="btn-mobile" id="mobileMenuBtn">&#9776;</button>
        </div>
    </header>

    <main class="admin-main">

        <h1 class="admin-title">Panel de <span>Administrador</span></h1>
        <p class="admin-subtitle">Gestión de clientes y entrenadores del sistema.</p>

        <?php if ($mensaje): ?>
            <div class="admin-alert <?= $mensaje_tipo ?>">
                <span><?= $mensaje_tipo === 'success' ? '✓' : '✗' ?></span>
                <?= htmlspecialchars($mensaje) ?>
            </div>
        <?php endif; ?>

        <!-- Pestañas para cambiar entre la tabla de clientes y entrenadores -->
        <div class="admin-tabs">
            <button class="admin-tab active" data-tab="clientes">Clientes</button>
            <button class="admin-tab" data-tab="entrenadores">Entrenadores</button>
        </div>

        <!-- ========== TAB: CLIENTES ========== -->
        <div class="tab-content active" id="tab-clientes">
            <div class="admin-header-bar">
                <h3>Clientes Registrados (<?= count($clientes) ?>)</h3>
                <button class="btn" onclick="openModal('cliente', null)">+ Agregar Cliente</button>
            </div>

            <?php if (empty($clientes)): ?>
                <div class="admin-empty">
                    <h3>No hay clientes registrados</h3>
                    <p>Comienza agregando un nuevo cliente.</p>
                </div>
            <?php else: ?>
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Ap. Paterno</th>
                                <th>Ap. Materno</th>
                                <th>Sexo</th>
                                <th>Fecha Nac.</th>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th class="col-acciones">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientes as $c): ?>
                            <tr>
                                <td class="text-main"><?= $c['id_Cliente'] ?></td>
                                <td class="text-main"><?= htmlspecialchars($c['nombreCliente']) ?></td>
                                <td><?= htmlspecialchars($c['apPatCliente']) ?></td>
                                <td><?= htmlspecialchars($c['apMatCliente'] ?? '') ?></td>
                                <td><?= $c['sexo'] === 'M' ? 'Masculino' : ($c['sexo'] === 'F' ? 'Femenino' : 'Otro') ?></td>
                                <td><?= htmlspecialchars($c['fechaNac']) ?></td>
                                <td><?= htmlspecialchars($c['username']) ?></td>
                                <td><?= htmlspecialchars($c['correo']) ?></td>
                                <td class="col-acciones">
                                    <button class="btn-accion editar" onclick='openModal("cliente", <?= json_encode($c) ?>)'>Editar</button>
                                    <button class="btn-accion eliminar" onclick='confirmDelete("cliente", <?= $c['id_Cliente'] ?>, "<?= htmlspecialchars($c['nombreCliente'] . " " . $c['apPatCliente']) ?>")'>Eliminar</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <!-- ========== TAB: ENTRENADORES ========== -->
        <div class="tab-content" id="tab-entrenadores">
            <div class="admin-header-bar">
                <h3>Entrenadores Registrados (<?= count($entrenadores) ?>)</h3>
                <button class="btn" onclick="openModal('entrenador', null)">+ Agregar Entrenador</button>
            </div>

            <?php if (empty($entrenadores)): ?>
                <div class="admin-empty">
                    <h3>No hay entrenadores registrados</h3>
                    <p>Comienza agregando un nuevo entrenador.</p>
                </div>
            <?php else: ?>
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Ap. Paterno</th>
                                <th>Ap. Materno</th>
                                <th>Sexo</th>
                                <th>Turno</th>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th class="col-acciones">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($entrenadores as $e): ?>
                            <tr>
                                <td class="text-main"><?= $e['id_Entrenador'] ?></td>
                                <td class="text-main"><?= htmlspecialchars($e['nombre']) ?></td>
                                <td><?= htmlspecialchars($e['apPatEntrenador']) ?></td>
                                <td><?= htmlspecialchars($e['apMatEntrenador'] ?? '') ?></td>
                                <td><?= $e['sexo'] === 'M' ? 'Masculino' : ($e['sexo'] === 'F' ? 'Femenino' : 'Otro') ?></td>
                                <td>
                                    <?php if ($e['turno']): ?>
                                        <span class="badge-turno"><?= htmlspecialchars($e['turno']) ?></span>
                                    <?php else: ?>
                                        <span class="text-muted">—</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($e['username']) ?></td>
                                <td><?= htmlspecialchars($e['correo']) ?></td>
                                <td class="col-acciones">
                                    <button class="btn-accion editar" onclick='openModal("entrenador", <?= json_encode($e) ?>)'>Editar</button>
                                    <button class="btn-accion eliminar" onclick='confirmDelete("entrenador", <?= $e['id_Entrenador'] ?>, "<?= htmlspecialchars($e['nombre'] . " " . $e['apPatEntrenador']) ?>")'>Eliminar</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

    </main>

    <!-- ========== MODAL CLIENTE ========== -->
    <div class="admin-modal" id="modalCliente">
        <div class="admin-modal-content">
            <button class="close-modal" onclick="cerrarModal('modalCliente')">&times;</button>
            <h2 id="modalClienteTitle">Agregar Cliente</h2>
            <p id="modalClienteSub">Complete los datos del nuevo cliente.</p>

            <form method="POST" id="clienteForm">
                <div class="modal-error" id="clienteError" style="display:none; margin-bottom:16px;"></div>
                <input type="hidden" name="id" id="clienteId">
                <input type="hidden" name="action" id="clienteAction" value="create_cliente">

                <div class="input-row">
                    <div class="input-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="clienteNombre" placeholder="Nombre" required>
                    </div>
                    <div class="input-group">
                        <label>Ap. Paterno</label>
                        <input type="text" name="apPat" id="clienteApPat" placeholder="Paterno" required>
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label>Ap. Materno</label>
                        <input type="text" name="apMat" id="clienteApMat" placeholder="Materno">
                    </div>
                    <div class="input-group">
                        <label>Sexo</label>
                        <select name="sexo" id="clienteSexo" required>
                            <option value="">Selecciona...</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label>Usuario</label>
                        <input type="text" name="username" id="clienteUsername" placeholder="Usuario" required>
                    </div>
                    <div class="input-group">
                        <label>Correo</label>
                        <input type="email" name="correo" id="clienteCorreo" placeholder="correo@ejemplo.com" required>
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label>Contraseña <span class="text-muted" style="font-weight:400;" id="clientePassLabel">*</span></label>
                        <input type="password" name="contrasenia" id="clienteContrasenia" placeholder="********">
                    </div>
                    <div class="input-group">
                        <label>Fecha de Nacimiento</label>
                        <input type="date" name="fechaNac" id="clienteFechaNac" required>
                    </div>
                </div>

                <div class="admin-modal-actions">
                    <button type="button" class="btn-cancelar" onclick="cerrarModal('modalCliente')">Cancelar</button>
                    <button type="submit" class="btn" id="clienteSubmitBtn">Guardar Cliente</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========== MODAL ENTRENADOR ========== -->
    <div class="admin-modal" id="modalEntrenador">
        <div class="admin-modal-content">
            <button class="close-modal" onclick="cerrarModal('modalEntrenador')">&times;</button>
            <h2 id="modalEntrenadorTitle">Agregar Entrenador</h2>
            <p id="modalEntrenadorSub">Complete los datos del nuevo entrenador.</p>

            <form method="POST" id="entrenadorForm">
                <div class="modal-error" id="entrenadorError" style="display:none; margin-bottom:16px;"></div>
                <input type="hidden" name="id" id="entrenadorId">
                <input type="hidden" name="action" id="entrenadorAction" value="create_entrenador">

                <div class="input-row">
                    <div class="input-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="entrenadorNombre" placeholder="Nombre" required>
                    </div>
                    <div class="input-group">
                        <label>Ap. Paterno</label>
                        <input type="text" name="apPat" id="entrenadorApPat" placeholder="Paterno" required>
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label>Ap. Materno</label>
                        <input type="text" name="apMat" id="entrenadorApMat" placeholder="Materno">
                    </div>
                    <div class="input-group">
                        <label>Sexo</label>
                        <select name="sexo" id="entrenadorSexo" required>
                            <option value="">Selecciona...</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label>Usuario</label>
                        <input type="text" name="username" id="entrenadorUsername" placeholder="Usuario" required>
                    </div>
                    <div class="input-group">
                        <label>Correo</label>
                        <input type="email" name="correo" id="entrenadorCorreo" placeholder="correo@ejemplo.com" required>
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label>Contraseña <span class="text-muted" style="font-weight:400;" id="entrenadorPassLabel">*</span></label>
                        <input type="password" name="contrasenia" id="entrenadorContrasenia" placeholder="********">
                    </div>
                    <div class="input-group">
                        <label>Turno</label>
                        <select name="id_Turno" id="entrenadorTurno">
                            <option value="">Sin turno</option>
                            <?php foreach ($turnos as $t): ?>
                                <option value="<?= $t['id_Turno'] ?>"><?= htmlspecialchars($t['nombre']) ?> (<?= htmlspecialchars($t['horaInicio']) ?> - <?= htmlspecialchars($t['horaFin']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="admin-modal-actions">
                    <button type="button" class="btn-cancelar" onclick="cerrarModal('modalEntrenador')">Cancelar</button>
                    <button type="submit" class="btn" id="entrenadorSubmitBtn">Guardar Entrenador</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========== MODAL CONFIRMAR ELIMINACION ========== -->
    <div class="admin-modal" id="modalConfirmar">
        <div class="admin-modal-content" style="max-width:420px; text-align:center;">
            <h2>Confirmar Eliminación</h2>
            <p id="confirmDeleteMsg">¿Estás seguro de eliminar este registro?</p>
            <p style="color:var(--text-main); font-weight:700; font-size:1.1rem; margin-bottom:20px;" id="confirmDeleteName"></p>
            <form method="POST" id="deleteForm">
                <div class="modal-error" id="deleteError" style="display:none; margin-bottom:16px;"></div>
                <input type="hidden" name="id" id="deleteId">
                <input type="hidden" name="action" id="deleteAction">
                <div class="admin-modal-actions" style="justify-content:center;">
                    <button type="button" class="btn-cancelar" onclick="cerrarModal('modalConfirmar')">Cancelar</button>
                    <button type="submit" class="btn btn-peligro">Eliminar</button>
                </div>
            </form>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-main">
            <div class="footer-col footer-brand">
                <a href="dashboard.php" class="logo">STEELYCO<span>GYM</span></a>
                <p>Tu mejor versión, diseñada aquí.<br>Entrena duro, vive mejor.</p>
            </div>
            <div class="footer-col footer-contact">
                <h4>Ubícanos</h4>
                <ul>
                    <li><span class="footer-icon">📍</span> José María Pino Suárez, 81149 El Burrión, Guasave, Sinaloa</li>
                    <li><span class="footer-icon">📞</span> +52 (687) 128-4290</li>
                    <li><span class="footer-icon">✉️</span> contacto@steelycogym.com</li>
                </ul>
            </div>
            <div class="footer-col footer-social">
                <h4>Síguenos</h4>
                <div class="social-links">
                    <a href="#" class="social-btn" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        Facebook
                    </a>
                    <a href="https://www.instagram.com/gym.steelco?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="social-btn" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                        Instagram
                    </a>
                    <a href="#" class="social-btn" aria-label="TikTok">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.76a4.84 4.84 0 0 1-1.01-.07z"/></svg>
                        TikTok
                    </a>
                    <a href="#" class="social-btn" aria-label="WhatsApp">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M11.484 0C5.152 0 0 5.153 0 11.484c0 2.184.618 4.22 1.688 5.942L.586 23.414 7.2 22.342a11.457 11.457 0 0 0 4.284.828c6.332 0 11.484-5.152 11.484-11.484C22.968 5.153 17.816 0 11.484 0zm0 20.979a9.468 9.468 0 0 1-4.83-1.32l-.347-.206-3.592.941.958-3.501-.226-.359a9.454 9.454 0 0 1-1.449-5.05c0-5.228 4.253-9.482 9.486-9.482 5.233 0 9.486 4.254 9.486 9.482 0 5.229-4.253 9.495-9.486 9.495z"/></svg>
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 STEELYCO GYM. Todos los derechos reservados.</p>
        </div>
    </footer>

</div>

<script>
// ====================================================
// FUNCIONES DEL PANEL DE ADMINISTRACION
// ====================================================

// Cambio de pestañas (Clientes / Entrenadores)
document.querySelectorAll('.admin-tab').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.admin-tab').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById('tab-' + btn.dataset.tab).classList.add('active');
    });
});

// Apertura y cierre de modales
function abrirModal(id) {
    document.getElementById(id).classList.add('active');
    document.body.style.overflow = 'hidden';  // Evitar scroll del fondo
}

function cerrarModal(id) {
    document.getElementById(id).classList.remove('active');
    document.body.style.overflow = '';
}

// Cerrar modal al hacer clic en el fondo oscuro
document.querySelectorAll('.admin-modal').forEach(m => {
    m.addEventListener('click', (e) => {
        if (e.target === m) cerrarModal(m.id);
    });
});

// Mostrar mensaje de error o exito dentro del modal
function mostrarError(formId, errorId, message, isSuccess) {
    const errorDiv = document.getElementById(errorId);
    errorDiv.textContent = message;
    errorDiv.className = 'modal-error ' + (isSuccess ? 'success' : 'error');
    errorDiv.style.display = 'block';
    if (!isSuccess) {
        errorDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
}

function ocultarError(errorId) {
    const errorDiv = document.getElementById(errorId);
    errorDiv.style.display = 'none';
    errorDiv.className = 'modal-error';
}

// Envio del formulario via AJAX para evitar recargar la pagina
async function enviarFormulario(form, errorId, modalId, submitBtn) {
    if (submitBtn) submitBtn.disabled = true;
    ocultarError(errorId);

    const formData = new FormData(form);
    formData.append('ajax', '1');  // Indicar al servidor que es una peticion AJAX

    try {
        const resp = await fetch(window.location.href, { method: 'POST', body: formData });
        const result = await resp.json();

        if (result.success) {
            // Mostrar mensaje de exito y cerrar el modal tras 0.8 segundos
            mostrarError(form.id, errorId, '✓ ' + result.message, true);
            setTimeout(() => {
                cerrarModal(modalId);
                window.location.reload();  // Recargar para ver los cambios
            }, 800);
        } else {
            // Mostrar error dentro del modal sin cerrarlo (el usuario no pierde sus datos)
            mostrarError(form.id, errorId, '✗ ' + result.message, false);
        }
    } catch (e) {
        mostrarError(form.id, errorId, '✗ Error de conexión. Intenta de nuevo.', false);
    } finally {
        if (submitBtn) submitBtn.disabled = false;
    }
}

// Interceptar el envio del formulario de cliente para usar AJAX
document.getElementById('clienteForm').addEventListener('submit', function(e) {
    e.preventDefault();
    enviarFormulario(this, 'clienteError', 'modalCliente', document.getElementById('clienteSubmitBtn'));
});

function openModal(tipo, data) {
    if (tipo === 'cliente') {
        ocultarError('clienteError');
        const title = document.getElementById('modalClienteTitle');
        const sub = document.getElementById('modalClienteSub');
        const action = document.getElementById('clienteAction');
        const submitBtn = document.getElementById('clienteSubmitBtn');
        const passLabel = document.getElementById('clientePassLabel');

        if (data) {
            title.textContent = 'Editar Cliente';
            sub.textContent = 'Modifique los datos del cliente.';
            action.value = 'update_cliente';
            submitBtn.textContent = 'Actualizar Cliente';
            passLabel.textContent = '(dejar vacío para no cambiar)';

            document.getElementById('clienteId').value = data.id_Cliente;
            document.getElementById('clienteNombre').value = data.nombreCliente || '';
            document.getElementById('clienteApPat').value = data.apPatCliente || '';
            document.getElementById('clienteApMat').value = data.apMatCliente || '';
            document.getElementById('clienteSexo').value = data.sexo || '';
            document.getElementById('clienteUsername').value = data.username || '';
            document.getElementById('clienteCorreo').value = data.correo || '';
            document.getElementById('clienteContrasenia').value = '';
            document.getElementById('clienteFechaNac').value = data.fechaNac || '';
        } else {
            title.textContent = 'Agregar Cliente';
            sub.textContent = 'Complete los datos del nuevo cliente.';
            action.value = 'create_cliente';
            submitBtn.textContent = 'Guardar Cliente';
            passLabel.textContent = '*';

            document.getElementById('clienteId').value = '';
            document.getElementById('clienteNombre').value = '';
            document.getElementById('clienteApPat').value = '';
            document.getElementById('clienteApMat').value = '';
            document.getElementById('clienteSexo').value = '';
            document.getElementById('clienteUsername').value = '';
            document.getElementById('clienteCorreo').value = '';
            document.getElementById('clienteContrasenia').value = '';
            document.getElementById('clienteFechaNac').value = '';
        }

        document.getElementById('clienteContrasenia').required = !data;
        abrirModal('modalCliente');
    } else if (tipo === 'entrenador') {
        ocultarError('entrenadorError');
        const title = document.getElementById('modalEntrenadorTitle');
        const sub = document.getElementById('modalEntrenadorSub');
        const action = document.getElementById('entrenadorAction');
        const submitBtn = document.getElementById('entrenadorSubmitBtn');
        const passLabel = document.getElementById('entrenadorPassLabel');

        if (data) {
            title.textContent = 'Editar Entrenador';
            sub.textContent = 'Modifique los datos del entrenador.';
            action.value = 'update_entrenador';
            submitBtn.textContent = 'Actualizar Entrenador';
            passLabel.textContent = '(dejar vacío para no cambiar)';

            document.getElementById('entrenadorId').value = data.id_Entrenador;
            document.getElementById('entrenadorNombre').value = data.nombre || '';
            document.getElementById('entrenadorApPat').value = data.apPatEntrenador || '';
            document.getElementById('entrenadorApMat').value = data.apMatEntrenador || '';
            document.getElementById('entrenadorSexo').value = data.sexo || '';
            document.getElementById('entrenadorUsername').value = data.username || '';
            document.getElementById('entrenadorCorreo').value = data.correo || '';
            document.getElementById('entrenadorContrasenia').value = '';
            document.getElementById('entrenadorTurno').value = data.id_Turno || '';
        } else {
            title.textContent = 'Agregar Entrenador';
            sub.textContent = 'Complete los datos del nuevo entrenador.';
            action.value = 'create_entrenador';
            submitBtn.textContent = 'Guardar Entrenador';
            passLabel.textContent = '*';

            document.getElementById('entrenadorId').value = '';
            document.getElementById('entrenadorNombre').value = '';
            document.getElementById('entrenadorApPat').value = '';
            document.getElementById('entrenadorApMat').value = '';
            document.getElementById('entrenadorSexo').value = '';
            document.getElementById('entrenadorUsername').value = '';
            document.getElementById('entrenadorCorreo').value = '';
            document.getElementById('entrenadorContrasenia').value = '';
            document.getElementById('entrenadorTurno').value = '';
        }

        document.getElementById('entrenadorContrasenia').required = !data;
        abrirModal('modalEntrenador');
    }
}

// ===== Modal Entrenador =====
document.getElementById('entrenadorForm').addEventListener('submit', function(e) {
    e.preventDefault();
    enviarFormulario(this, 'entrenadorError', 'modalEntrenador', document.getElementById('entrenadorSubmitBtn'));
});

// ===== Confirmar Eliminacion =====
document.getElementById('deleteForm').addEventListener('submit', function(e) {
    e.preventDefault();
    enviarFormulario(this, 'deleteError', 'modalConfirmar', this.querySelector('button[type="submit"]'));
});

function confirmDelete(tipo, id, nombre) {
    ocultarError('deleteError');
    document.getElementById('deleteId').value = id;
    document.getElementById('deleteAction').value = 'delete_' + tipo;
    document.getElementById('confirmDeleteName').textContent = nombre;
    document.getElementById('confirmDeleteMsg').textContent =
        tipo === 'cliente'
            ? '¿Estás seguro de eliminar este cliente y todos sus datos asociados?'
            : '¿Estás seguro de eliminar este entrenador y todos sus datos asociados?';
    abrirModal('modalConfirmar');
}

// ===== Cerrar modales con Escape =====
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        document.querySelectorAll('.admin-modal.active').forEach(m => cerrarModal(m.id));
    }
});
</script>

</body>
</html>
