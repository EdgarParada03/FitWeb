<!-- MODIFICAR -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .busqueda-nombre {
            width: 400px;
        }

        .boton-buscar-cliente {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <input class="busqueda-nombre" type="text" name="nombreBuscado" placeholder="Escribe el nombre del cliente">
        <button class="boton-buscar-cliente" type="submit">Buscar cliente</button>
    </form>

    <?php
    // Conexión a la base de datos (asegúrate de que el archivo de conexión esté incluido)
    include 'conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener el nombre buscado desde el formulario
        $nombreBuscado = $_POST['nombreBuscado'];

        // Verificar si el campo de búsqueda está vacío
        if (empty($nombreBuscado)) {
            echo "<script>alert('Tienes que ingresar un nombre para buscar');</script>";
        } else {
            // Consulta SQL para buscar el nombre en la base de datos
            $sql = "SELECT * FROM persona WHERE nombreCompleto LIKE '%$nombreBuscado%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Crear una variable para almacenar los resultados
                $resultados = '';

                // Construir los resultados (puedes adaptar esto según tus necesidades)
                while ($row = $result->fetch_assoc()) {
                    $resultados .=  " Nombre completo: " . $row['nombreCompleto'] . "\n" .
                        "Numero identificacion: " . $row['numeroIdentificacion'] . "\n" .
                        " Fecha de nacimiento: " . $row['fechaNacimiento'] . "\n" .
                        " Correo electronico: " . $row['correo'] . "\n" .
                        " Telefono: " . $row['telefono'] . "\n" .
                        " Sexo: " . $row['sexo'] . "\n" . "\n";
                }

                // Mostrar los resultados en el div
                echo '<div class="container-mostrar">' . nl2br($resultados) . '</div>';

                // Crear un botón para descargar el archivo de texto
                echo '<form method="post" action="descargar.php">';
                echo '<button type="submit" name="descargar">Descargar TXT</button>';
                echo '</form>';

                // Guardar los resultados en un archivo de texto
                file_put_contents('Lista_Cliente.txt', $resultados);
            } else {
                echo "No se encontraron resultados.";
            }
        }
    }
    $conn->close();
    ?>
</body>
