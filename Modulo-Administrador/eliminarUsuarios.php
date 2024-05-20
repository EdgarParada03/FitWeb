<?php
// Incluir archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se recibió el ID del registro a eliminar
if (isset($_GET['id_eliminar'])) {
    // Obtener el ID del registro a eliminar
    $id_eliminar = $_GET['id_eliminar'];

    // Consultar el rol de la persona antes de eliminarla
    $sql_persona = "SELECT * FROM Persona WHERE id = $id_eliminar";
    $result_persona = $conexion->query($sql_persona);
    if ($result_persona->num_rows > 0) {
        // Obtener el rol de la persona
        $row_persona = $result_persona->fetch_assoc();
        $rol_persona = $row_persona['rol'];

        // Eliminar el registro de la tabla de roles si el rol no es de administrador
        if ($rol_persona == 'administrador') {
            $sql_roles = "DELETE FROM Administrador WHERE persona_id = $id_eliminar";
            if ($conexion->query($sql_roles) === TRUE) {
                echo "administrador eliminados exitosamente.";
            } else {
                echo "Error al eliminar los registros de roles: " . $conexion->error;
            }
        } elseif ($rol_persona == 'gerente') {
            $sql_roles = "DELETE FROM Gerente WHERE persona_id = $id_eliminar";
            if ($conexion->query($sql_roles) === TRUE) {
                echo "gerente eliminados exitosamente.";
            } else {
                echo "Error al eliminar los registros de roles: " . $conexion->error;
            }
        } elseif ($rol_persona == 'entrenador') {
            $sql_roles = "DELETE FROM Entrenador WHERE persona_id = $id_eliminar";
            if ($conexion->query($sql_roles) === TRUE) {
                echo "entrenador eliminados exitosamente.";
            } else {
                echo "Error al eliminar los registros de roles: " . $conexion->error;
            }
        } elseif ($rol_persona == 'miembro') {
            // Consultar el ID de miembro antes de eliminarlo
            $sql_miembro = "SELECT * FROM Miembro WHERE persona_id = $id_eliminar";
            $result_miembro = $conexion->query($sql_miembro);
            if ($result_miembro->num_rows > 0) {
                $row_miembro = $result_miembro->fetch_assoc();
                $idMiembro = $row_miembro['id'];

                // Eliminar los registros de membresiaapagar
                $sql_membresiaapagar = "DELETE FROM membresiapagar WHERE id_miembro = $idMiembro";
                if ($conexion->query($sql_membresiaapagar) === TRUE) {
                    echo "Registros de membresía a pagar eliminados exitosamente.";
                } else {
                    echo "Error al eliminar los registros de membresía a pagar: " . $conexion->error;
                }

                // Eliminar el registro de la tabla Miembro
                $sql_miembro = "DELETE FROM Miembro WHERE persona_id = $id_eliminar";
                if ($conexion->query($sql_miembro) === TRUE) {
                    echo "Miembro eliminado exitosamente.";
                } else {
                    echo "Error al eliminar el registro de Miembro: " . $conexion->error;
                }
            }
        }

        // Eliminar el registro de la tabla de personas
        $sql_persona = "DELETE FROM Persona WHERE id = $id_eliminar";
        if ($conexion->query($sql_persona) === TRUE) {
            echo "Persona eliminada exitosamente.";
        } else {
            echo "Error al eliminar el registro de persona: " . $conexion->error;
        }
    } else {
        echo "No se encontró ninguna persona con el ID proporcionado.";
    }
} else {
    echo "ID de registro a eliminar no proporcionado.";
}

// Cerrar conexión
$conexion->close();
?>
