<?php
// Conexión a la base de datos
include 'conexion.php';

// Recoger los datos del formulario
$id_producto = $_POST['id_producto'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$imagen = $_POST['imagen'];
$descripcion = $_POST['descripcion'];
$cantidad = $_POST['cantidad'];

// Consulta SQL para actualizar el producto
$sql = "UPDATE productos SET nombre = '$nombre', precio = $precio, imagen = '$imagen', descripcion = '$descripcion', cantidad = $cantidad WHERE id = $id_producto";

// Ejecutar la consulta
if (mysqli_query($conn, $sql)) {
    echo "Producto actualizado con éxito";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>