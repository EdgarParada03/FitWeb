<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .boton-buscar-producto {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <button class="boton-buscar-producto" type="submit">Buscar productos</button>
    </form>

    <?php
    // Conexión a la base de datos (asegúrate de que el archivo de conexión esté incluido)
    include 'conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Consulta SQL para buscar el nombre en la base de datos
        $sql = "SELECT * FROM `productos` WHERE 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Crear una variable para almacenar los resultados
            $resultados = '';

            // Construir los resultados (puedes adaptar esto según tus necesidades)
            while ($row = $result->fetch_assoc()) {
                $resultados .=  "-----------------------------------------" . "<br>" .
                    "Nombre: " . $row['nombre'] . "<br>" .
                    "Precio: " . $row['precio'] . "<br>" .
                    " Imagen: " . $row['imagen'] . "<br>" .
                    " Descripción: " . $row['descripcion'] . "<br>" .
                    " Cantidad: " . $row['cantidad'] . "<br>" .
                    "-----------------------------------------" . "";
            }

            // Mostrar los resultados en el div
            echo '<div class="container-mostrar">' . nl2br($resultados) . '</div>';

            // Crear un botón para descargar el archivo de texto
            echo '<button onclick="descargar(\'Lista_Productos.txt\', \'' . str_replace("\n", "\\n", str_replace("'", "\'", $resultados)) . '\')">Descargar TXT</button>';
        } else {
            echo "No se encontraron resultados.";
        }
    }
    $conn->close();
    ?>

    <script>
        function descargar(filename, text) {
            var element = document.createElement('a');
            element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
            element.setAttribute('download', filename);
            element.style.display = 'none';
            document.body.appendChild(element);
            element.click();
            document.body.removeChild(element);
        }
    </script>
</body>
