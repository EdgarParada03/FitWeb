<?php
// Incluir archivo de conexión a la base de datos
include 'conexion.php';

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se envió el formulario con el campo documento
    if (isset($_POST["documento"])) {
        // Recibir el número de documento del formulario
        $documento = $_POST["documento"];
        
       
        
        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $conexion->connect_error);
        }
        
        // Prevenir inyección SQL
        $documento = $conexion->real_escape_string($documento);
        
        // Consulta SQL para buscar el documento en la base de datos
        $consulta = "SELECT * FROM Persona WHERE numeroIdentificacion = '$documento'";
        $resultado = $conexion->query($consulta);
        
        if ($resultado->num_rows > 0) {
            echo "<p>Documento válido. ¡Bienvenido!</p>";
        } else {
            echo "<p>Documento no encontrado en el sistema.</p>";
        }
        
        // Cerrar la conexión a la base de datos
        $conexion->close();
    }

    echo "<button onclick='window.history.go(-1); return false;' class='volver-btn'>Volver</button>";

}
?>
