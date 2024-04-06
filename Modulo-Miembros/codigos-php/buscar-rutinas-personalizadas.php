<?php
include("conexion.php"); // Incluye tu archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $documento = $_POST["documento"];

    $consulta = "SELECT video, plan_alimentacion
                 FROM Personalizados
                 WHERE documento = '$documento'";

    $resultado = mysqli_query($conn, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>PERSONALIZADOS</title>
            <link rel='stylesheet' href='style-clientes.css'>
            <style>
                /* Estilos adicionales */
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                    background-image: url('https://image.freepik.com/foto-gratis/resumen-desenfoque-y-gimnasio-de-fitness-defocused-para-el-fondo_1339-24814.jpg');
                    /* Ruta de la imagen de fondo */
                    background-size: cover;
                    background-repeat: no-repeat;
                }
                
                header {
                    background-color: #333;
                    padding: 20px;
                    color: #fff;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }
                
                .botones-container {
                    text-align: center;
                    margin-top: 50px;
                }
                
                .zoom-shadow {
                    margin: 10px;
                    display: inline-block;
                    position: relative;
                    overflow: hidden;
                    border: none;
                    border-radius: 30px;
                }
                
                .zoom-shadow img {
                    transition: transform 0.3s ease;
                    width: 300px;
                    height: auto;
                }
                
                .zoom-shadow::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    opacity: 50;
                    transition: opacity 0.3s ease;
                }
                
                .zoom-shadow:hover img {
                    transform: scale(1.1);
                }
                
                .zoom-shadow:hover::before {
                    opacity: 1;
                }
                
                .contact-info p {
                    margin: 5px 0;
                }
                
                .pie {
                    background-color: #333;
                    color: #fff;
                    padding: 20px;
                    text-align: center;
                }
                
                .fondo {
                    background-image: url('images/Captura\ de\ pantalla\ 2024-03-26\ 191829.png');
                }
                
                .logo-container {
                    display: flex;
                    align-items: center;
                }
                
                .logo {
                    max-width: 150px;
                    height: auto;
                }
                /* Agrega más estilos según tus necesidades */
            </style>
            </head>
            <body>
                <header>
                    <div>
                        <img class='logo' src='https://static.vecteezy.com/system/resources/previews/018/795/372/original/fitness-and-gym-logo-free-png.png' alt='Logo de la empresa'>
                    </div>
                    <h1 class='title'>ENTRENAMIENTOS PERSONALIZADOS</h1>
                </header>
                <div class='resultados-section'>
                    <h3>Resultados:</h3>";

        echo "<table>";
        echo "<tr><th>Video</th><th>Plan Alimentación</th></tr>";

        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td><iframe width=\"560\" height=\"315\" src=\"". $fila['video'] . "\" frameborder=\"0\" allowfullscreen></iframe></td>";
            echo "<td>" . $fila['plan_alimentacion'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron rutinas personalizadas para este número de documento.";
    }
} else {
    // Muestra el formulario si no se ha enviado el número de documento
    echo '<form action="codigos-php/buscar-rutinas-personalizadas.php" method="post">';
    echo '<label for="documento">Ingresa tu número de documento:</label>';
    echo '<input type="text" id="documento" name="documento">';
    echo '<input type="submit" value="Buscar">';
    echo '</form>';
}
