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
                $nuevo_valor1 = $_POST['nombre'];
                $nuevo_valor2 = $_POST['zona'];
                $nuevo_valor3 = $_POST['ejercicios'];
                $nuevo_valor4 = $_POST['series'];
                $nuevo_valor5 = $_POST['descripcion'];
                $nuevo_valor6 = $_POST['video'];

                $sql_update = "UPDATE Rutinas SET nombre = '$nuevo_valor1', zona_muscular = '$nuevo_valor2', 
                ejercicios = '$nuevo_valor3', series = '$nuevo_valor4', descripcion = '$nuevo_valor5', video = '$nuevo_valor6'
                WHERE id = $id_registro";
                if ($conn->query($sql_update) === TRUE) {
                    echo "<p class='success-message'>Registro actualizado exitosamente.</p>";
                } else {
                    echo "<p class='error-message'>Error al actualizar el registro: " . $conn->error . "</p>";
                }
            }

            $sql_select = "SELECT * FROM Rutinas WHERE id = $id_registro";
            $result = $conn->query($sql_select);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
                <form action="" method="post">
                    <label for="nombre">Editar Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $row['nombre']; ?>">

                    <label for="zona">Editar Zona mucular:</label>
                    <input type="text" name="zona" id="zona" value="<?php echo $row['zona_muscular']; ?>">

                    <label for="ejercicios">Editar Ejercicios:</label>
                    <input type="text" name="ejercicios" id="ejercicios" value="<?php echo $row['ejercicios']; ?>">

                    <label for="series">Editar Series:</label>
                    <input type="text" name="series" id="series" value="<?php echo $row['series']; ?>">

                    <label for="descripcion">Editar Descripcion:</label>
                    <input type="text" name="descripcion" id="descripcion" value="<?php echo $row['descripcion']; ?>">

                    <label for="video">Editar Video:</label>
                    <input type="text" name="video" id="video" value="<?php echo $row['video']; ?>">

                    <input type="submit" name="actualizar_registro" value="Actualizar">
                    <div class="button-container">
                        <button type="button" onclick="window.location.href='entrenador-entrenamientos-rutinas.html'">Volver</button>
                    </div>
                </form>
        <?php
            } else {
                echo "<p class='error-message'>No se encontraron resultados para el ID proporcionado.</p>";
            }
        } else {
            echo "<p class='error-message'>ID de registro no proporcionado.</p>";
        }

        $conn->close();
        ?>

    </div>

</body>

</html>