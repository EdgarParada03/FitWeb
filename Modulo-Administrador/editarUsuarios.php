<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4caf50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: #ff0000;
            font-style: italic;
        }

        /* styles.css */

        .button-container {
            text-align: center;
            margin-top: 10px;
        }

        .button-container button {
            padding: 10px 20px;
            background-color: #ccc;
            color: #333;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Editar Registro</h2>

        <?php
        include 'conexion.php';

        if (isset($_GET['id_registro'])) {
            $id_registro = $_GET['id_registro'];

            if (isset($_POST['actualizar_registro'])) {
                $nuevo_valor1 = $_POST['nombreCompleto'];
                $nuevo_valor2 = $_POST['numeroIdentificacion'];
                $nuevo_valor3 = $_POST['correo'];
                $nuevo_valor4 = $_POST['sexo'];

                $sql_update = "UPDATE Persona SET nombreCompleto = '$nuevo_valor1', numeroIdentificacion = '$nuevo_valor2', 
                correo = '$nuevo_valor3', sexo = '$nuevo_valor4'
                WHERE id = $id_registro";
                if ($conexion->query($sql_update) === TRUE) {
                    echo "<p class='success-message'>Registro actualizado exitosamente.</p>";
                } else {
                    echo "<p class='error-message'>Error al actualizar el registro: " . $conn->error . "</p>";
                }
            }

            $sql_select = "SELECT * FROM Persona WHERE id = $id_registro";
            $result = $conexion->query($sql_select);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
                <form action="" method="post">
                    <label for="nombreCompleto">Editar Nombre:</label>
                    <input type="text" name="nombreCompleto" id="nombreCompleto" value="<?php echo $row['nombreCompleto']; ?>">

                    <label for="numeroIdentificacion">Editar Identificacion:</label>
                    <input type="text" name="numeroIdentificacion" id="numeroIdentificacion" value="<?php echo $row['numeroIdentificacion']; ?>">

                    <label for="correo">Editar Correo:</label>
                    <input type="text" name="correo" id="correo" value="<?php echo $row['correo']; ?>">

                    <label for="sexo">Editar Sexo:</label>
                    <input type="text" name="sexo" id="sexo" value="<?php echo $row['sexo']; ?>">



                    <input type="submit" name="actualizar_registro" value="Actualizar">
                    <div class="button-container">
                        <button type="button" onclick="window.location.href='administrador-Usuarios.html'">Volver</button>
                    </div>
                </form>
        <?php
            } else {
                echo "<p class='error-message'>No se encontraron resultados para el ID proporcionado.</p>";
            }
        } else {
            echo "<p class='error-message'>ID de registro no proporcionado.</p>";
        }

        $conexion->close();
        ?>

    </div>

</body>

</html>