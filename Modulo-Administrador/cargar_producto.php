<?php
// Conexión a la base de datos
include 'conexion.php';

// Recoger los datos del formulario
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$imagen = $_POST['imagen'];
$descripcion = $_POST['descripcion'];
$cantidad = $_POST['cantidad'];

// Consulta SQL para insertar el producto
$sql = "INSERT INTO productos (nombre, precio, imagen, descripcion, cantidad) VALUES ('$nombre', '$precio', '$imagen', '$descripcion', '$cantidad')";

// Ejecutar la consulta
if (mysqli_query($conexion, $sql)) {
    echo "Producto cargado con éxito";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
