-- Borramos la base de datos si existe
DROP DATABASE IF EXISTS FITWEB;

-- Creamos la base de datos
CREATE DATABASE FITWEB;

-- Usamos la base de datos recién creada
USE FITWEB;

-- Creamos la tabla Persona
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
    rol VARCHAR(20) DEFAULT 'miembro' -- Añadido campo 'rol' con valor por defecto 'cliente'
);

-- Modificamos la columna rol para permitir valores NULL
ALTER TABLE Persona MODIFY COLUMN rol VARCHAR(20) DEFAULT 'miembro' NULL;

-- Creamos la tabla Entrenador
CREATE TABLE Entrenador (
    id INT AUTO_INCREMENT PRIMARY KEY,
    persona_id INT,
    especialidad VARCHAR(50),
    FOREIGN KEY (persona_id) REFERENCES Persona(id) -- Añadimos la restricción de clave externa
);

-- Creamos la tabla Miembro
CREATE TABLE Miembro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    persona_id INT,
    estado BOOLEAN,
    FOREIGN KEY (persona_id) REFERENCES Persona(id) -- Añadimos la restricción de clave externa
);

-- Creamos la tabla MembresiaPagar
CREATE TABLE MembresiaPagar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numeroIdentificacion VARCHAR(20),
    fecha_inicio DATE,
    plan VARCHAR(25),
    fecha_fin DATE,
    tarjeta VARCHAR(50)
);

-- Definimos el delimitador para los triggers
DELIMITER //

-- Creamos el trigger calcular_edad
CREATE TRIGGER calcular_edad BEFORE INSERT ON Persona
FOR EACH ROW
BEGIN
    SET NEW.edad = TIMESTAMPDIFF(YEAR, NEW.fechaNacimiento, CURDATE());
END//

-- Creamos el trigger llenar_entrenador
DROP TRIGGER IF EXISTS llenar_entrenador;
CREATE TRIGGER llenar_entrenador AFTER INSERT ON Persona
FOR EACH ROW
BEGIN
    -- Verificamos si la persona insertada tiene el rol de 'entrenador'
    IF NEW.rol = 'entrenador' THEN
        -- Insertamos en la tabla 'Entrenador'
        INSERT INTO Entrenador (persona_id, especialidad) VALUES (NEW.id, 'Especificar especialidad');
    ELSE
        -- Insertamos en la tabla 'Miembro'
        INSERT INTO Miembro (persona_id, estado) VALUES (NEW.id, TRUE);
    END IF;
END//

-- Restauramos el delimitador
DELIMITER ;



