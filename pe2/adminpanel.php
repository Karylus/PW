<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cines Moreno - Admin panel</title>
    <link rel="stylesheet" href="estilo.css">
    <!--Adapta la web al ancho del dispositivo y el zoom-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <?php include("header.php"); ?>
    </header>

    <main>
        <section class="admin_panel">
            <ul>
                <li><a href="crearpelicula.php">Añadir película.</a></li>
                <li><a href="modificarpelicula.php">Modificar película.</a></li>
                <li><a href="borrarpelicula.php">Eliminar película.</a></li>
            </ul>
        </section>

        <a href="#" class="boton-flotante"></a>
    </main>

    <footer>
        <?php include("footer.html"); ?>
    </footer>
</body>

</html>