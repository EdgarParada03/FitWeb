<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de clases</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-family: Arial, sans-serif;
            
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        
    </style>
</head>

<body>

    <table class="table">
        <tr>
            <th>id</th>
            <th>nombre</th>
            <th>sitio</th>
            <th>duracion</th>
            <th>tipo</th>
            <th>fecha</th>
            <th>instructor</th>
            
        </tr>
        <?php
        // Incluir el archivo de conexión
        include 'conexion.php';

        // Consulta SQL para obtener los datos de la tabla entrenadores
        $sql = "SELECT * FROM clase";
        $result = $conn->query($sql);

        // Comprobar si hay resultados
        if ($result->num_rows > 0) {
            // Iterar sobre los resultados y mostrar cada fila
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["sitio"] . "</td>";
                echo "<td>" . $row["duracion"] . "</td>";
                echo "<td>" . $row["tipoClase"] . "</td>";
                echo "<td>" . $row["fecha"] . "</td>";
                echo "<td>" . $row["instructor"] . "</td>";
                echo "</tr>";
            
            }
        } else {
            echo "<tr><td colspan='3'>No se encontraron Clases.</td></tr>";
        }
        // Cerrar conexión
        $conn->close();
        ?>

    </table>
    <script src="script.js"></script>
</body>

</html>