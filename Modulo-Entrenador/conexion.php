<?php

$servername = "localhost"; // Nombre del servidor de la base de datos (en este caso, localhost)
$username = "root"; // Nombre de usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$database = "Fitweb"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
