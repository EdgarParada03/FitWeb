
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
    contraseña VARCHAR(50),
    rol VARCHAR(20) DEFAULT 'miembro'
);


ALTER TABLE Persona MODIFY COLUMN rol VARCHAR(20) DEFAULT 'miembro' NULL;


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


DROP TRIGGER IF EXISTS llenar_entrenador;
CREATE TRIGGER llenar_entrenador AFTER INSERT ON Persona
FOR EACH ROW
BEGIN
   
    IF NEW.rol = 'entrenador' THEN
       
        INSERT INTO Entrenador (persona_id, especialidad) VALUES (NEW.id, 'Especificar especialidad');
    ELSE
        
        INSERT INTO Miembro (persona_id, estado) VALUES (NEW.id, TRUE);
    END IF;
END//


DELIMITER ;


CREATE TABLE diagnosticoimc (
    id INT AUTO_INCREMENT PRIMARY KEY,
    documento VARCHAR(255) NOT NULL,
    imc DECIMAL(5, 2) NOT NULL,
    estado VARCHAR(50) NOT NULL
);


