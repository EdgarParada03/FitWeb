<?php
    // Comprobar si se ha hecho clic en el botón de descarga
    if (isset($_POST['descargar'])) {
        // Nombre del archivo a descargar
        $archivo = 'Lista_Cliente.txt';

        // Comprobar si el archivo existe
        if (file_exists($archivo)) {
            // Configurar los encabezados para la descarga
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($archivo).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($archivo));

            // Limpiar el búfer de salida y leer el archivo para la descarga
            ob_clean();
            flush();
            readfile($archivo);

            // Terminar el script
            exit;
        } else {
            echo "El archivo no existe.";
        }
    }
?>