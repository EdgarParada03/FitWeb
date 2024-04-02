<?php
// Archivo: registro.php

// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

// Recibe las variables del formulario por POST
$documento = $_POST['documento'];
$peso = $_POST['peso'];
$altura = $_POST['altura'] / 100; // Convertir a metros
$imc = $peso / ($altura * $altura);

// Determina el estado según el IMC
if ($imc < 18.5) {
    $estado = 'Bajo de peso';
} elseif ($imc >= 18.5 && $imc < 24.9) {
    $estado = 'Peso normal';
} else {
    $estado = 'Sobrepeso';
}

// Realiza el INSERT en la tabla diagnosticosalud
$sql = "INSERT INTO diagnosticoimc (documento, imc, estado)
        VALUES ('$documento', '$imc', '$estado')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(['message' => 'Datos guardados correctamente']);
    echo "<script>window.location.href='/Modulo-Miembros/clientes-diagnostico.html';</script>";
} else {
    echo json_encode(['message' => 'Error al guardar los datos: ' . mysqli_error($conn)]);
}

// Cierra la conexión a la base de datos
mysqli_close($conn);
?>
