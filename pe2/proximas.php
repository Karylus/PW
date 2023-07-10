<?php
require_once("pelicula.php");
require_once("imagen.php");

// Obtener las películas de la base de datos
$peliculas = Pelicula::obtenerPeliculas();

// Obtengo las películas en cartelera
$peliculasProximamente = array();

foreach ($peliculas as $pelicula) {
    if ($pelicula->devolverValor("Categoria") == "Proximamente") {
        $peliculasProximamente[] = $pelicula;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Cines Moreno - Próximos Estrenos</title>
    <link rel="stylesheet" href="estilo.css">
    <meta charset="UTF-8">
</head>

<body>
    <header>
        <?php include("header.php"); ?>
    </header>

    <main>
        <section class="peliculas_estreno">
            <h2>Próximos Estrenos</h2>
            <section class="break"></section>

            <?php foreach ($peliculasProximamente as $pelicula) {
                $imagenID = $pelicula->devolverValor("ImagenID");
                $imagen = Imagen::obtenerImagen($imagenID); ?>
                <article>
                    <a href="templatePelicula.php?id=<?php echo $pelicula->devolverValor("ID") ?>"><img class="foto_pelicula" src="data:image/jpeg;base64,<?php echo base64_encode($imagen->devolverValor("Imagen")); ?>" alt="Poster"></a>
                    <a href="templatePelicula.php?id=<?php echo $pelicula->devolverValor("ID") ?>"><?php echo $pelicula->devolverValor("Titulo"); ?></a>
                    <p><?php echo $pelicula->devolverValor("Director"); ?></p>
                    <p><?php echo $pelicula->devolverValor("Fecha_de_lanzamiento"); ?></p>
                    <p><?php echo $pelicula->devolverValor("Actores_principales"); ?></p>
                    <p><?php echo $pelicula->obtenerValoracionMedia($pelicula->devolverValor("ID")) . '/5'; ?></p>
                </article>
            <?php } ?>

        </section>

        <a href="#" class="boton-flotante"></a>
    </main>

    <footer>
        <?php include("footer.html"); ?>
    </footer>
</body>

</html>