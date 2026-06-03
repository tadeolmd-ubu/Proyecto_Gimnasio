<?php
// ====================================================
// API DE INSCRIPCION A MEMBRESIA
// ====================================================
// Endpoint JSON que recibe una solicitud AJAX desde el
// wizard de inscripcion en dashboard.php. Valida los datos,
// verifica que el cliente no tenga una membresia activa,
// y crea una nueva membresia en la base de datos.
// ====================================================

session_start();

// Verificar que el usuario haya iniciado sesion
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Inicia sesión para inscribirte']);
    exit();
}

require_once 'conexion.php';

// Leer los datos JSON enviados desde el formulario del wizard
$data = json_decode(file_get_contents('php://input'), true);

$id_tipo_membresia = $data['plan_id'] ?? null;       // ID del plan seleccionado
$id_entrenador = $data['entrenador_id'] ?? null;      // ID del entrenador (opcional)
$fecha_inicio = $data['fecha_inicio'] ?? date('Y-m-d'); // Fecha de inicio (hoy por defecto)

// Validar que se haya seleccionado un plan
if (!$id_tipo_membresia) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Debes seleccionar un plan']);
    exit();
}

try {
    // Obtener el ID del cliente a partir del usuario en sesion
    $stmt = $conn->prepare("SELECT id_Cliente FROM Cliente WHERE id_Usuario = ?");
    $stmt->execute([$_SESSION['usuario_id']]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Completa tu registro como cliente primero']);
        exit();
    }

    // Verificar que el plan de membresia exista
    $stmt = $conn->prepare("SELECT * FROM Tipo_Membresia WHERE id_Tipo_Membresia = ?");
    $stmt->execute([$id_tipo_membresia]);
    $plan = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$plan) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Plan no válido']);
        exit();
    }

    // Validar que el cliente NO tenga ya una membresia activa
    // Una membresia se considera activa si no esta vencida y su fecha de fin es hoy o posterior
    $stmt = $conn->prepare("SELECT COUNT(*) FROM Membresia WHERE id_Cliente = ? AND es_Vencido = 0 AND fecha_Finalizacion >= CURDATE()");
    $stmt->execute([$cliente['id_Cliente']]);
    $activas = $stmt->fetchColumn();

    if ($activas > 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Ya tienes una membresía activa. No puedes contratar otra hasta que venza la actual.']);
        exit();
    }

    // Calcular la fecha de finalizacion segun el tipo de membresia
    $mapa_duracion = ['Dia' => 1, 'Semana' => 7, 'Mes' => 30, 'Año' => 365];
    $dias = $mapa_duracion[$plan['descripcion']] ?? 30;
    $fecha_fin = date('Y-m-d', strtotime($fecha_inicio . " + $dias days"));

    // Insertar la nueva membresia en la base de datos
    $stmt = $conn->prepare("INSERT INTO Membresia (fecha_Contratacion, fecha_Finalizacion, es_Vencido, id_Cliente, id_Tipo_Membresia, id_Entrenador) VALUES (?, ?, 0, ?, ?, ?)");
    $stmt->execute([$fecha_inicio, $fecha_fin, $cliente['id_Cliente'], $id_tipo_membresia, $id_entrenador]);

    // Responder con exito
    echo json_encode([
        'success' => true,
        'message' => '¡Inscripción exitosa! Bienvenido a STEELYCO GYM.',
        'data' => [
            'id_membresia' => $conn->lastInsertId(),
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin
        ]
    ]);
} catch (Exception $e) {
    // Error del servidor
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error del servidor: ' . $e->getMessage()]);
}
