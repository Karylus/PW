<!DOCTYPE html>
<html lang="es">

<head>
    <title>Cines Moreno - Registro</title>
    <link rel="stylesheet" href="estilo.css">
    <meta charset="UTF-8">

    <script>
        function validarRegistro() {
            let email = document.getElementById("mail").value;
            let nombre = document.getElementById("nombre").value;
            let apellidos = document.getElementById("apellido").value;
            let nacimiento = document.getElementById("nacimiento").value;
            let contrasenia = document.getElementById("contra").value;

            // Validación de correo electrónico
            let expresionEmail = /\S+@\S+\.\S+/;
            if (!expresionEmail.test(email)) {
                alert("Por favor, introduzca una dirección de correo electrónico válida.");
                return false;
            }

            // Validación de nombre y apellidos
            let expresionNombre = /^[a-zA-ZáéíóúñÑÁÉÍÓÚ\s]+$/;
            if (!expresionNombre.test(nombre) || !expresionNombre.test(apellidos)) {
                alert("Por favor, introduzca un nombre y apellidos válidos (solo letras y espacios).");
                return false;
            }

            // Validar fecha de nacimiento
            let fechaActual = new Date();
            let fechaNacimiento = new Date(nacimiento);

            if (fechaNacimiento > fechaActual) {
                alert("Por favor, introduzca una fecha de nacimiento válida.");
                return false;
            }

            // Validar contraseña
            if (contrasenia.length < 8) {
                alert("Por favor, introduzca una contraseña de al menos 8 caracteres.");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <header>
        <?php include("header.php"); ?>
    </header>

    <main>
        <form class="registro" action="registrarUsuario.php" method="post" onsubmit="return validarRegistro();">
            <label for=" email">E-mail</label><br>
            <input type="email" id="mail" name="email"><br>

            <label for="nombre">Nombre</label><br>
            <input type="text" id="nombre" name="nombre" pattern="^(?!.*administrador).*$"><br>

            <label for="apellidos">Apellidos</label><br>
            <input type="text" id="apellido" name="apellidos" pattern="^(?!.*administrador).*$"><br>

            <label for="nacimiento">Fecha de Nacimiento</label><br>
            <input type="date" id="nacimiento" name="nacimiento"><br>

            <label for="contraseña">Contraseña</label><br>
            <input type="password" id="contra" name="contrasenia"><br>

            <label for="newsletter">¿Desea suscribirse al Newsletter?</label><br>
            <input type="radio" id="newsletter" name="newsletter" value="1" checked>Si
            <input type="radio" id="newsletter" name="newsletter" value="0">No<br>

            <input type="submit" id="boton" value="Registrarse en Cines Moreno"><br>
        </form>

        <a href="#" class="boton-flotante"></a>
    </main>

    <footer>
        <?php include("footer.html"); ?>
    </footer>
</body>

</html>