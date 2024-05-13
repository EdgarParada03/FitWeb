<?php
// Incluir archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se recibió el ID del registro a eliminar
if(isset($_GET['id_eliminar'])) {
    // Obtener el ID del registro a eliminar
    $id_eliminar = $_GET['id_eliminar'];

    // Eliminar el registro de la base de datos
    $sql = "DELETE FROM clase WHERE id = $id_eliminar";
    if ($conn->query($sql) === TRUE) {
        echo "Registro eliminado exitosamente.";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }
} else {
    echo "ID de registro a eliminar no proporcionado.";
}

// Cerrar conexión
$conn->close();
?>
