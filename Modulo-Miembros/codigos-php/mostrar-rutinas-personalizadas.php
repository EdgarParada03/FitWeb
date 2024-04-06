<?php
    // Incluye el archivo de conexión a la base de datos
include("conexion.php");

// Consulta para obtener los valores específicos de la tabla "Rutinas"
$sql = "SELECT video, plan_alimentacion FROM personalizados";

// Ejecuta la consulta
$resultado = mysqli_query($conn, $sql);

// Verifica si hay resultados
if (mysqli_num_rows($resultado) > 0) {

    echo "<table>";
    echo "<tr>";
    echo "<th>Video</th>";
    echo "<th>Plan de alimentacion</th>";
    echo "</tr>";

    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td><iframe width=\"560\" height=\"315\" src=\"" . $fila['video'] . "\" frameborder=\"0\" allowfullscreen></iframe></td>";
        echo "<td>" . $fila['plan_alimentacion'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</body>";
    echo "</html>";

}else {
    echo "No se encontraron registros.";
}

// Cierra la conexión a la base de datos
mysqli_close($conn);
?>
