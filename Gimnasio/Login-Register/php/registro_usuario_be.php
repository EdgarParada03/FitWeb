<?php

include 'conexion_be.php';

$nombre_completo = $_POST['nombre_completo'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$query = "INSERT INTO usuarios(nombre_completo,correo,usuario,contrasena) 
         VALUES ('$nombre_completo','$correo','$usuario','$contrasena')"; 


//Validar correos repetidos
    $verificar_correo = mysqli_query($conexion,"SELECT * FROM usuarios where correo = '$correo'");

    if(mysqli_num_rows($verificar_correo) > 0){
        echo '
            <script>
                alert("El correo ya esta registrado, intenta con otro diferente.");
                window.location = "../index.php";
            </script>
        ';
    exit();
    }

//Validar usuarios repetidos
    $verificar_usuario = mysqli_query($conexion,"SELECT * FROM usuarios where usuario = '$usuario'");

    if(mysqli_num_rows($verificar_usuario) > 0){
        echo '
            <script>
                alert("El usuario ya esta registrado, intenta con otro diferente.");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

    $ejecutar = mysqli_query($conexion,$query);

if($ejecutar){
    echo '
        <script>
        alert("usuario almacenado exitosamente!");
        window.location= "../index.php";
        </script>
    ';
}else{
    echo '
        <script>
            alert("Intentalo de nuevo usuario no almacenado!");
            window.location= "../index.php";
        </script>
    ';
}

mysqli_close($conexion);
?>