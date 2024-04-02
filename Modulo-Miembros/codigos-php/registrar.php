<?php
// Archivo: registrar.php

// Incluye el archivo de conexión a la base de datos
require_once('conexion.php'); // Asegúrate de que el nombre del archivo sea correcto

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
if (mysqli_query($conn, $sql)) {

    echo "Los datos se han guardado correctamente.";

    echo "<script>window.location.href='/Modulo-Miembros/clientes.html';</script>";
    //REDIRECCIONA A UNA PAGINA QUE NOSOTROS QUERRAMOS
    exit;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>
