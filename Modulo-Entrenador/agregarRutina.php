<?php
include 'conexion.php';


function convertir_a_iframe_embebido($url) {
    // Reemplaza la URL base con la URL de YouTube
    $url_base = 'https://www.youtube.com/watch?v=';
    $video_id = substr($url, strlen($url_base));
 
    // Genera el código del iframe embebido
    $iframe_code = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen></iframe>';
 
    return $iframe_code;
}



// Recibir datos del formulario
$nombre = $_POST['nombre'];
$zonaMuscular = $_POST['zonaMuscular'];
$ejercicios = $_POST['ejercicios'];
$series = $_POST['series'];
$descripcion = $_POST['descripcion'];
$video = convertir_a_iframe_embebido($_POST['video']);

// Insertar datos en la tabla
$sql = "INSERT INTO Rutinas (nombre, zona_muscular, ejercicios, series, descripcion, video) VALUES ('$nombre', '$zonaMuscular ', '$ejercicios', '$series ', '$descripcion', '$video')";

if ($conn->query($sql) === TRUE) {
    echo "Registro guardado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
