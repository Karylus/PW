<?php
if (!isset($_SESSION))
    session_start();

if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script>alert('$mensaje');</script>";
    unset($_SESSION['mensaje']);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <script>
        function validarLogin() {
            let email = document.getElementById("usuario").value;
            let contrasenia = document.getElementById("contrasenia").value;

            // Validación de correo electrónico
            let expresionEmail = /\S+@\S+\.\S+/;
            if (!expresionEmail.test(email)) {
                alert("Por favor, introduzca una dirección de correo electrónico válida.");
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
        <a href="index.php" class="enlace-imagen"><img class="logo" src="imagenes/logo.png" alt="Logo"></a>

        <a href="index.php" class="enlace-imagen">
            <h1>Cines Moreno</h1>
        </a>

        <?php if (isset($_SESSION['login_fallado']) && $_SESSION['login_fallado'] == false) : ?>
            <section class="usuario_logueado">
                <p>Hola, <?php echo $_SESSION['nombre']; ?> (<?php echo $_SESSION['tipo']; ?>)</p>
                <a href="perfil.php">Modificar perfil</a>
                <form action="cerrarSesion.php" method="post">
                    <input type="submit" id="boton" value="Cerrar Sesión">
                </form>
            </section>
        <?php else : ?>
            <form class="inicio_sesion" action="iniciarSesion.php" method="post" onsubmit="return validarLogin();">
                <input type="text" id="usuario" name="usuario" placeholder="E-mail"><br>
                <input type="password" id="contrasenia" name="contraseña" placeholder="Contraseña"><br>
                <input type="submit" id="boton" value="Iniciar Sesión"><br>
                <a href="altausuarios.php">Registro de usuario</a>
            </form>
        <?php endif; ?>

        <nav class="indice">
            <article><a href="index.php">Inicio</a></article>
            <article><a href="estrenos.php">Estrenos</a></article>
            <article><a href="cartelera.php">Cartelera</a></article>
            <article><a href="horarios.php">Horarios</a></article>
            <article><a href="tarifas.php">Tarifas</a></article>
            <article><a href="informacion.php">Información</a></article>
            <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'admin') : ?>
                <article><a href="adminpanel.php">Panel de Administrador</a></article>
            <?php endif; ?>
        </nav>
    </header>
</body>

</html>