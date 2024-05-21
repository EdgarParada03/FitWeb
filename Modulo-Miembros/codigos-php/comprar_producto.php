<?php
// Conexión a la base de datos
include 'conexion.php';

// Recoger los datos del formulario
$id_producto = $_POST['id_producto'];
$cantidad_comprada = $_POST['cantidad'];

// Consulta SQL para actualizar la cantidad del producto
$sql = "UPDATE productos SET cantidad = cantidad - $cantidad_comprada WHERE id = $id_producto";

// Ejecutar la consulta
if (mysqli_query($conn, $sql)) {
    // Redirigir a la página de confirmación
    header('Location: confirmacion_compra.html');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>

