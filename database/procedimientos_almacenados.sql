-- =====================================================
-- Script de Procedimientos Almacenados - STEELYCO GYM
-- Contiene los procedimientos CRUD para la gestion de
-- Clientes y Entrenadores desde el panel de administracion.
-- Cada procedimiento maneja las tablas Usuario + Entidad
-- correspondiente (Cliente o Entrenador) en una sola
-- operacion, incluyendo validaciones de duplicados y edad.
-- =====================================================

USE BD_Gimnasio;

-- =====================================================
-- ADMIN USER
-- =====================================================
-- Usuario administrador por defecto (id_Rol=1).
-- IGNORE para no duplicar si ya existe.
INSERT IGNORE INTO Usuario (username, correo, contrasenia, id_Rol) VALUES
('admin', 'admin@steelycogym.com', 'admin123', 1);

-- =====================================================
-- PROCEDIMIENTOS: CLIENTES
-- =====================================================

-- Listar todos los clientes con su informacion de usuario
DROP PROCEDURE IF EXISTS sp_listar_clientes;
DELIMITER //
CREATE PROCEDURE sp_listar_clientes()
BEGIN
    SELECT c.id_Cliente, c.nombreCliente, c.apPatCliente, c.apMatCliente,
           c.fechaNac, c.sexo, u.username, u.correo, u.id_Usuario
    FROM Cliente c
    INNER JOIN Usuario u ON c.id_Usuario = u.id_Usuario
    ORDER BY c.nombreCliente ASC;
END //
DELIMITER ;

-- Obtener un cliente especifico por su ID (para edicion)
DROP PROCEDURE IF EXISTS sp_obtener_cliente;
DELIMITER //
CREATE PROCEDURE sp_obtener_cliente(IN p_id INT)
BEGIN
    SELECT c.id_Cliente, c.nombreCliente, c.apPatCliente, c.apMatCliente,
           c.fechaNac, c.sexo, u.username, u.correo, u.id_Usuario
    FROM Cliente c
    INNER JOIN Usuario u ON c.id_Usuario = u.id_Usuario
    WHERE c.id_Cliente = p_id;
END //
DELIMITER ;

-- Insertar un nuevo cliente (crea registro en Usuario + Cliente en una sola operacion)
-- Incluye validaciones: fecha no futura, edad minima 10 anios, username/correo unicos
DROP PROCEDURE IF EXISTS sp_insertar_cliente;
DELIMITER //
CREATE PROCEDURE sp_insertar_cliente(
    IN p_username VARCHAR(50),
    IN p_correo VARCHAR(200),
    IN p_contrasenia VARCHAR(30),
    IN p_nombre VARCHAR(30),
    IN p_apPat VARCHAR(20),
    IN p_apMat VARCHAR(20),
    IN p_fechaNac DATE,
    IN p_sexo VARCHAR(10)
)
BEGIN
    DECLARE nuevo_usuario_id INT;
    DECLARE existe INT;

    -- Validar que la fecha de nacimiento no sea futura
    IF p_fechaNac > CURDATE() THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La fecha de nacimiento no puede ser futura.';
    END IF;

    -- Validar edad minima de 10 anios
    IF TIMESTAMPDIFF(YEAR, p_fechaNac, CURDATE()) < 10 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Debes tener al menos 10 años.';
    END IF;

    -- Validar que el nombre de usuario no este repetido
    SELECT COUNT(*) INTO existe FROM Usuario WHERE username = p_username;
    IF existe > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El nombre de usuario ya está registrado.';
    END IF;

    -- Validar que el correo no este repetido
    SELECT COUNT(*) INTO existe FROM Usuario WHERE correo = p_correo;
    IF existe > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El correo ya está registrado.';
    END IF;

    -- Insertar en Usuario con rol Cliente (id_Rol = 2)
    INSERT INTO Usuario (username, correo, contrasenia, id_Rol)
    VALUES (p_username, p_correo, p_contrasenia, 2);

    SET nuevo_usuario_id = LAST_INSERT_ID();

    -- Insertar en Cliente vinculado al usuario creado
    INSERT INTO Cliente (nombreCliente, apPatCliente, apMatCliente, fechaNac, sexo, id_Usuario)
    VALUES (p_nombre, p_apPat, p_apMat, p_fechaNac, p_sexo, nuevo_usuario_id);

    -- Devolver el ID del nuevo cliente
    SELECT LAST_INSERT_ID() AS id_Cliente;
END //
DELIMITER ;

