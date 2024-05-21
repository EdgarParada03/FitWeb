-- Eliminar la base de datos si existe
DROP DATABASE IF EXISTS FITWEB;

-- Crear la base de datos FITWEB
CREATE DATABASE FITWEB;

-- Usar la base de datos FITWEB
USE FITWEB;

-- Crear la tabla Persona
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

-- Modificar la columna rol de la tabla Persona
ALTER TABLE Persona MODIFY COLUMN rol VARCHAR(20) DEFAULT 'miembro' NULL;

-- Crear la tabla Entrenador
CREATE TABLE Entrenador (
    id INT AUTO_INCREMENT PRIMARY KEY,
    persona_id INT,
    especialidad VARCHAR(50),
    FOREIGN KEY (persona_id) REFERENCES Persona(id)
);

-- Crear la tabla Miembro
CREATE TABLE Miembro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    persona_id INT,
    estado BOOLEAN,
    FOREIGN KEY (persona_id) REFERENCES Persona(id)
);

-- Crear la tabla Administrador
CREATE TABLE Administrador (
    id INT AUTO_INCREMENT PRIMARY KEY,
    persona_id INT,
    FOREIGN KEY (persona_id) REFERENCES Persona(id)
);

-- Crear la tabla Gerente
CREATE TABLE Gerente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    persona_id INT,
    FOREIGN KEY (persona_id) REFERENCES Persona(id)
);

-- Crear la tabla MembresiaPagar
CREATE TABLE MembresiaPagar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numeroIdentificacion VARCHAR(20),
    fecha_inicio DATE,
    plan VARCHAR(25),
    fecha_fin DATE,
    tarjeta VARCHAR(50)
);

-- Crear el trigger calcular_edad
DELIMITER //
CREATE TRIGGER calcular_edad BEFORE INSERT ON Persona
FOR EACH ROW
BEGIN
    SET NEW.edad = TIMESTAMPDIFF(YEAR, NEW.fechaNacimiento, CURDATE());
END//
DELIMITER ;


-- TRIGGER PARA LLEGAR LOS ROLES CORRESPONDIENTES AL USUARIO CREADO
DELIMITER //

CREATE TRIGGER llenar_roles_despues_insertar 
AFTER INSERT ON Persona
FOR EACH ROW
BEGIN
    IF NEW.rol = 'entrenador' THEN
        INSERT INTO Entrenador (persona_id, especialidad) VALUES (NEW.id, 'Especificar especialidad');
    ELSEIF NEW.rol = 'administrador' THEN
        INSERT INTO Administrador (persona_id) VALUES (NEW.id);
    ELSEIF NEW.rol = 'gerente' THEN
        INSERT INTO Gerente (persona_id) VALUES (NEW.id);
    ELSE
        INSERT INTO Miembro (persona_id, estado) VALUES (NEW.id, TRUE);
    END IF;
END//

DELIMITER ;


-- Crear la tabla diagnosticosalud
CREATE TABLE diagnosticosalud (
    id INT AUTO_INCREMENT PRIMARY KEY,
    documento VARCHAR(255) NOT NULL,
    complicaciones ENUM('Sí', 'No') NOT NULL,
    diabetes ENUM('Sí', 'No') NOT NULL,
    hipertension ENUM('Sí', 'No') NOT NULL,
    asma ENUM('Sí', 'No') NOT NULL
);

-- Crear la tabla diagnosticoimc
CREATE TABLE diagnosticoimc (
    id INT AUTO_INCREMENT PRIMARY KEY,
    documento VARCHAR(255) NOT NULL,
    imc DECIMAL(5, 2) NOT NULL,
    estado VARCHAR(50) NOT NULL
);

-- Crear la tabla Rutinas
CREATE TABLE Rutinas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30),
    zona_muscular VARCHAR(30),
    ejercicios VARCHAR(100),
    series VARCHAR(50),
    descripcion VARCHAR(100),
    video TEXT
);

-- Crear la tabla Personalizados
CREATE TABLE Personalizados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    video TEXT,
    plan_alimentacion VARCHAR(255),
    documento VARCHAR(255) NOT NULL
);

-- Crear la tabla clase
CREATE TABLE clase (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    sitio VARCHAR(50),
    duracion VARCHAR(20),
    tipoClase VARCHAR(50),
    fecha DATE,
    instructor VARCHAR(50)
);

-- Crear la función ConvertToEmbeddedLink
DELIMITER //
CREATE FUNCTION ConvertToEmbeddedLink(normal_link TEXT) RETURNS TEXT
BEGIN
    DECLARE video_id VARCHAR(50);
    DECLARE embedded_link TEXT;

    -- Extraer el ID del video de los enlaces normales (por ejemplo, de YouTube)
    SET video_id = SUBSTRING_INDEX(SUBSTRING_INDEX(normal_link, '?v=', -1), '&', 1);

    -- Construir el enlace embebido
    SET embedded_link = CONCAT('<iframe width="560" height="315" src="https://www.youtube.com/embed/', video_id, '" frameborder="0" allowfullscreen></iframe>');

    RETURN embedded_link;
END;
//

-- Actualizar la columna video de la tabla Personalizados usando la función ConvertToEmbeddedLink
DELIMITER ;
UPDATE Personalizados SET video = ConvertToEmbeddedLink(video);

USE fitweb;

CREATE TABLE gerente(
    idGerente INT AUTO_INCREMENT PRIMARY KEY,
    nombreCompleto VARCHAR (255),
    numeroIdentificacion INT,
    fechaNacimiento DATE,
    edad INT,
    telefono INT,
    contraseña VARCHAR (50)
);

DELIMITER //
CREATE TRIGGER calcular_edad_gerente
BEFORE INSERT ON gerente
FOR EACH ROW
BEGIN
    DECLARE fecha_nacimiento DATE;
    DECLARE edad INT;

    SET fecha_nacimiento = NEW.fechaNacimiento;
    SET edad = TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE());

    SET NEW.edad = edad;
END;
//
DELIMITER ;
USE FITWEB;
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    imagen VARCHAR(255),
    descripcion TEXT,
    cantidad INT NOT NULL
);