<?php
require_once("pelicula.php");
require_once("imagen.php");

// Obtener las películas de la base de datos
$peliculas = Pelicula::obtenerPeliculas();

// Obtengo las películas en cartelera
$peliculasValoradas = array();

foreach ($peliculas as $pelicula) {
    $id = $pelicula->devolverValor("ID");
    $valoracionMedia = Pelicula::obtenerValoracionMedia($id);
    $peliculasValoradas[$id] = $valoracionMedia;
}

arsort($peliculasValoradas);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Cines Moreno - Mejores Peliculas</title>
    <link rel="stylesheet" href="estilo.css">
    <meta charset="UTF-8">
</head>

<body>
    <header>
        <?php include("header.php"); ?>
    </header>

    <main>
        <section class="peliculas_estreno">
            <h2>Mejores Peliculas</h2>
            <section class="break"></section>

            <?php
            $contador = 0;
            $claves = array_keys($peliculasValoradas);

            foreach ($peliculasValoradas as $peliculaValoradas) {
                if ($contador == 5) {
                    break;
                }

                $pelicula = Pelicula::obtenerPelicula($claves[$contador]);

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
            <?php
                $contador++;
            } ?>

        </section>

        <a href="#" class="boton-flotante"></a>
    </main>

    <footer>
        <?php include("footer.html"); ?>
    </footer>
</body>

</html>