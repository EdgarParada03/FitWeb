<?php
// Redirección temporal a clientes.html
$nuevaURL = 'clientes.html';
header('Location: ' . $nuevaURL);
exit; // Asegúrate de salir del script después de la redirección
?>