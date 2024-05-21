<?php
// Conexión a la base de datos
include 'conexion.php';

// Recoger los datos del formulario
$id_producto = $_POST['id_producto'];

// Consulta SQL para eliminar el producto
$sql = "DELETE FROM productos WHERE id = $id_producto";

// Ejecutar la consulta
if (mysqli_query($conn, $sql)) {
    echo "Producto eliminado con éxito";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>

