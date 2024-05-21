<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título de tu página</title>
    <link rel="stylesheet" href="stylesss.css"> <!-- Vincula tu archivo CSS externo -->
</head>
<body>

<?php
require_once 'conexion.php';



// Recibir datos del formulario
$nombre_completo = isset($_POST['nombre_completo']) ? $_POST['nombre_completo'] : null;
$numero_identificacion = isset($_POST['numero_identificacion']) ? $_POST['numero_identificacion'] : null;
$fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : null;
$correo = isset($_POST['correo']) ? $_POST['correo'] : null;
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
$sexo = isset($_POST['sexo']) ? $_POST['sexo'] : null;
$contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : null;
$rol = isset($_POST['rol']) ? $_POST['rol'] : null;

if (
    empty($nombre_completo) || empty($numero_identificacion) || empty($fecha_nacimiento) ||
    empty($correo) || empty($telefono) || empty($sexo) || empty($contrasena) || empty($rol)
) {
    echo "<script>alert('Todos los campos deben estar llenos.');</script>";
} else {
    $consulta_existencia = "SELECT * FROM persona WHERE numeroIdentificacion = '$numero_identificacion'";
    $resultado_existencia = mysqli_query($conexion, $consulta_existencia);

    if (mysqli_num_rows($resultado_existencia) > 0) {
    } else {
        $consulta = "INSERT INTO persona(nombreCompleto, numeroIdentificacion, fechaNacimiento, correo, telefono, sexo, contraseña, rol) VALUES ('$nombre_completo', '$numero_identificacion', '$fecha_nacimiento', '$correo', '$telefono', '$sexo', '$contrasena', '$rol')";
        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado) {
            echo "<script>alert('Usuario creado correctamente');</script>";

            $id_persona = mysqli_insert_id($conexion);
            $consulta_idMiembro = "SELECT id FROM Miembro WHERE persona_id = '$id_persona'";
            $resultado_idMiembro = mysqli_query($conexion, $consulta_idMiembro);
            $consulta_idEntrenador = "SELECT id FROM Entrenador WHERE persona_id = '$id_persona'";
            $resultado_idEntrenador = mysqli_query($conexion, $consulta_idEntrenador);
            // Obtiene el ID del miembro si existe
            if ($resultado_idMiembro && mysqli_num_rows($resultado_idMiembro) > 0) {
                $row = mysqli_fetch_assoc($resultado_idMiembro);
                $id_miembro = $row['id'];
            } else {
                echo "<script>alert('No se encontró ningún miembro con esa ID');</script>";
            }

            // Obtiene el ID del entrenador si existe
            if ($resultado_idEntrenador && mysqli_num_rows($resultado_idEntrenador) > 0) {
                $row = mysqli_fetch_assoc($resultado_idEntrenador);
                $id_entrenador = $row['id'];
            } else {
                echo "<script>alert('No se encontró ningún entrenador con esa ID');</script>";
            }


            if ($resultado_idMiembro) {
                

                // Si el rol es 'miembro', se ejecutan las operaciones de membresías
                if ($rol == 'miembro') {
                    // Operaciones de membresías
                    // Recibe los valores del formulario de membresías
                    $fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : null;
                    $plan = isset($_POST['plan']) ? $_POST['plan'] : null;
                    $fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;
                    $tarjeta = isset($_POST['tarjeta']) ? $_POST['tarjeta'] : null;

                    // Crea la consulta SQL para insertar los datos en la tabla 'MembresiaPagar'
                    $sql = "INSERT INTO membresiapagar (id_miembro, fecha_inicio, plan, fecha_fin, tarjeta) 
                            VALUES ('$id_miembro', '$fecha_inicio', '$plan', '$fecha_fin', '$tarjeta')";

                    // Ejecuta la consulta
                    if (mysqli_query($conexion, $sql)) {
                        echo "<script>alert('Membresía registrada correctamente.');</script>";
                    } else {
                        echo "<script>alert('Error al registrar la membresía.');</script>";
                    }
                }
            } else {
            }

            if ($resultado_idEntrenador) {
                

                // Si el rol es 'miembro', se ejecutan las operaciones de membresías
                if ($rol == 'entrenador') {
                    // Operaciones de membresías
                    // Recibe los valores del formulario de membresías
                    $especialidad = $_POST['especialidad'];

                    echo "<script>alert('$id_entrenador');</script>";
                    // Crea la consulta SQL para insertar los datos en la tabla 'MembresiaPagar'
                    $sql = "UPDATE Entrenador SET especialidad= '$especialidad' WHERE Entrenador.id= '$id_entrenador' ";

                    // Ejecuta la consulta
                    if (mysqli_query($conexion, $sql)) {
                        echo "<script>alert('Entrenador registrado correctamente.');</script>";
                    } else {
                        echo "<script>alert('Error al registrar entrenador.');</script>";
                    }
                }
            } else {
                echo "<script>alert('Ha ocurrido un error al obtener el ID del miembro.');</script>";
            }
        } else {
            echo "<script>alert('Ha ocurrido un error al crear el usuario.');</script>";
        }
    }
    echo "<button onclick='window.history.go(-1); return false;' class='volver-btn'>Volver</button>";

}

// Cerrar la conexión
mysqli_close($conexion);
