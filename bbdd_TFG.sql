-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS daw_reservas;
USE daw_reservas;

-- Crear tabla usuario
CREATE TABLE usuario (
    id_usuario INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(45) NOT NULL,
    email VARCHAR(100) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    rol ENUM('cliente', 'administrador') DEFAULT 'cliente'
);

-- Crear tabla pista
CREATE TABLE pista (
    id_pista INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    deporte ENUM('futbol', 'baloncesto', 'tenis', 'padel') NOT NULL,
    precio_hora DECIMAL(10,2) NOT NULL
);

-- Crear tabla reservas
CREATE TABLE reserva (
    id_reserva INT(11) AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT(11) NOT NULL,
    pista_id INT(11) NOT NULL,
    fecha_reserva DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    estado ENUM('pendiente', 'confirmada', 'cancelada') DEFAULT 'pendiente',

    -- Relaciones
    FOREIGN KEY (usuario_id) REFERENCES usuario(id_usuario)
        ON DELETE CASCADE ON UPDATE CASCADE,

    FOREIGN KEY (pista_id) REFERENCES pista(id_pista)
        ON DELETE CASCADE ON UPDATE CASCADE
);