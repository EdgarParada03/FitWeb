<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de clientes</title>
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
            <th>documento</th>
            <th>imc</th>
            <th>estado</th>
            
            
        </tr>
        <?php
        // Incluir el archivo de conexión
        include 'conexion.php';

        // Consulta SQL para obtener los datos de la tabla entrenadores
        $sql = "SELECT *  from diagnosticoimc Where imc > 25;";
        $result = $conn->query($sql);

        // Comprobar si hay resultados
        if ($result->num_rows > 0) {
            // Iterar sobre los resultados y mostrar cada fila
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["documento"] . "</td>";
                echo "<td>" . $row["imc"] . "</td>";
                echo "<td>" . $row["estado"] . "</td>";
                echo "</tr>";
            
            }
        } else {
            echo "<tr><td colspan='3'>No se encontraron Rutinas.</td></tr>";
        }
        // Cerrar conexión
        $conn->close();
        ?>

    </table>
    <script src="script.js"></script>
</body>

</html>