<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Inicia sesión para inscribirte']);
    exit();
}

require_once 'conexion.php';

$data = json_decode(file_get_contents('php://input'), true);

$id_tipo_membresia = $data['plan_id'] ?? null;
$id_entrenador = $data['entrenador_id'] ?? null;
$fecha_inicio = $data['fecha_inicio'] ?? date('Y-m-d');

if (!$id_tipo_membresia) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Debes seleccionar un plan']);
    exit();
}

try {
    $stmt = $conn->prepare("SELECT id_Cliente FROM Cliente WHERE id_Usuario = ?");
    $stmt->execute([$_SESSION['usuario_id']]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Completa tu registro como cliente primero']);
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM Tipo_Membresia WHERE id_Tipo_Membresia = ?");
    $stmt->execute([$id_tipo_membresia]);
    $plan = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$plan) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Plan no válido']);
        exit();
    }

    $mapa_duracion = ['Dia' => 1, 'Semana' => 7, 'Mes' => 30, 'Año' => 365];
    $dias = $mapa_duracion[$plan['descripcion']] ?? 30;
    $fecha_fin = date('Y-m-d', strtotime($fecha_inicio . " + $dias days"));

    $stmt = $conn->prepare("INSERT INTO Membresia (fecha_Contratacion, fecha_Finalizacion, es_Vencido, id_Cliente, id_Tipo_Membresia, id_Entrenador) VALUES (?, ?, 0, ?, ?, ?)");
    $stmt->execute([$fecha_inicio, $fecha_fin, $cliente['id_Cliente'], $id_tipo_membresia, $id_entrenador]);

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
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error del servidor: ' . $e->getMessage()]);
}
