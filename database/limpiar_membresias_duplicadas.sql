-- =====================================================
-- Limpiar membresias duplicadas por cliente
-- La validacion en inscripcion.php ahora evita crear
-- duplicados, pero este script sirve para limpiar
-- registros que ya existen en la base de datos.
-- Mantiene solo la membresia activa mas reciente.
-- =====================================================

USE BD_Gimnasio;

-- Consulta de diagnostico: ver cuantos clientes tienen multiples membresias activas
SELECT id_Cliente, COUNT(*) AS total_activas
FROM Membresia
WHERE es_Vencido = 0 AND fecha_Finalizacion >= CURDATE()
GROUP BY id_Cliente
HAVING COUNT(*) > 1;

-- Eliminar membresias duplicadas (conserva la mas reciente por fecha de contratacion)
DELETE m1
FROM Membresia m1
INNER JOIN Membresia m2 ON m1.id_Cliente = m2.id_Cliente
    AND m1.es_Vencido = 0
    AND m2.es_Vencido = 0
    AND m1.fecha_Finalizacion >= CURDATE()
    AND m2.fecha_Finalizacion >= CURDATE()
    AND m1.fecha_Contratacion < m2.fecha_Contratacion;

-- Alternativa si el DELETE no funciona en ciertas versiones de MySQL:
-- Marcar como vencidas las membresias duplicadas mas antiguas en lugar de borrarlas
/*
UPDATE Membresia m1
JOIN (
    SELECT id_Cliente, MAX(fecha_Contratacion) AS ultima_fecha
    FROM Membresia
    WHERE es_Vencido = 0 AND fecha_Finalizacion >= CURDATE()
    GROUP BY id_Cliente
    HAVING COUNT(*) > 1
) m2 ON m1.id_Cliente = m2.id_Cliente
SET m1.es_Vencido = 1
WHERE m1.fecha_Contratacion < m2.ultima_fecha AND m1.es_Vencido = 0;
*/
