CREATE DATABASE IF NOT EXISTS bdtareasusuario;

USE bdtareasusuario;

CREATE TABLE usuario (
    idusuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    correo VARCHAR(50),
    clave VARCHAR(16),
    tipo VARCHAR(25) CHECK (tipo in ("administrador","cliente"))
);

CREATE TABLE tarea (
    idtarea INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(50)
);
CREATE TABLE encuesta (
    idencuesta INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(1000),
    idtarea INT,
    FOREIGN KEY (idtarea) REFERENCES tarea(idtarea)
);

CREATE TABLE usuarioencuesta (
    idusuario INT,
    idencuesta INT,
    PRIMARY KEY (idusuario,idencuesta),
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario),
    FOREIGN KEY (idencuesta) REFERENCES encuesta(idencuesta),
    estado VARCHAR(10) CHECK(estado in ('pendiente','completado'))
);