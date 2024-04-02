<?php

// Incluye el archivo de conexión a la base de datos
require_once('connection.php'); // Asegúrate de que el nombre del archivo sea correcto

// Recibe los valores del formulario
$numeroIdentificacion = $_POST['numeroIdentificacion'];
$fecha_inicio = $_POST['fecha_inicio'];
$plan = $_POST['plan'];
$fecha_fin = $_POST['fecha_fin'];
$tarjeta = $_POST['tarjeta'];

// Crea la consulta SQL para insertar los datos en la tabla 'MembresiaPagar'
$sql = "INSERT INTO membresiapagar (numeroIdentificacion, fecha_inicio, plan, fecha_fin, tarjeta) 
          VALUES ('$numeroIdentificacion', '$fecha_inicio', '$plan', '$fecha_fin', '$tarjeta')";

// Ejecuta la consulta
if ($conexion->query($query) === TRUE) {
    echo "Datos insertados correctamente en la base de datos.";
} else {
    echo "Error al insertar datos en la base de datos: " . $conexion->error;
}

// Cierra la conexión
$conexion->close();
?>