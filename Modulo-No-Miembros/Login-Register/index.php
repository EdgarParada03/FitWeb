<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Registro | FitWeb</title>
    <link rel="stylesheet" href="/Modulo-No-Miembros/Login-Register/Todo/css/estilos.css">
</head>

<body>

    <main>

        <div class="contenedor__todo">

            <div class="caja__trasera">

                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn_iniciar-sesion"> Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn_registrarse">Registrarse</button>
                </div>
            </div>

            <!--Formulario de login y Registro-->
            <div class="contenedor__login-register">

                <!--Login-->
                <form action="/Modulo-No-Miembros/Login-Register/php/iniciarSesion.php" method="POST" class="formulario__login" id="loginForm">
                    <h2>Iniciar Sesión</h2>
                    <!-- Añadir un ID al campo de número de identificación para poder acceder a él fácilmente con JavaScript -->
                    <input type="text" id="numero_identificacion" name="numero_identificacion" placeholder="Número de identificación" required="" pattern="[0-9]+">
                    <input type="password" name="contrasena" placeholder="Contraseña" required="">

                    <!-- Agregar lista desplegable de roles -->
                    <select name="rol" required>
                        <option value="">Seleccione su rol...</option>
                        <option value="miembro">Miembro</option>
                        <option value="entrenador">Entrenador</option>
                    </select>

                    <a href="#" class="btn-1">Recuperar contraseña</a>
                    <!-- Cambiar el botón para que envíe el formulario y ejecute la función que cargue el número de identificación -->
                    <button type="submit" name="login" onclick="cargarNumeroIdentificacion()">Entrar</button>
                </form>

                <!--Registro-->
                <form action="/Modulo-No-Miembros/Login-Register/php/registrarUsuarios.php" method="POST" class="formulario__register">
                    <h2>Registrarse</h2>
                    <input type="text" placeholder="Nombre Completo" name="nombre_completo">
                    <input type="text" placeholder="Número de identificación" name="numero_identificacion" required="" pattern="[0-9]+">
                    <input type="text" placeholder="Fecha nacimiento" onfocus="(this.type='date')" name="fecha_nacimiento">
                    <input type="email" placeholder="Correo" name="correo">
                    <input type="text" placeholder="Teléfono" name="telefono">
                    <select name="sexo" name="sexo">
                        <option value="" disabled selected>Selecciona tu sexo</option>
                        <option value="hombre">Hombre</option>
                        <option value="mujer">Mujer</option>
                        <option value="binario">Binario</option>
                        <option value="no_decir">Prefiero no decirlo</option>
                    </select>
                    <input type="password" placeholder="Contraseña" name="contrasena">
                    <a href="/index.html">
                        <input type="submit" value="Registrarse" name="registrar">
                    </a>
                </form>
            </div>
        </div>
    </main>
    <script src="/Modulo-No-Miembros/Login-Register/Todo/js/script.js"></script>

    <!-- Aquí empieza el script adicional -->
    <script>
        // Obtener el número de identificación del formulario y enviarlo al campo en clientes.php
        function cargarNumeroIdentificacion() {
            // Obtener el valor del número de identificación ingresado por el usuario
            var numeroIdentificacion = document.getElementById("numero_identificacion").value;
            // Asignar el valor del número de identificación al campo correspondiente en el formulario de clientes.php
            document.getElementById("loginForm").action = "/Modulo-Miembros/clientes.html?numero_identificacion=" + numeroIdentificacion;
        }
    </script>
    <!-- Aquí termina el script adicional -->
</body>

</html>
