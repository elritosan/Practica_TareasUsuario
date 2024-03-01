DELIMITER //

CREATE TRIGGER actualizarAsignaciones
AFTER INSERT
ON encuesta
FOR EACH ROW
BEGIN
    DECLARE tarea_id INT;
    
    -- Obtenemos la tarea asociada a esta encuesta
    SELECT idtarea INTO tarea_id
    FROM encuesta
    WHERE idencuesta = NEW.idencuesta;
    
    -- Si la tarea existe, actualizamos las asignaciones para los usuarios asociados a esa tarea
    IF tarea_id IS NOT NULL THEN
        -- Actualizamos las asignaciones solo para los usuarios asociados a esta tarea
        CALL asignarEncuestasUsuarios(tarea_id);
    END IF;
END //

DELIMITER ;
