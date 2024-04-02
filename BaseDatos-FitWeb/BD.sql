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

DELIMITER //

CREATE TRIGGER calcular_edad BEFORE INSERT ON Persona
FOR EACH ROW
BEGIN
    SET NEW.edad = TIMESTAMPDIFF(YEAR, NEW.fechaNacimiento, CURDATE());
END//

CREATE TRIGGER llenar_miembro AFTER INSERT ON Persona
FOR EACH ROW
BEGIN
    INSERT INTO Miembro (persona_id, estado)
    VALUES (NEW.id, true);
END//

DELIMITER ;

CREATE TABLE diagnosticosalud(
    id INT AUTO_INCREMENT PRIMARY KEY,
    documento VARCHAR(255) NOT NULL,
    complicaciones ENUM('Sí', 'No') NOT NULL,
    diabetes ENUM('Sí', 'No') NOT NULL,
    hipertension ENUM('Sí', 'No') NOT NULL,
    asma ENUM('Sí', 'No') NOT NULL
);

CREATE TABLE diagnosticoimc (
    id INT AUTO_INCREMENT PRIMARY KEY,
    documento VARCHAR(255) NOT NULL,
    imc DECIMAL(5, 2) NOT NULL,
    estado VARCHAR(50) NOT NULL
);


