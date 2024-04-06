<?php
include 'conexion.php';

// Recibir datos del formulario
$video = $_POST['video'];
$plan_alimentacion = $_POST['plan_alimentacion'];
$documento = $_POST['documento'];


// Insertar datos en la tabla
$sql = "INSERT INTO Personalizados (video, plan_alimentacion, documento) 
VALUES ('$video', '$plan_alimentacion ', '$documento')";

if ($conn->query($sql) === TRUE) {
    echo "Registro guardado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>