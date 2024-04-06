<?php
include 'conexion.php';

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$zonaMuscular = $_POST['zonaMuscular'];
$ejercicios = $_POST['ejercicios'];
$series = $_POST['series'];
$descripcion = $_POST['descripcion'];
$video = $_POST['video'];

// Insertar datos en la tabla
$sql = "INSERT INTO Rutinas (nombre, zona_muscular, ejercicios, series, descripcion, video) VALUES ('$nombre', '$zonaMuscular ', '$ejercicios', '$series ', '$descripcion', '$video')";

if ($conn->query($sql) === TRUE) {
    echo "Registro guardado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
