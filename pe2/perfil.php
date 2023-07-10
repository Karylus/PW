<?php
session_start();
require_once("usuario.php");

$id = $_SESSION['id'];

$usuario = Usuario::obtenerUsuario($id);

$newsletter = $usuario->devolverValor("Newsletter");

$newsletter_si = '';
$newsletter_no = '';

if ($newsletter == 1) {
    $newsletter_si = 'checked';
} else {
    $newsletter_no = 'checked';
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cines Moreno - Perfil</title>
    <link rel="stylesheet" href="estilo.css">
    <!--Adapta la web al ancho del dispositivo y el zoom-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script>
        function validarRegistro() {
            let email = document.getElementById("mail").value
            let nombre = document.getElementById("nombre").value
            let apellidos = document.getElementById("apellido").value
            let nacimiento = document.getElementById("nacimiento").value

            // Validación de correo electrónico
            let expresionEmail = /\S+@\S+\.\S+/
            if (!expresionEmail.test(email)) {
                alert("Por favor, introduzca una dirección de correo electrónico válida.")
                return false
            }

            // Validación de nombre y apellidos
            let expresionNombre = /^[a-zA-ZáéíóúñÑÁÉÍÓÚ\s]+$/
            if (!expresionNombre.test(nombre) || !expresionNombre.test(apellidos)) {
                alert("Por favor, introduzca un nombre y apellidos válidos (solo letras y espacios).")
                return false;
            }

            // Validar fecha de nacimiento
            let fechaActual = new Date()
            let fechaNacimiento = new Date(nacimiento)

            if (fechaNacimiento > fechaActual) {
                alert("Por favor, introduzca una fecha de nacimiento válida.")
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
        <section class="perfil">
            <article>Tu ID de usuario es: <?php echo ($usuario->devolverValor("ID")) ?></article>

            <p>¿Quieres cambiar alguno de los datos de tu usuario?</p>
            <form action="modificarPerfil.php" method="post" onsubmit="return validarRegistro();">
                <label for="email">E-mail</label><br>
                <input type="email" id="mail" name="email" value="<?php echo ($usuario->devolverValor("Mail")) ?>"><br>

                <label for="nombre">Nombre</label><br>
                <input type="text" id="nombre" name="nombre" value="<?php echo ($usuario->devolverValor("Nombre")) ?>"><br>

                <label for="apellidos">Apellidos</label><br>
                <input type="text" id="apellido" name="apellidos" value="<?php echo ($usuario->devolverValor("Apellido")) ?>"><br>

                <label for="nacimiento">Fecha de Nacimiento</label><br>
                <input type="date" id="nacimiento" name="nacimiento" value="<?php echo ($usuario->devolverValor("Fecha_de_nacimiento")) ?>"><br>

                <label for="newsletter">¿Desea suscribirse al Newsletter?</label><br>
                <input type="radio" id="newsletter" name="newsletter" value="1" <?php echo $newsletter_si; ?>>Si
                <input type="radio" id="newsletter" name="newsletter" value="0" <?php echo $newsletter_no; ?>>No<br>

                <input type="hidden" name="id" value="<?php echo ($usuario->devolverValor("ID")) ?>">

                <input type="submit" id="boton" value="Guardar">
            </form>
        </section>

        <a href="#" class="boton-flotante"></a>
    </main>

    <footer>
        <?php include("footer.html"); ?>
    </footer>
</body>

</html>