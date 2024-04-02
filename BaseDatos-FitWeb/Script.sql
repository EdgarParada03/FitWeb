DROP DATABASE IF EXISTS FITWEB;
CREATE DATABASE FITWEB;
USE FITWEB;

CREATE TABLE Persona (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombreCompleto VARCHAR(50),
    numeroIdentificacion VARCHAR(20),
    fechaNacimiento DATE,
    edad INT,
    correo VARCHAR(50),
    telefono VARCHAR(15),
    sexo VARCHAR(15),
    contraseña VARCHAR(50)
);

CREATE TABLE Entrenador (
    id INT AUTO_INCREMENT PRIMARY KEY,
    persona_id INT,
    especialidad VARCHAR(50),
    FOREIGN KEY (persona_id) REFERENCES Persona(id)
);

CREATE TABLE Miembro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    persona_id INT,
    estado BOOLEAN,
    FOREIGN KEY (persona_id) REFERENCES Persona(id)
);

CREATE TABLE MembresiaPagar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numeroIdentificacion VARCHAR(20),
    fecha_inicio DATE,
    plan VARCHAR(25),
    fecha_fin DATE,
    tarjeta VARCHAR(50)
);

CREATE TABLE prueba(
    id INT PRIMARY KEY,
    nombre VARCHAR(50)
);

DROP TABLE prueba;