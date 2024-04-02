<?php

include("conexion.php");

if (isset($_POST['registrar'])) {

    $nombre_completo = isset($_POST['nombre_completo']) ? $_POST['nombre_completo'] : null;
    $numero_identificacion = isset($_POST['numero_identificacion']) ? $_POST['numero_identificacion'] : null;
    $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : null;
    $correo = isset($_POST['correo']) ? $_POST['correo'] : null;
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
    $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : null;
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : null;

    if (empty($nombre_completo) || empty($numero_identificacion) || empty($fecha_nacimiento) || 
        empty($correo) || empty($telefono) || empty($sexo) || empty($contrasena)) {
        echo "<script>alert('Todos los campos deben estar llenos.');</script>";
        echo "<script>window.location.href='/Modulo-No-Miembros/Login-Register/index.php';</script>";
    } else {
        
        $consulta_existencia = "SELECT * FROM persona WHERE numeroIdentificacion = '$numero_identificacion'";
        $resultado_existencia = mysqli_query($conexion, $consulta_existencia);
        
        if(mysqli_num_rows($resultado_existencia) > 0) {
            echo "<script>alert('Usuario con la cédula $numero_identificacion ya existe.');</script>";
            echo "<script>window.location.href='/Modulo-No-Miembros/Login-Register/index.php';</script>";
        } else {
            
            $consulta = "INSERT INTO persona(nombreCompleto, numeroIdentificacion, fechaNacimiento, correo, telefono, sexo, contraseña) VALUES ('$nombre_completo', '$numero_identificacion', '$fecha_nacimiento', '$correo', '$telefono', '$sexo', '$contrasena')";
            $resultado = mysqli_query($conexion, $consulta);
            
            if ($resultado) {
                echo "<script>alert('Usuario creado correctamente');</script>";
                echo "<script>window.location.href='/Modulo-Miembros/clientes-membresias.html';</script>";
            } else {
                echo "<script>alert('Ha ocurrido un error!!');</script>";
                echo "<script>window.location.href='/Modulo-No-Miembros/Login-Register/index.php';</script>";
            }
        }
    }
}
?>
