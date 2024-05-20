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

        /* Estilos para el formulario de búsqueda */
        .search-form {
            margin-bottom: 20px;
        }

        .search-form label {
            margin-right: 10px;
            font-weight: bold;
        }

        .search-form input[type="text"] {
            margin-right: 20px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .search-form button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-form button:hover {
            background-color: #45a049;
        }

        .search-form div {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h2>Buscar Clases</h2>
    <form class="search-form" method="GET" action="">
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre">
        </div>
        <div>
            <label for="sitio">Sitio:</label>
            <input type="text" id="sitio" name="sitio">
        </div>
        <div>
            <label for="tipoClase">Tipo:</label>
            <input type="text" id="tipoClase" name="tipoClase">
        </div>
        <div>
            <label for="instructor">Instructor:</label>
            <input type="text" id="instructor" name="instructor">
        </div>
        <button type="submit">Buscar</button>
    </form>

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

        // Inicializar la consulta SQL
        $sql = "SELECT * FROM clase WHERE 1=1";

        // Verificar y agregar filtros
        if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
            $nombre = $conn->real_escape_string($_GET['nombre']);
            $sql .= " AND nombre LIKE '%$nombre%'";
        }

        if (isset($_GET['sitio']) && !empty($_GET['sitio'])) {
            $sitio = $conn->real_escape_string($_GET['sitio']);
            $sql .= " AND sitio LIKE '%$sitio%'";
        }

        if (isset($_GET['tipoClase']) && !empty($_GET['tipoClase'])) {
            $tipoClase = $conn->real_escape_string($_GET['tipoClase']);
            $sql .= " AND tipoClase LIKE '%$tipoClase%'";
        }

        if (isset($_GET['instructor']) && !empty($_GET['instructor'])) {
            $instructor = $conn->real_escape_string($_GET['instructor']);
            $sql .= " AND instructor LIKE '%$instructor%'";
        }

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
            echo "<tr><td colspan='7'>No se encontraron Clases.</td></tr>";
        }
        // Cerrar conexión
        $conn->close();
        ?>
    </table>
</body>

</html>
