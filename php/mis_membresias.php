<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit();
}
require_once 'conexion.php';

$membresias = [];
try {
    $stmt = $conn->prepare("
        SELECT
            m.id_Membresia,
            m.fecha_Contratacion,
            m.fecha_Finalizacion,
            m.es_Vencido,
            tm.descripcion AS plan_nombre,
            tm.monto AS plan_precio,
            e.nombre AS entrenador_nombre,
            e.apPatEntrenador AS entrenador_ap
        FROM Membresia m
        JOIN Tipo_Membresia tm ON m.id_Tipo_Membresia = tm.id_Tipo_Membresia
        LEFT JOIN Entrenador e ON m.id_Entrenador = e.id_Entrenador
        WHERE m.id_Cliente = (SELECT id_Cliente FROM Cliente WHERE id_Usuario = ?)
        ORDER BY m.fecha_Contratacion DESC
    ");
    $stmt->execute([$_SESSION['usuario_id']]);
    $membresias = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $membresias = [];
}

$cliente_nombre = '';
$tiene_membresia_activa = false;  // Indica si el cliente ya tiene una membresia activa
try {
    // Obtener el nombre completo del cliente
    $stmt = $conn->prepare("SELECT nombreCliente, apPatCliente FROM Cliente WHERE id_Usuario = ?");
    $stmt->execute([$_SESSION['usuario_id']]);
    $cli = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($cli) $cliente_nombre = $cli['nombreCliente'] . ' ' . $cli['apPatCliente'];

    // Verificar si el cliente tiene una membresia activa (no vencida y con fecha de fin >= hoy)
    $stmt = $conn->prepare("SELECT COUNT(*) FROM Membresia m JOIN Cliente c ON m.id_Cliente = c.id_Cliente WHERE c.id_Usuario = ? AND m.es_Vencido = 0 AND m.fecha_Finalizacion >= CURDATE()");
    $stmt->execute([$_SESSION['usuario_id']]);
    $tiene_membresia_activa = $stmt->fetchColumn() > 0;
} catch (Exception $e) { $cliente_nombre = ''; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STEELYCO GYM | Mis Membresías</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        .membresias-page {
            min-height: 70vh;
        }
        .membresias-tabla {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            background-color: var(--card-bg);
            margin-top: 20px;
        }
        .membresias-tabla th {
            background-color: var(--bg-main);
            color: var(--primary-color);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
            padding: 18px 20px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        .membresias-tabla td {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-muted);
            font-size: 0.95rem;
        }
        .membresias-tabla tbody tr:last-child td {
            border-bottom: none;
        }
        .membresias-tabla tbody tr:hover {
            background-color: #1A1A1A;
        }
        .badge-activo {
            display: inline-block;
            background-color: rgba(0, 240, 255, 0.15);
            color: var(--primary-color);
            font-weight: 700;
            font-size: 0.8rem;
            padding: 5px 14px;
            border-radius: 20px;
            border: 1px solid rgba(0, 240, 255, 0.3);
        }
        .badge-vencido {
            display: inline-block;
            background-color: rgba(255, 51, 102, 0.15);
            color: #ff3366;
            font-weight: 700;
            font-size: 0.8rem;
            padding: 5px 14px;
            border-radius: 20px;
            border: 1px solid rgba(255, 51, 102, 0.3);
        }
        .plan-nombre {
            color: var(--text-main);
            font-weight: 700;
        }
        .plan-precio-tabla {
            color: var(--primary-color);
            font-weight: 700;
        }
        .vacio-mensaje {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }
        .vacio-mensaje h3 {
            color: var(--text-muted);
            font-weight: 600;
            margin-bottom: 10px;
        }
        .vacio-mensaje .btn {
            display: inline-block;
            margin-top: 20px;
        }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 10px;
        }
        .page-header h2 {
            margin: 0;
            text-align: left;
        }
        @media (max-width: 768px) {
            .membresias-tabla th,
            .membresias-tabla td {
                padding: 12px 14px;
                font-size: 0.8rem;
            }
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="header">
        <div class="nav-container">
            <a href="dashboard.php" class="logo">STEELYCO<span>GYM</span></a>
            <nav class="navbar">
                <ul class="nav-links">
                    <li><a href="dashboard.php">Inicio</a></li>
                    <li><a href="mis_membresias.php">Mis Membresías</a></li>
                </ul>
            </nav>
            <a href="logout.php" class="btn btn-logout">Cerrar Sesión</a>
            <button class="btn-mobile" id="mobileMenuBtn">&#9776;</button>
        </div>
    </header>

    <!-- Contenido -->
    <section class="section membresias-page">
        <div class="section-container">
            <div class="page-header">
                <h2 class="section-title" style="margin-bottom:0;">Mis <span>Membresías</span></h2>
                <?php if ($tiene_membresia_activa): ?>
                    <button class="btn" onclick="abrirModalActiva()">Nueva Inscripción</button>
                <?php else: ?>
                    <a href="dashboard.php" class="btn">Nueva Inscripción</a>
                <?php endif; ?>
            </div>
            <p style="color:var(--text-muted); margin-bottom:30px;">
                <?= htmlspecialchars($cliente_nombre ?: $_SESSION['username']) ?>, aquí puedes ver todas tus membresías.
            </p>

            <?php if (empty($membresias)): ?>
                <div class="vacio-mensaje">
                    <h3>No tienes membresías registradas</h3>
                    <p>Adquiere una membresía para empezar a entrenar.</p>
                    <?php if ($tiene_membresia_activa): ?>
                        <button class="btn" onclick="abrirModalActiva()">Inscribirme Ahora</button>
                    <?php else: ?>
                        <a href="dashboard.php" class="btn">Inscribirme Ahora</a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="schedule-table-container" style="padding:0;">
                    <table class="membresias-tabla">
                        <thead>
                            <tr>
                                <th>Plan</th>
                                <th>Precio</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Entrenador</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($membresias as $m): ?>
                            <tr>
                                <td class="plan-nombre"><?= htmlspecialchars($m['plan_nombre']) ?></td>
                                <td class="plan-precio-tabla">$<?= number_format($m['plan_precio'], 0) ?></td>
                                <td><?= htmlspecialchars($m['fecha_Contratacion']) ?></td>
                                <td><?= htmlspecialchars($m['fecha_Finalizacion']) ?></td>
                                <td>
                                    <?= $m['entrenador_nombre']
                                        ? htmlspecialchars($m['entrenador_nombre'] . ' ' . $m['entrenador_ap'])
                                        : 'Sin entrenador' ?>
                                </td>
                                <td>
                                    <?php if (!$m['es_Vencido'] && $m['fecha_Finalizacion'] >= date('Y-m-d')): ?>
                                        <span class="badge-activo">Activo</span>
                                    <?php else: ?>
                                        <span class="badge-vencido">Vencido</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Modal que se muestra cuando el cliente ya tiene una membresia activa -->
    <div class="modal-overlay" id="modalActiva">
        <div class="modal-content" style="max-width:420px; text-align:center;">
            <h2 style="font-size:1.8rem; margin-bottom:10px;">&#128274; Membresía Activa</h2>
            <p style="color:var(--text-muted); margin-bottom:20px; font-size:1rem;">
                Ya tienes una membresía activa. Solo puedes tener una a la vez. Espera a que venza para contratar otra.
            </p>
            <button class="btn" onclick="cerrarModalActiva()" style="display:inline-block; margin:0 auto;">Entendido</button>
        </div>
    </div>

    <!-- Footer -->
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

<script>
    function abrirModalActiva() {
        document.getElementById('modalActiva').classList.add('active');
    }
    function cerrarModalActiva() {
        document.getElementById('modalActiva').classList.remove('active');
    }
    document.getElementById('modalActiva').addEventListener('click', function(e) {
        if (e.target === this) cerrarModalActiva();
    });
</script>
</body>
</html>
