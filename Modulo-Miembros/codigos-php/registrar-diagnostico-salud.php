<?php
// Archivo: registrar-diagnostico-salud.php

// Incluye el archivo de conexión a la base de datos
include 'conexion.php'; // Asegúrate de que el nombre del archivo sea correcto

// Recibe las variables del formulario por POST
$documento = $_POST['documento'];
$complicaciones = $_POST['complicaciones'];
$diabetes = $_POST['diabetes'];
$hipertension = $_POST['hipertension'];
$asma = $_POST['asma'];

// Realiza el INSERT en la tabla diagnosticosalud
$sql = "INSERT INTO diagnosticosalud (documento, complicaciones, diabetes, hipertension, asma)
        VALUES ('$documento', '$complicaciones', '$diabetes', '$hipertension', '$asma')";

if (mysqli_query($conn, $sql)) {
    echo "Datos guardados correctamente.";
    echo "<script>window.location.href='/Modulo-Miembros/clientes-diagnostico.html';</script>";
    
    exit;
} else {
    echo "Error al guardar los datos: " . mysqli_error($conn);
}

// Cierra la conexión a la base de datos
mysqli_close($conn);
?>
