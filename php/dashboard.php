<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit();
}
require_once 'conexion.php';

$planes = [];
try {
    $stmt = $conn->query("SELECT * FROM Tipo_Membresia ORDER BY monto ASC");
    $planes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) { $planes = []; }

$entrenadores = [];
try {
    $stmt = $conn->query("
        SELECT e.id_Entrenador, e.nombre, e.apPatEntrenador, e.apMatEntrenador, e.sexo, t.nombre AS turno
        FROM Entrenador e
        LEFT JOIN Turno t ON e.id_Turno = t.id_Turno
        ORDER BY e.nombre ASC
    ");
    $entrenadores = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) { $entrenadores = []; }

$cliente_nombre = '';
try {
    $stmt = $conn->prepare("SELECT nombreCliente, apPatCliente FROM Cliente WHERE id_Usuario = ?");
    $stmt->execute([$_SESSION['usuario_id']]);
    $cli = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($cli) $cliente_nombre = $cli['nombreCliente'] . ' ' . $cli['apPatCliente'];
} catch (Exception $e) { $cliente_nombre = ''; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STEELYCO GYM | Potencia tu vida</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

    
    <header class="header">
        <div class="nav-container">
            <a href="#" class="logo">STEELYCO<span>GYM</span></a>
            <nav class="navbar">
                <ul class="nav-links">
                    <li class="dropdown">
                        <a href="#">El Gimnasio ▾</a>
                        <ul class="dropdown-menu">
                            <li><a href="#hero">Inicio</a></li>
                            <li><a href="#about">Nosotros</a></li>
                            <li><a href="#areas">Áreas</a></li>
                            <li><a href="#trainers">Entrenadores</a></li>
                            <li><a href="#schedule">Horarios</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#">Membresías ▾</a>
                        <ul class="dropdown-menu">
                            <li><a href="#membresias">Planes</a></li>
                            <li><a href="mis_membresias.php">Mis Membresías</a></li>
                            <li><a href="#" data-open-inscripcion>Inscripciones</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <span class="user-greeting"> Bienvenido 👤 <?= htmlspecialchars($_SESSION['nombre_completo'] ?? $_SESSION['username']) ?></span>
            <a href="logout.php" class="btn btn-logout">Cerrar Sesión</a>
            <button class="btn-mobile" id="mobileMenuBtn">&#9776;</button>
        </div>
    </header>

    <!-- Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <button class="close-menu" id="closeMenuBtn">&times;</button>
        <ul class="mobile-nav-links">
            <li class="mobile-user-name">👤 <?= htmlspecialchars($_SESSION['nombre_completo'] ?? $_SESSION['username']) ?></li>
            <li class="mobile-group-header">— El Gimnasio —</li>
            <li><a href="#hero" class="mobile-link">Inicio</a></li>
            <li><a href="#about" class="mobile-link">Nosotros</a></li>
            <li><a href="#areas" class="mobile-link">Áreas</a></li>
            <li><a href="#trainers" class="mobile-link">Entrenadores</a></li>
            <li><a href="#schedule" class="mobile-link">Horarios</a></li>
            <li class="mobile-group-header">— Membresías —</li>
            <li><a href="#membresias" class="mobile-link">Planes</a></li>
            <li><a href="mis_membresias.php" class="mobile-link">Mis Membresías</a></li>
            <li><a href="#" class="mobile-link" data-open-inscripcion>Inscripciones</a></li>
            <li><a href="logout.php" class="mobile-link">Cerrar Sesión</a></li>
        </ul>
    </div>




    <!-- Seccion del titulo -->
    <section id="hero" class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">SUPERA TUS <span>LÍMITES</span></h1>
            <p class="hero-subtitle">Instalaciones premium, equipo de última generación y ambiente motivador para que logres tus metas. Da el primer paso hoy.</p>
            <button class="btn btn-primary btn-large" data-open-inscripcion>Inscríbete Ahora</button>
        </div>
    </section>

    <!-- Seccio sobre nosotros -->
    <section id="about" class="section about">
        <div class="section-container">
            <div class="about-grid">
                <div class="about-text fade-up">
                    <h2 class="section-title">Acerca de <span>Nuestro Gimnasio</span></h2>
                    <p>En STEELYCO GYM no solo levantamos pesas, creamos versiones mejoradas de nosotros mismos. Instalaciones de lujo y el mejor ambiente, tenemos todo lo necesario para que alcances tu máximo nivel.</p>
                </div>
                <img class="fade-up fade-up-delay-2" src="../img/icono_steelyco.png" height="400px" width="400px">
            </div>
        </div>
    </section>

    <!-- Seccion de area de mancuernas -->
    <section id="areas" class="section areas dark-bg">
        <div class="section-container">
            <h2 class="section-title text-center fade-up">Nuestras <span>Áreas</span></h2>
            <div class="areas-grid">
                <!-- 1.- Zona de Cardio -->
                <div class="area-card fade-up fade-up-delay-1">
                    <div class="area-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1540497077202-7c8a3999166f?q=80&w=1470&auto=format&fit=crop" alt="Zona de Cardio">
                    </div>
                    <div class="area-info">
                        <h3>Zona de Cardio</h3>
                        <p>Equipos de última tecnología para mantener tu ritmo cardíaco y maximizar tu resistencia.</p>
                    </div>
                </div>
                
                <!-- 2.- Zona de Mancuernas -->
                <div class="area-card fade-up fade-up-delay-2">
                    <div class="area-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&q=80&w=1500" alt="Zona de Mancuernas">
                    </div>
                    <div class="area-info">
                        <h3>Zona de Mancuernas</h3>
                        <p>Peso libre para hipertrofia y fuerza. Un espacio amplio y adaptado a tus necesidades.</p>
                    </div>
                </div>

                <!-- 3.- Planta Baja -->
                <div class="area-card fade-up fade-up-delay-3">
                    <div class="area-img-wrapper">
                        <img src="../img/zona_pierna.jpg" alt="Planta Baja">
                    </div>
                    <div class="area-info">
                        <h3>Planta Baja</h3>
                        <p>Acceso principal a las zonas de pierna y espalda.</p>
                    </div>
                </div>

                <!-- 4.- Planta Alta -->
                <div class="area-card fade-up fade-up-delay-4">
                    <div class="area-img-wrapper">
                        <img src="../img/zona_pecho_2.jpg" alt="Planta Alta">
                    </div>
                    <div class="area-info">
                        <h3>Planta Alta</h3>
                        <p>Zona de Pecho y Biceps. Un espacio amplio adecuado para que puedas tener la mejor calidad de entrenamiento</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Seccion de entrenadores -->
    <section id="trainers" class="section trainers">
        <div class="section-container">
            <h2 class="section-title text-center fade-up">Nuestros <span>Entrenadores</span></h2>
            <p class="section-subtitle text-center fade-up fade-up-delay-1">Profesionales certificados listos para guiarte en tu proceso.</p>
            <div class="trainers-grid">
                <div class="trainer-card fade-up fade-up-delay-1">
                    <img src="../img/entrenador_1.jpeg" alt="Entrenador 1">
                    <div class="trainer-info">
                        <h3>Lamine Yamal</h3>
                        <p>Especialista en Hipertrofia</p>
                    </div>
                </div>
                <div class="trainer-card fade-up fade-up-delay-2">
                    <img src="../img/entrenadora.jpeg" alt="Entrenadora 1">
                    <div class="trainer-info">
                        <h3>Alexia Putellas</h3>
                        <p>Fuerza Funcional y Crossfit</p>
                    </div>
                </div>
                <div class="trainer-card fade-up fade-up-delay-3">
                    <!-- Imagen de entrenadores -->
                    <img src="../img/vinivinivini.png" alt="Entrenador 2">
                    <div class="trainer-info">
                        <h3>Vinicius Junior</h3>
                        <p>Entrenador especializado en mujeres</p>
                    </div>
                </div>
            </div>
        </div>
    </section> 

    <!-- Seccion de membresias-->
    <section id="membresias" class="section membresias">
        <div class="section-container">
            <h2 class="section-title text-center fade-up">Elige el mejor plan y <span> entrena ya</span></h2>
            <p class="section-subtitle text-center fade-up fade-up-delay-1">Contamos con los mejores precios dentro del mercado</p>

            <div class="membresias-grid">
                <!-- 1.- Diario -->
                <div class="membresia-card fade-up fade-up-delay-1">
                    <div class="membresia-header">
                        <h3>Diario</h3>
                        <p class="precio">$50<span>/día</span></p>
                    </div>
                    <ul class="membresia-features">
                        <li>Acceso a todas las áreas</li>

                    </ul>
                </div>

                <!-- 2.- Semanal -->
                <div class="membresia-card fade-up fade-up-delay-2">
                    <div class="membresia-header">
                        <h3>Semanal</h3>
                        <p class="precio">$150<span>/sem</span></p>
                    </div>
                    <ul class="membresia-features">
                        <li>Acceso a todas las áreas</li>
                        <li>Descuentos del 10% en Productos del Gimnasio</li>
                    </ul>
                </div>
            

                <!-- 3.- Mensual -->
                <div class="membresia-card popular fade-up fade-up-delay-3">
                    <div class="membresia-badge">Más Popular</div>
                    <div class="membresia-header">
                        <h3>Mensual</h3>
                        <p class="precio">$400<span>/mes</span></p>
                    </div>
                    <ul class="membresia-features">
                        <li>Acceso a todas las áreas</li>
                        <li>1 Rutina personalizada</li>
                        <li>Descuentos del 30% en Productos del Gimnasio</li>
                    </ul>
                </div>

                <!-- 4.- Anual -->
                <div class="membresia-card fade-up fade-up-delay-4">
                    <div class="membresia-header">
                        <h3>Anual</h3>
                        <p class="precio">$4,200<span>/año</span></p>
                    </div>
                    <ul class="membresia-features">
                        <li>Acceso a todas las áreas</li>
                        <li>Asesoría mensual incluida</li>
                        <li>Descuentos del 50% en Productos del Gimnasio</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Seccion de Calendario -->
    <section id="schedule" class="section schedule dark-bg">
        <div class="section-container">
            <h2 class="section-title text-center fade-up">Nuestros <span>Horarios</span></h2>
            <div class="schedule-table-container fade-up fade-up-delay-1">
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th>Día</th>
                            <th>Horario de Apertura</th>
                            <th>Horario de Cierre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lunes - Viernes</td>
                            <td class="time">08:00 AM</td>
                            <td class="time">10:00 PM</td>
                        </tr>
                        <tr>
                            <td>Sábados</td>
                            <td class="time">08:00 AM</td>
                            <td class="time">03:00 PM</td>
                        </tr>
                        <tr>
                            <td>Domingos y Festivos</td>
                            <td class="time">Descansamos</td>
                            <td class="time">Descansamos</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-main">

            <!-- Columna 1: Marca -->
            <div class="footer-col footer-brand">
                <a href="#" class="logo">STEELYCO<span>GYM</span></a>
                <p>Tu mejor versión, diseñada aquí.<br>Entrena duro, vive mejor.</p>
            </div>

            <!-- Columna 2: Dirección y Contacto -->
            <div class="footer-col footer-contact">
                <h4>Ubícanos</h4>
                <ul>
                    <li>
                        <span class="footer-icon">📍</span>
                        José María Pino Suárez, 81149 El Burrión, Guasave, Sinaloa <br>
                    </li>
                    <li>
                        <span class="footer-icon">📞</span>
                        +52 (687) 128-4290
                    </li>
                    <li>
                        <span class="footer-icon">✉️</span>
                        contacto@steelycogym.com
                    </li>
                </ul>
            </div>

            <!-- Columna 3: Redes Sociales -->
            <div class="footer-col footer-social">
                <h4>Síguenos</h4>
                <div class="social-links">
                    <a href="#" class="social-btn" id="footerFacebook" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        Facebook
                    </a>
                    <a href="https://www.instagram.com/gym.steelco?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="social-btn" id="footerInstagram" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                        Instagram
                    </a>
                    <a href="#" class="social-btn" id="footerTiktok" aria-label="TikTok">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.76a4.84 4.84 0 0 1-1.01-.07z"/></svg>
                        TikTok
                    </a>
                    <a href="#" class="social-btn" id="footerWhatsapp" aria-label="WhatsApp">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M11.484 0C5.152 0 0 5.153 0 11.484c0 2.184.618 4.22 1.688 5.942L.586 23.414 7.2 22.342a11.457 11.457 0 0 0 4.284.828c6.332 0 11.484-5.152 11.484-11.484C22.968 5.153 17.816 0 11.484 0zm0 20.979a9.468 9.468 0 0 1-4.83-1.32l-.347-.206-3.592.941.958-3.501-.226-.359a9.454 9.454 0 0 1-1.449-5.05c0-5.228 4.253-9.482 9.486-9.482 5.233 0 9.486 4.254 9.486 9.482 0 5.229-4.253 9.495-9.486 9.495z"/></svg>
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>

        <!-- Barra inferior -->
        <div class="footer-bottom">
            <p>&copy; 2026 STEELYCO GYM. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Modal de Inscripción (Wizard) -->
    <div class="modal-overlay" id="inscripcionModal">
        <div class="modal-content inscripcion-modal">
            <button class="close-modal" id="closeInscripcionModal">&times;</button>

            <!-- Barra de progreso -->
            <div class="wizard-progress">
                <div class="wizard-step-indicator active" data-step="1">
                    <div class="step-circle">1</div>
                    <span>Plan</span>
                </div>
                <div class="wizard-line"></div>
                <div class="wizard-step-indicator" data-step="2">
                    <div class="step-circle">2</div>
                    <span>Entrenador</span>
                </div>
                <div class="wizard-line"></div>
                <div class="wizard-step-indicator" data-step="3">
                    <div class="step-circle">3</div>
                    <span>Confirmar</span>
                </div>
            </div>

            <!-- Paso 1: Seleccionar Plan -->
            <div class="wizard-step" id="step1">
                <h2>Elige tu Plan</h2>
                <p>Selecciona la membresía que mejor se adapte a ti</p>
                <div class="planes-grid" id="planesGrid">
                    <?php if (empty($planes)): ?>
                        <div class="plan-error">No hay planes disponibles</div>
                    <?php else: ?>
                        <?php foreach ($planes as $plan): ?>
                        <div class="plan-card" data-plan-id="<?= $plan['id_Tipo_Membresia'] ?>" data-plan-name="<?= htmlspecialchars($plan['descripcion']) ?>" data-plan-price="<?= $plan['monto'] ?>">
                            <h3><?= htmlspecialchars($plan['descripcion']) ?></h3>
                            <p class="plan-precio">$<?= number_format($plan['monto'], 0) ?></p>
                            <p class="plan-periodo"><?= $plan['descripcion'] === 'Dia' ? 'por día' : ($plan['descripcion'] === 'Semana' ? 'por semana' : ($plan['descripcion'] === 'Mes' ? 'por mes' : 'por año')) ?></p>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="wizard-nav">
                    <div></div>
                    <button class="btn btn-next" id="step1Next" disabled>Siguiente</button>
                </div>
            </div>

            <!-- Paso 2: Seleccionar Entrenador (Opcional) -->
            <div class="wizard-step" id="step2" style="display:none">
                <h2>¿Entrenador Personal?</h2>
                <p>Elige un entrenador que te acompañe, o continúa sin uno</p>
                <div class="entrenadores-grid" id="entrenadoresGrid">
                    <?php if (empty($entrenadores)): ?>
                        <div class="plan-error">No hay entrenadores disponibles</div>
                    <?php else: ?>
                        <?php foreach ($entrenadores as $ent): ?>
                        <div class="entrenador-card" data-entrenador-id="<?= $ent['id_Entrenador'] ?>" data-entrenador-name="<?= htmlspecialchars($ent['nombre'] . ' ' . $ent['apPatEntrenador']) ?>">
                            <div class="entrenador-avatar"><?= strtoupper(substr($ent['nombre'], 0, 1) . substr($ent['apPatEntrenador'], 0, 1)) ?></div>
                            <div class="entrenador-info">
                                <h4><?= htmlspecialchars($ent['nombre'] . ' ' . $ent['apPatEntrenador']) ?></h4>
                                <p class="ent-turno">Turno: <?= htmlspecialchars($ent['turno'] ?? 'No asignado') ?></p>
                            </div>
                            <span class="ent-check">&#10003;</span>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="skip-trainer">
                    <button class="btn-skip" id="skipTrainer">Continuar sin entrenador</button>
                </div>
                <div class="wizard-nav">
                    <button class="btn-outline-wizard btn-back" data-back="1">Atrás</button>
                    <button class="btn btn-next" id="step2Next" disabled>Siguiente</button>
                </div>
            </div>

            <!-- Paso 3: Confirmación -->
            <div class="wizard-step" id="step3" style="display:none">
                <h2>Confirma tu Inscripción</h2>
                <p>Revisa los detalles antes de finalizar</p>
                <div class="confirm-summary" id="confirmSummary">
                    <div class="summary-row">
                        <span class="summary-label">Cliente</span>
                        <span class="summary-value" id="summaryCliente"><?= htmlspecialchars($cliente_nombre ?: $_SESSION['usuario_id']) ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Plan</span>
                        <span class="summary-value" id="summaryPlan">—</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Entrenador</span>
                        <span class="summary-value" id="summaryEntrenador">Sin entrenador</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Total</span>
                        <span class="summary-value summary-precio" id="summaryPrecio">—</span>
                    </div>
                </div>
                <div class="wizard-nav">
                    <button class="btn-outline-wizard btn-back" data-back="2">Atrás</button>
                    <button class="btn" id="confirmBtn">Confirmar e Inscribirme</button>
                </div>
            </div>

            <!-- Paso 4: Éxito -->
            <div class="wizard-step" id="stepSuccess" style="display:none">
                <div class="success-icon">&#10004;</div>
                <h2>¡Inscripción Exitosa!</h2>
                <p>Tu membresía ha sido activada. ¡Bienvenido a STEELYCO GYM!</p>
                <button class="btn" id="finishBtn">Ir al Inicio</button>
            </div>

            <!-- Spinner de carga -->
            <div class="wizard-step" id="stepLoading" style="display:none">
                <div class="success-icon" style="font-size:2rem;">⏳</div>
                <h2>Procesando...</h2>
                <p>Estamos registrando tu inscripción</p>
            </div>
        </div>
    </div>

    <script src="../js/main.js"></script>

</body>
</html>