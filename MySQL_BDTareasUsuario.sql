CREATE DATABASE IF NOT EXISTS bdtareasusuario;

USE bdtareasusuario;

CREATE TABLE usuario (
    idusuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    correo VARCHAR(50),
    clave VARCHAR(16),
    tipo VARCHAR(25) CHECK (tipo IN ('administrador','cliente'))
);

CREATE TABLE tarea (
    idtarea INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(50)
);
CREATE TABLE encuesta (
    idencuesta INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(1000),
    idtarea INT,
    FOREIGN KEY (idtarea) REFERENCES tarea(idtarea)  ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE usuarioencuesta (
    idusuario INT,
    idencuesta INT,
    PRIMARY KEY (idusuario,idencuesta),
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (idencuesta) REFERENCES encuesta(idencuesta) ON DELETE CASCADE ON UPDATE CASCADE,
    estado VARCHAR(10) CHECK (estado IN ('pendiente','completado')),
    disponibilidad CHAR(1) CHECK (disponibilidad IN ('0','1'))
);