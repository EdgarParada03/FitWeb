<?php
include("conexion.php");

if (isset($_POST['login'])) {
    $numero_identificacion = $_POST['numero_identificacion'] ?? null;
    $contrasena = $_POST['contrasena'] ?? null;
    $rol = $_POST['rol'] ?? null;

    if (empty($numero_identificacion) || empty($contrasena) || empty($rol)) {
        echo "<script>alert('Número de identificación, contraseña y rol son requeridos.');</script>";
        echo "<script>window.location.href='/Modulo-No-Miembros/Login-Register/index.php';</script>";
    } else {
        $consulta = $conexion->prepare("SELECT id, nombreCompleto FROM Persona WHERE numeroIdentificacion = ? AND contraseña = ?");
        $consulta->bind_param("ss", $numero_identificacion, $contrasena);
        $consulta->execute();
        $resultado = $consulta->get_result();

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            $usuario_id = $usuario['id'];
            $nombreCompleto = $usuario['nombreCompleto'];

            if ($rol == 'entrenador') {
                $consulta_rol = $conexion->prepare("SELECT * FROM Entrenador WHERE persona_id = ?");
                $redirect_url = '/Modulo-Entrenador/entrenador.html';
            } elseif ($rol == 'miembro') {
                $consulta_rol = $conexion->prepare("SELECT * FROM Miembro WHERE persona_id = ?");
                $redirect_url = '/Modulo-Miembros/clientes.html';
            } elseif ($rol == 'gerente') {
                $consulta_rol = $conexion->prepare("SELECT * FROM Gerente WHERE persona_id = ?");
                $redirect_url = '/Modulo-Gerente/gerente.html';
            }else {
                echo "<script>alert('Rol no reconocido.');</script>";
                echo "<script>window.location.href='/Modulo-No-Miembros/Login-Register/index.php';</script>";
                exit;
            }

            $consulta_rol->bind_param("i", $usuario_id);
            $consulta_rol->execute();
            $resultado_rol = $consulta_rol->get_result();

            if ($resultado_rol->num_rows > 0) {
                echo "<script>alert('Inicio de sesión exitoso. Bienvenido.');</script>";
                echo "<script>window.location.href='".$redirect_url."?nombre=".$nombreCompleto."&numero_identificacion=".$numero_identificacion."';</script>";
            } else {
                echo "<script>alert('No se encontró al usuario con el rol seleccionado o contraseña incorrectos.');</script>";
                echo "<script>window.location.href='/Modulo-No-Miembros/Login-Register/index.php';</script>";
            }

            $consulta->close();
            $consulta_rol->close();
        } else {
            echo "<script>alert('Número de identificación o contraseña incorrectos.');</script>";
            echo "<script>window.location.href='/Modulo-No-Miembros/Login-Register/index.php';</script>";
        }
    }
}
?>
