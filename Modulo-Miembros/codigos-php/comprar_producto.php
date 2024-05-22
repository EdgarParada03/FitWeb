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
    echo "<script type='text/javascript'>alert('¡Compra realizada con éxito! Gracias por tu compra. Tu pedido está siendo procesado y pronto recibirás más información.');</script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


// Cerrar la conexión
mysqli_close($conn);
?>

