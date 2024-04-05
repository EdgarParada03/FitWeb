<?php
// Archivo: buscar.php

// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

// Recibe el número de identificación por GET
$numeroIdentificacion = $_GET['numeroIdentificacion'];

// Consulta SQL para buscar la información del usuario
$sql = "SELECT fecha_inicio, fecha_fin, plan FROM membresiapagar WHERE numeroIdentificacion = '$numeroIdentificacion'";

$result = mysqli_query($conn, $sql);

if ($result) {
    // Obtiene el primer registro (suponiendo que solo hay uno)
    $row = mysqli_fetch_assoc($result);

    // Muestra los resultados en una tabla con estilos CSS
    echo "<!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>MEMBRESIAS</title>
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
                    <h1 class='title'>SECCION DE MEMBRESIAS</h1>
                </header>
                <div class='resultados-section'>
                    <h3>Resultados:</h3>
                    <table>
                        <tr>
                            <th>Fecha de inicio</th>
                            <th>Fecha de fin</th>
                            <th>Plan</th>
                        </tr>
                        <tr>
                            <td>{$row['fecha_inicio']}</td>
                            <td>{$row['fecha_fin']}</td>
                            <td>{$row['plan']}</td>
                        </tr>
                    </table>
                </div>
                <!-- Agrega más elementos HTML según tus necesidades -->
            </body>
            </html>";
} else{
    echo "Error al buscar la información: " . mysqli_error($conn);
}

// Cierra la conexión a la base de datos
mysqli_close($conn);
?>
