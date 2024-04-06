<?php
// Archivo: mostrar_rutinas.php

// Incluye el archivo de conexión a la base de datos
include("conexion.php");

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
        echo "<td><iframe width=\"560\" height=\"315\" src=\"" . $fila['video'] . "\" frameborder=\"0\" allowfullscreen></iframe></td>";
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
