<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Usuarios</title>
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

        .search-form input[type="text"],
        .search-form select {
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
    <h2>Buscar Usuarios</h2>
    <form class="search-form" method="GET" action="">
        <div>
            <label for="nombre_completo">Nombre Completo:</label>
            <input type="text" id="nombre_completo" name="nombre_completo">
        </div>
        <div>
            <label for="numero_identificacion">Identificación:</label>
            <input type="text" id="numero_identificacion" name="numero_identificacion">
        </div>
        <div>
            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo">
                <option value="">Seleccione</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>
        </div>
        <div>
            <label for="rol">Rol:</label>
            <select id="rol" name="rol">
                <option value="">Seleccione</option>
                <option value="Administrador">Administrador</option>
                <option value="Miembro">Miembro</option>
                <option value="Entrenador">Entrenador</option>
                <option value="Gerente">Gerente</option>
            </select>
        </div>
        <button type="submit">Buscar</button>
    </form>

    <table class="table">
        <tr>
            <th>id</th>
            <th>Nombre Completo</th>
            <th>Identificación</th>
            <th>Correo</th>
            <th>Sexo</th>
            <th>Rol</th>
        </tr>
        <?php
        // Incluir el archivo de conexión
        include 'conexion.php';

        // Verificar si la conexión fue exitosa
        if (!$conexion) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        // Inicializar la consulta SQL
        $sql = "SELECT id, nombreCompleto, numeroIdentificacion, correo, sexo, rol FROM Persona WHERE 1=1";

        // Verificar y agregar filtros
        if (isset($_GET['nombre_completo']) && !empty($_GET['nombre_completo'])) {
            $nombre = $conexion->real_escape_string($_GET['nombre_completo']);
            $sql .= " AND nombreCompleto LIKE '%$nombre%'";
        }

        if (isset($_GET['numero_identificacion']) && !empty($_GET['numero_identificacion'])) {
            $identificacion = $conexion->real_escape_string($_GET['numero_identificacion']);
            $sql .= " AND numeroIdentificacion LIKE '%$identificacion%'";
        }

        if (isset($_GET['sexo']) && !empty($_GET['sexo'])) {
            $sexo = $conexion->real_escape_string($_GET['sexo']);
            $sql .= " AND sexo = '$sexo'";
        }

        if (isset($_GET['rol']) && !empty($_GET['rol'])) {
            $rol = $conexion->real_escape_string($_GET['rol']);
            $sql .= " AND rol = '$rol'";
        }

        $result = $conexion->query($sql);

        // Comprobar si hay resultados
        if ($result->num_rows > 0) {
            // Iterar sobre los resultados y mostrar cada fila
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nombreCompleto"] . "</td>";
                echo "<td>" . $row["numeroIdentificacion"] . "</td>";
                echo "<td>" . $row["correo"] . "</td>";
                echo "<td>" . $row["sexo"] . "</td>";
                echo "<td>" . $row["rol"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No se encontraron usuarios.</td></tr>";
        }
        // Cerrar conexión
        $conexion->close();
        ?>
    </table>
</body>

</html>