-- Actualizar un cliente existente (modifica Usuario + Cliente)
-- La contrasenia solo se actualiza si se proporciona un valor no vacio
DROP PROCEDURE IF EXISTS sp_actualizar_cliente;
DELIMITER //
CREATE PROCEDURE sp_actualizar_cliente(
    IN p_id INT,
    IN p_username VARCHAR(50),
    IN p_correo VARCHAR(200),
    IN p_contrasenia VARCHAR(30),
    IN p_nombre VARCHAR(30),
    IN p_apPat VARCHAR(20),
    IN p_apMat VARCHAR(20),
    IN p_fechaNac DATE,
    IN p_sexo VARCHAR(10)
)
BEGIN
    DECLARE uid INT;
    DECLARE existe INT;

    -- Validar que la fecha de nacimiento no sea futura
    IF p_fechaNac > CURDATE() THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La fecha de nacimiento no puede ser futura.';
    END IF;

    -- Validar edad minima de 10 anios
    IF TIMESTAMPDIFF(YEAR, p_fechaNac, CURDATE()) < 10 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Debes tener al menos 10 años.';
    END IF;

    -- Obtener el ID de Usuario asociado al cliente
    SELECT id_Usuario INTO uid FROM Cliente WHERE id_Cliente = p_id;

    -- Validar username unico excluyendo el registro actual
    SELECT COUNT(*) INTO existe FROM Usuario WHERE username = p_username AND id_Usuario != uid;
    IF existe > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El nombre de usuario ya está registrado.';
    END IF;

    -- Validar correo unico excluyendo el registro actual
    SELECT COUNT(*) INTO existe FROM Usuario WHERE correo = p_correo AND id_Usuario != uid;
    IF existe > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El correo ya está registrado.';
    END IF;

    -- Actualizar datos del usuario
    UPDATE Usuario
    SET username = p_username, correo = p_correo
    WHERE id_Usuario = uid;

    -- Actualizar contrasenia solo si se envio un valor nuevo
    IF p_contrasenia IS NOT NULL AND p_contrasenia != '' THEN
        UPDATE Usuario SET contrasenia = p_contrasenia WHERE id_Usuario = uid;
    END IF;

    -- Actualizar datos del cliente
    UPDATE Cliente
    SET nombreCliente = p_nombre, apPatCliente = p_apPat, apMatCliente = p_apMat,
        fechaNac = p_fechaNac, sexo = p_sexo
    WHERE id_Cliente = p_id;
END //
DELIMITER ;

-- Eliminar un cliente y su usuario asociado
-- Borra en cascada: Asistencia, Membresia, Cliente y Usuario
DROP PROCEDURE IF EXISTS sp_eliminar_cliente;
DELIMITER //
CREATE PROCEDURE sp_eliminar_cliente(IN p_id INT)
BEGIN
    DECLARE uid INT;

    -- Obtener el ID de Usuario antes de eliminar
    SELECT id_Usuario INTO uid FROM Cliente WHERE id_Cliente = p_id;

    -- Eliminar registros dependientes y luego el cliente y su usuario
    DELETE FROM Asistencia WHERE id_Cliente = p_id;
    DELETE FROM Membresia WHERE id_Cliente = p_id;
    DELETE FROM Cliente WHERE id_Cliente = p_id;
    DELETE FROM Usuario WHERE id_Usuario = uid;
END //
DELIMITER ;

-- =====================================================
-- PROCEDIMIENTOS: ENTRENADORES
-- =====================================================

-- Listar todos los entrenadores con su informacion de usuario y turno
DROP PROCEDURE IF EXISTS sp_listar_entrenadores;
DELIMITER //
CREATE PROCEDURE sp_listar_entrenadores()
BEGIN
    SELECT e.id_Entrenador, e.nombre, e.apPatEntrenador, e.apMatEntrenador,
           e.sexo, u.username, u.correo, u.id_Usuario,
           t.id_Turno, t.nombre AS turno
    FROM Entrenador e
    INNER JOIN Usuario u ON e.id_Usuario = u.id_Usuario
    LEFT JOIN Turno t ON e.id_Turno = t.id_Turno
    ORDER BY e.nombre ASC;
END //
DELIMITER ;

-- Obtener un entrenador especifico por su ID (para edicion)
DROP PROCEDURE IF EXISTS sp_obtener_entrenador;
DELIMITER //
CREATE PROCEDURE sp_obtener_entrenador(IN p_id INT)
BEGIN
    SELECT e.id_Entrenador, e.nombre, e.apPatEntrenador, e.apMatEntrenador,
           e.sexo, e.id_Turno, u.username, u.correo, u.id_Usuario
    FROM Entrenador e
    INNER JOIN Usuario u ON e.id_Usuario = u.id_Usuario
    WHERE e.id_Entrenador = p_id;
END //
DELIMITER ;

