DELIMITER //

CREATE TRIGGER asignar_nueva_encuesta_usuarios
AFTER INSERT ON encuesta
FOR EACH ROW
BEGIN
    -- Variables locales
    DECLARE v_idUsuario INT;
    
    -- Obtener el ID de la nueva encuesta
    SET v_idUsuario = 0;
    
    -- Insertar la nueva encuesta para cada usuario
    WHILE v_idUsuario IS NOT NULL DO
        -- Obtener el siguiente usuario
        SELECT MIN(idusuario) INTO v_idUsuario FROM usuario WHERE idusuario > v_idUsuario;
        
        -- Si hay un usuario disponible, asignarle la nueva encuesta
        IF v_idUsuario IS NOT NULL THEN
            INSERT INTO usuarioencuesta (idusuario, idencuesta, estado, disponibilidad)
            VALUES (v_idUsuario, NEW.idencuesta, 'pendiente', '0');
        END IF;
    END WHILE;
END //

DELIMITER ;


DELIMITER //

CREATE TRIGGER asignar_encuestas_nuevo_usuario
AFTER INSERT ON usuario
FOR EACH ROW
BEGIN
    DECLARE v_idUsuario INT;
    
    -- Obtener el ID del usuario recién insertado
    SELECT NEW.idusuario INTO v_idUsuario;
    
    -- Asignar todas las encuestas disponibles al nuevo usuario
    INSERT INTO usuarioencuesta (idusuario, idencuesta, estado, disponibilidad)
    SELECT v_idUsuario, idencuesta, 'pendiente', '1' FROM encuesta;
END //

DELIMITER ;
