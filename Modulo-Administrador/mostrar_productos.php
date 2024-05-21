<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root" , "" , "fitweb");

// Verificar la conexión
if (!$conexion) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}

// Consulta SQL para obtener todos los productos
$sql = "SELECT * FROM productos";

// Ejecutar la consulta
$resultado = mysqli_query($conexion, $sql);

// Crear un array para almacenar los productos
$productos = array();

// Recorrer los resultados y añadirlos al array
while ($producto = mysqli_fetch_assoc($resultado)) {
    $productos[] = $producto;
}

// Devolver los productos en formato JSON
header('Content-Type: application/json');
echo json_encode($productos);

// Cerrar la conexión
mysqli_close($conexion);
?>