-- Insertar un nuevo entrenador (crea Usuario + Entrenador)
-- Incluye validaciones de username/correo unicos
DROP PROCEDURE IF EXISTS sp_insertar_entrenador;
DELIMITER //
CREATE PROCEDURE sp_insertar_entrenador(
    IN p_username VARCHAR(50),
    IN p_correo VARCHAR(200),
    IN p_contrasenia VARCHAR(30),
    IN p_nombre VARCHAR(30),
    IN p_apPat VARCHAR(20),
    IN p_apMat VARCHAR(20),
    IN p_sexo VARCHAR(10),
    IN p_id_Turno INT
)
BEGIN
    DECLARE nuevo_usuario_id INT;
    DECLARE existe INT;

    -- Validar que el nombre de usuario no este repetido
    SELECT COUNT(*) INTO existe FROM Usuario WHERE username = p_username;
    IF existe > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El nombre de usuario ya está registrado.';
    END IF;

    -- Validar que el correo no este repetido
    SELECT COUNT(*) INTO existe FROM Usuario WHERE correo = p_correo;
    IF existe > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El correo ya está registrado.';
    END IF;

    -- Insertar en Usuario con rol Entrenador (id_Rol = 3)
    INSERT INTO Usuario (username, correo, contrasenia, id_Rol)
    VALUES (p_username, p_correo, p_contrasenia, 3);

    SET nuevo_usuario_id = LAST_INSERT_ID();

    -- Insertar en Entrenador vinculado al usuario creado
    INSERT INTO Entrenador (nombre, apPatEntrenador, apMatEntrenador, sexo, id_Usuario, id_Turno)
    VALUES (p_nombre, p_apPat, p_apMat, p_sexo, nuevo_usuario_id, p_id_Turno);

    -- Devolver el ID del nuevo entrenador
    SELECT LAST_INSERT_ID() AS id_Entrenador;
END //
DELIMITER ;

-- Actualizar un entrenador existente (modifica Usuario + Entrenador)
-- La contrasenia solo se actualiza si se proporciona un valor no vacio
DROP PROCEDURE IF EXISTS sp_actualizar_entrenador;
DELIMITER //
CREATE PROCEDURE sp_actualizar_entrenador(
    IN p_id INT,
    IN p_username VARCHAR(50),
    IN p_correo VARCHAR(200),
    IN p_contrasenia VARCHAR(30),
    IN p_nombre VARCHAR(30),
    IN p_apPat VARCHAR(20),
    IN p_apMat VARCHAR(20),
    IN p_sexo VARCHAR(10),
    IN p_id_Turno INT
)
BEGIN
    DECLARE uid INT;
    DECLARE existe INT;

    -- Obtener el ID de Usuario asociado al entrenador
    SELECT id_Usuario INTO uid FROM Entrenador WHERE id_Entrenador = p_id;

    -- Validar username unico excluyendo el registro actual
    SELECT COUNT(*) INTO existe FROM Usuario WHERE username = p_username AND id_Usuario != uid;
    IF existe > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El nombre de usuario ya está registrado.';
    END IF;

    -- Validar correo unico excluyendo el registro actual
    SELECT COUNT(*) INTO existe FROM Usuario WHERE correo = p_correo AND id_Usuario != uid;
    IF existe > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El correo ya está registrado.';
    END IF;

    -- Actualizar datos del usuario
    UPDATE Usuario
    SET username = p_username, correo = p_correo
    WHERE id_Usuario = uid;

    -- Actualizar contrasenia solo si se envio un valor nuevo
    IF p_contrasenia IS NOT NULL AND p_contrasenia != '' THEN
        UPDATE Usuario SET contrasenia = p_contrasenia WHERE id_Usuario = uid;
    END IF;

    -- Actualizar datos del entrenador
    UPDATE Entrenador
    SET nombre = p_nombre, apPatEntrenador = p_apPat, apMatEntrenador = p_apMat,
        sexo = p_sexo, id_Turno = p_id_Turno
    WHERE id_Entrenador = p_id;
END //
DELIMITER ;

-- Eliminar un entrenador y su usuario asociado
-- Borra en cascada: Horario_Entrenador, Especialidad_Entrenador, Membresia, Entrenador y Usuario
DROP PROCEDURE IF EXISTS sp_eliminar_entrenador;
DELIMITER //
CREATE PROCEDURE sp_eliminar_entrenador(IN p_id INT)
BEGIN
    DECLARE uid INT;

    -- Obtener el ID de Usuario antes de eliminar
    SELECT id_Usuario INTO uid FROM Entrenador WHERE id_Entrenador = p_id;

    -- Eliminar registros dependientes y luego el entrenador y su usuario
    DELETE FROM Horario_Entrenador WHERE id_Entrenador = p_id;
    DELETE FROM Especialidad_Entrenador WHERE id_Entrenador = p_id;
    DELETE FROM Membresia WHERE id_Entrenador = p_id;
    DELETE FROM Entrenador WHERE id_Entrenador = p_id;
    DELETE FROM Usuario WHERE id_Usuario = uid;
END //
DELIMITER ;
