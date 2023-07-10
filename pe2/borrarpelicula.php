<?php
require_once("pelicula.php") ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cines Moreno - Borrar Pelicula</title>
    <link rel="stylesheet" href="estilo.css">
    <!--Adapta la web al ancho del dispositivo y el zoom-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script>
        function eliminarPelicula(id) {
            if (confirm("¿Estás seguro de que quieres eliminar esta película?")) {

                window.location.href = "eliminarPelicula.php?id=" + id;
            }
        }
    </script>
</head>

<body>
    <header>
        <?php include("header.php"); ?>
    </header>

    <main>
        <?php $peliculas = Pelicula::obtenerPeliculas(); ?>

        <section class="borra_pelicula">
            <h2>¿Qué película desea borrar?</h2>
            <h3>Seleccione una película de la lista:</h3>

            <form onsubmit="eliminarPelicula(document.getElementById('pelicula').value); return false;">
                <select name="pelicula" id="pelicula">
                    <?php foreach ($peliculas as $pelicula) {
                        $id = $pelicula->devolverValor('ID');
                        $titulo = $pelicula->devolverValor('Titulo');

                        echo "<option value=\"$id\">$titulo</option>";
                    } ?>
                </select><br>

                <input type="submit" id="boton" value="Borrar">
            </form>
        </section>
        <a href="#" class="boton-flotante"></a>
    </main>

    <footer>
        <?php include("footer.html"); ?>
    </footer>
</body>

</html>