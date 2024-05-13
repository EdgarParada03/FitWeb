<?php
include("conexion.php"); // Incluye tu archivo de conexión

$consulta = "SELECT p.video, p.plan_alimentacion
             FROM Personalizados p
             INNER JOIN diagnosticoimc d ON p.documento = d.documento
             WHERE d.imc > 25";

$resultado = mysqli_query($conn, $consulta);

// Muestra los resultados en una tabla HTML
echo "<table>";
echo "<tr><th>Video</th><th>Plan Alimentación</th></tr>";

while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    echo "<td>" . $fila['video'] . "</td>";
    echo "<td>" . $fila['plan_alimentacion'] . "</td>";
    echo "</tr>";
}

echo "</table>";

mysqli_close($conn);
?>
