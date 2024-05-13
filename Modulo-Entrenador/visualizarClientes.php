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
            <th>nombre</th>
            <th>edad</th>
            <th>telefono</th>
            <th>Numero Identificacion</th>
            
            
        </tr>
        <?php
        // Incluir el archivo de conexión
        include 'conexion.php';

        // Consulta SQL para obtener los datos de la tabla entrenadores
        $sql = "SELECT nombreCompleto, edad, telefono, numeroIdentificacion  from Persona Where rol = 'miembro';";
        $result = $conn->query($sql);

        // Comprobar si hay resultados
        if ($result->num_rows > 0) {
            // Iterar sobre los resultados y mostrar cada fila
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nombreCompleto"] . "</td>";
                echo "<td>" . $row["edad"] . "</td>";
                echo "<td>" . $row["telefono"] . "</td>";
                echo "<td>" . $row["numeroIdentificacion"] . "</td>";
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