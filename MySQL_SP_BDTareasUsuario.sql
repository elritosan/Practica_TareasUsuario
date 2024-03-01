DELIMITER //

CREATE PROCEDURE asignarEncuestas(
    IN usuario_id INT,
    IN tarea_id INT
)
BEGIN
    DECLARE encuesta_id INT;
    
    -- Obtenemos todas las encuestas asociadas a la tarea proporcionada
    DECLARE cur_encuestas CURSOR FOR
        SELECT idencuesta
        FROM encuesta
        WHERE idtarea = tarea_id;
    
    -- Variable para manejar el valor del cursor
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET encuesta_id = NULL;
    
    OPEN cur_encuestas;
    
    -- Iteramos sobre las encuestas asociadas a la tarea
    asignar_encuestas: LOOP
        FETCH cur_encuestas INTO encuesta_id;
        
        IF encuesta_id IS NULL THEN
            LEAVE asignar_encuestas;
        END IF;
        
        -- Insertamos la asignación en la tabla usuarioencuesta
        INSERT INTO usuarioencuesta (idusuario, idencuesta, estado)
        VALUES (usuario_id, encuesta_id, 'pendiente');
        
    END LOOP asignar_encuestas;
    
    CLOSE cur_encuestas;
    
END //

DELIMITER ;



DELIMITER //

CREATE PROCEDURE asignarEncuestasUsuarios(
    IN tarea_id INT
)
BEGIN
    DECLARE usuario_id INT;
    
    -- Obtenemos los usuarios asociados a la tarea proporcionada
    DECLARE cur_usuarios CURSOR FOR
        SELECT idusuario
        FROM usuarioencuesta ue
        JOIN encuesta e ON ue.idencuesta = e.idencuesta
        WHERE e.idtarea = tarea_id;
    
    -- Variable para manejar el valor del cursor
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET usuario_id = NULL;
    
    OPEN cur_usuarios;
    
    -- Iteramos sobre los usuarios asociados a la tarea
    asignar_usuarios: LOOP
        FETCH cur_usuarios INTO usuario_id;
        
        IF usuario_id IS NULL THEN
            LEAVE asignar_usuarios;
        END IF;
        
        -- Insertamos la asignación en la tabla usuarioencuesta si no existe ya
        INSERT IGNORE INTO usuarioencuesta (idusuario, idencuesta, estado)
        SELECT usuario_id, idencuesta, 'pendiente'
        FROM encuesta
        WHERE idtarea = tarea_id;
        
    END LOOP asignar_usuarios;
    
    CLOSE cur_usuarios;
    
END //

DELIMITER ;



