<?php
// Archivo: mostrar_rutinas.php

// Incluye el archivo de conexión a la base de datos
include("conexion.php");

function convertir_a_iframe_embebido($url) {
    // Reemplaza la URL base con la URL de YouTube
    $url_base = 'https://www.youtube.com/watch?v=';
    $video_id = substr($url, strlen($url_base));

    // Genera el código del iframe embebido
    $iframe_code = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen></iframe>';

    return $iframe_code;
}

// Consulta para obtener los valores específicos de la tabla "Rutinas"
$sql = "SELECT nombre, zona_muscular, ejercicios, series, descripcion, video FROM Rutinas";

// Ejecuta la consulta
$resultado = mysqli_query($conn, $sql);

// Verifica si hay resultados
if (mysqli_num_rows($resultado) > 0) {

    echo "<table>";
    echo "<tr>";
    echo "<th>Nombre</th>";
    echo "<th>Zona Muscular</th>";
    echo "<th>Ejercicios</th>";
    echo "<th>Series</th>";
    echo "<th>Descripción</th>";
    echo "<th>Video</th>";
    echo "</tr>";

    // Muestra los valores en la tabla
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . $fila['nombre'] . "</td>";
        echo "<td>" . $fila['zona_muscular'] . "</td>";
        echo "<td>" . $fila['ejercicios'] . "</td>";
        echo "<td>" . $fila['series'] . "</td>";
        echo "<td>" . $fila['descripcion'] . "</td>";
        echo "<td>" . convertir_a_iframe_embebido($fila['video']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</body>";
    echo "</html>";
} else {
    echo "No se encontraron rutinas :( ";
}

// Cierra la conexión a la base de datos
mysqli_close($conn);
?>
