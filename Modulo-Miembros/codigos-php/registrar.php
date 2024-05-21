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

// Busca el ID del miembro usando el número de identificación
$sql_buscar_id = "SELECT id FROM Miembro WHERE persona_id IN (SELECT id FROM Persona WHERE numeroIdentificacion = '$numeroIdentificacion')";
$result = mysqli_query($conn, $sql_buscar_id);

if (mysqli_num_rows($result) > 0) {
    // Obtiene el ID del miembro
    $row = mysqli_fetch_assoc($result);
    $id_miembro = $row['id'];

    // Crea la consulta SQL para insertar los datos en la tabla 'MembresiaPagar'
    $sql = "INSERT INTO MembresiaPagar (id_miembro, fecha_inicio, plan, fecha_fin, tarjeta) 
            VALUES ('$id_miembro', '$fecha_inicio', '$plan', '$fecha_fin', '$tarjeta')";

    // Ejecuta la consulta
    if (mysqli_query($conn, $sql)) {
        echo "Los datos se han guardado correctamente.";
        echo "<script>window.location.href='/Modulo-Miembros/clientes.html';</script>";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "No se encontró un miembro con el número de identificación proporcionado.";
}

// Cierra la conexión
mysqli_close($conn);
?>
