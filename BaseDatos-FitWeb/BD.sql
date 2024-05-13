
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

use FITWEB;
drop table MembresiaPagar;
CREATE TABLE MembresiaPagar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_miembro INT,
    fecha_inicio DATE,
    plan VARCHAR(25),
    fecha_fin DATE,
    tarjeta VARCHAR(50),
    FOREIGN KEY (id_miembro) REFERENCES Miembro(id)
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

use FITWEB;
drop table diagnosticosalud;
CREATE TABLE diagnosticosalud (
    id INT AUTO_INCREMENT PRIMARY KEY,
    documento VARCHAR(255) NOT NULL,
    complicaciones ENUM('Sí', 'No') NOT NULL,
    diabetes ENUM('Sí', 'No') NOT NULL,
    hipertension ENUM('Sí', 'No') NOT NULL,
    asma ENUM('Sí', 'No') NOT NULL
);



use FITWEB;
drop table diagnosticoimc;
CREATE TABLE diagnosticoimc (
    id INT AUTO_INCREMENT PRIMARY KEY,
    documento VARCHAR(255) NOT NULL,
    imc DECIMAL(5, 2) NOT NULL,
    estado VARCHAR(50) NOT NULL
);

CREATE TABLE Rutinas (
 
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30),
    zona_muscular VARCHAR(30),
    ejercicios VARCHAR(100),
    series VARCHAR(50),
    descripcion VARCHAR(100),
    video TEXT  
);

/*cambiar tabla de personalizados por esta */
CREATE TABLE Personalizados (

    id INT AUTO_INCREMENT PRIMARY KEY,
    video TEXT,
    plan_alimentacion VARCHAR(255),
    documento VARCHAR(255) NOT NULL 


);

/*nueva tabla*/
CREATE TABLE clase (

    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    sitio VARCHAR(50),
    duracion VARCHAR(20),
    tipoClase VARCHAR(50),
    fecha DATE,
    instructor VARCHAR(50)



);

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

DELIMITER ;

UPDATE Personalizados SET video = ConvertToEmbeddedLink(video);

