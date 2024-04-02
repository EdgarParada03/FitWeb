<?php
// Incluir el script de conexión a la base de datos
include("conexion.php");

// Verificar si se envió el formulario de login
if (isset($_POST['login'])) {
    // Recoger los datos del formulario
    $numero_identificacion = $_POST['numero_identificacion'] ?? null;
    $contrasena = $_POST['contrasena'] ?? null;
    $rol = $_POST['rol'] ?? null; // Recoger el rol seleccionado

    if (empty($numero_identificacion) || empty($contrasena) || empty($rol)) {
        echo "<script>alert('Número de identificación, contraseña y rol son requeridos.');</script>";
        echo "<script>window.location.href='/Modulo-No-Miembros/Login-Register/index.php';</script>";
    } else {
        // Preparar la consulta para evitar inyecciones SQL
        $consulta = $conexion->prepare("SELECT id FROM Persona WHERE numeroIdentificacion = ? AND contraseña = ?");
        $consulta->bind_param("ss", $numero_identificacion, $contrasena);
        $consulta->execute();
        $resultado = $consulta->get_result();

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            $usuario_id = $usuario['id'];

            // Definir la consulta basada en el rol
            if ($rol == 'entrenador') {
                $consulta_rol = $conexion->prepare("SELECT * FROM Entrenador WHERE persona_id = ?");
                $redirect_url = '/Modulo-Entrenador/entrenador.html'; // URL para entrenadores
            } elseif ($rol == 'miembro') {
                $consulta_rol = $conexion->prepare("SELECT * FROM Miembro WHERE persona_id = ?");
                $redirect_url = '/Modulo-Miembros/clientes.html'; // URL para miembros
            } else {
                // Rol no reconocido
                echo "<script>alert('Rol no reconocido.');</script>";
                echo "<script>window.location.href='/Modulo-No-Miembros/Login-Register/index.php';</script>";
                exit;
            }

            // Ejecutar la consulta del rol
            $consulta_rol->bind_param("i", $usuario_id);
            $consulta_rol->execute();
            $resultado_rol = $consulta_rol->get_result();

            if ($resultado_rol->num_rows > 0) {
                // El usuario tiene el rol seleccionado
                echo "<script>alert('Inicio de sesión exitoso. Bienvenido.');</script>";
                echo "<script>window.location.href='".$redirect_url."';</script>";
            } else {
                // No se encontró al usuario con el rol seleccionado
                echo "<script>alert('No se encontró al usuario con el rol seleccionado o contraseña incorrectos.');</script>";
                echo "<script>window.location.href='/Modulo-No-Miembros/Login-Register/index.php';</script>";
            }

            // Cerrar las consultas
            $consulta->close();
            $consulta_rol->close();
        } else {
            // El usuario no existe o la contraseña es incorrecta
            echo "<script>alert('Número de identificación o contraseña incorrectos.');</script>";
            echo "<script>window.location.href='/Modulo-No-Miembros/Login-Register/index.php';</script>";
        }
    }
}
?>
