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
                    <input type="text" id="numero_identificacion" name="numero_identificacion" placeholder="Número de identificación" required pattern="[0-9]+">
                    <input type="password" name="contrasena" placeholder="Contraseña" required>
                    <select name="rol" required>
                        <option value="">Seleccione su rol...</option>
                        <option value="miembro">Miembro</option>
                        <option value="entrenador">Entrenador</option>
                        <option value="gerente">Gerente</option>
                    </select>
                    <a href="#" class="btn-1">Recuperar contraseña</a>
                    <button type="submit" name="login">Entrar</button>
                </form>
                <!--Registro-->
                <form action="/Modulo-No-Miembros/Login-Register/php/registrarUsuarios.php" method="POST" class="formulario__register" id="registroForm">
                    <h2>Registrarse</h2>
                    <input type="text" placeholder="Nombre Completo" name="nombre_completo" id="nombre_completo">
                    <input type="text" placeholder="Número de identificación" name="numero_identificacion" required pattern="[0-9]+" id="identificacion_input">
                    <input type="date" placeholder="Fecha nacimiento" name="fecha_nacimiento">
                    <input type="email" placeholder="Correo" name="correo">
                    <input type="text" placeholder="Teléfono" name="telefono">
                    <select name="sexo">
                        <option value="" disabled selected>Selecciona tu sexo</option>
                        <option value="hombre">Hombre</option>
                        <option value="mujer">Mujer</option>
                        <option value="binario">Binario</option>
                        <option value="no_decir">Prefiero no decirlo</option>
                    </select>
                    <input type="password" placeholder="Contraseña" name="contrasena">
                    <input type="submit" value="Registrarse" name="registrar">
                </form>
            </div>
        </div>
    </main>
    <script src="/Modulo-No-Miembros/Login-Register/Todo/js/script.js"></script>
    <script src="/Modulo-Miembros/clientes-membresias.html"></script>

    <script>
        document.getElementById('registroForm').addEventListener('submit', function(event) {
            // Obtener los valores del nombre y número de identificación
            var nombre = document.getElementById('nombre_completo').value;
            var identificacion = document.getElementById('identificacion_input').value;

            // Redireccionar a la página del segundo formulario con los parámetros de nombre y número de identificación
            window.location.href = '/Modulo-Miembros/clientes-membresias.html?nombre=' + encodeURIComponent(nombre) + '&identificacion=' + encodeURIComponent(identificacion);

            
        });
    </script>
</body>

</html>