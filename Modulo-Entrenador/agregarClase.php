<?php
include 'conexion.php';

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$sitio = $_POST['sitio'];
$duracion = $_POST['duracion'];
$tipo = $_POST['tipo'];
$fecha = $_POST['fecha'];
$instructor = $_POST['instructor'];

// Insertar datos en la tabla
$sql = "INSERT INTO clase (nombre, sitio, duracion, tipoClase, fecha, instructor) VALUES ('$nombre', '$sitio ', 
'$duracion', '$tipo ', '$fecha', '$instructor')";

if ($conn->query($sql) === TRUE) {
    echo "Registro guardado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
