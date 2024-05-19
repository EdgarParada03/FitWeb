<!-- MODIFICAR -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .busqueda-nombre{
            width: 400px;
        }

        .boton-buscar-cliente{
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

            // Consulta SQL para buscar el nombre en la base de datos
            $sql = "SELECT * FROM persona WHERE nombreCompleto LIKE '%$nombreBuscado%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Crear una variable para almacenar los resultados
                $resultados = '';

                // Construir los resultados (puedes adaptar esto según tus necesidades)
                while ($row = $result->fetch_assoc()) {
                    $resultados .=  " Nombre completo: " . $row['nombreCompleto'] ."<br>" .
                     "Numero identificacion: " . $row['numeroIdentificacion'] ."<br>" .
                     " Fecha de nacimiento: " . $row['fechaNacimiento'] ."<br>" . 
                     " Correo electronico: " . $row['correo'] ."<br>" . 
                     " Telefono: " . $row['telefono'] ."<br>" . 
                     " Sexo: " . $row['sexo'] ."<br>" . "";
                }

                // Mostrar los resultados en el div
                echo '<div class="container-mostrar">' . $resultados . '</div>';
            } else {
                echo "No se encontraron resultados.";
            }
        }
        $conn->close();
        ?>

</body>