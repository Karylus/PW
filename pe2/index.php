<?php
require_once("pelicula.php");
require_once("imagen.php");

// Obtener las películas de la base de datos
$peliculas = Pelicula::obtenerPeliculas();

// Clasificar peliculas por categoría
$peliculasCartelera = array();
$peliculasProximamente = array();
$peliculasEstreno = array();

foreach ($peliculas as $pelicula) {
    if ($pelicula->devolverValor("Categoria") == "Cartelera") {
        $peliculasCartelera[] = $pelicula;
    } else if ($pelicula->devolverValor("Categoria") == "Proximamente") {
        $peliculasProximamente[] = $pelicula;
    } else if ($pelicula->devolverValor("Categoria") == "Estrenos") {
        $peliculasEstreno[] = $pelicula;
    }
}

// Guardo los id de las películas ordenadas por valoración media
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
    <meta charset="UTF-8">
    <title>Cines Moreno</title>
    <link rel="stylesheet" href="estilo.css">
    <!--Adapta la web al ancho del dispositivo y el zoom-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>

<body>
    <header>
        <?php include("header.php"); ?>
    </header>

    <main>
        <main class="main_index">
            <section class="barra_noticias">
                <article>
                    <a href="noticia1.php">
                        <img class="foto_titular" src="imagenes/niños.jpg" alt="Foto Titular 1">
                    </a>
                    <p class="titulares">
                        <a href="noticia1.php">Cines Moreno estrena nuevas salas con la última tecnología en proyección y sonido</a>
                    </p>
                </article>

                <article>
                    <a href="noticia2.php">
                        <img class="foto_titular" src="imagenes/camara.jpg" alt="Foto Titular 2">
                    </a>
                    <p class="titulares">
                        <a href="noticia2.php">El cine Cines Moreno celebra su aniversario número 50 con una gran muestra de clásicos del cine</a>
                    </p>
                </article>

                <article>
                    <a href="noticia3.php">
                        <img class="foto_titular" src="imagenes/camarografo.jpg" alt="Foto Titular 3">
                    </a>
                    <p class="titulares">
                        <a href="noticia3.php">Cines Moreno lanza una iniciativa para promover el cine independiente y las producciones locales</a>
                    </p>
                </article>

                <article>
                    <a href="noticia4.php">
                        <img class="foto_titular" src="imagenes/cuaderno.jpg" alt="Foto Titular 4">
                    </a>
                    <p class="titulares">
                        <a href="noticia4.php">El cine Cines Moreno amplía su oferta de snacks y bebidas para mejorar la experiencia del espectador</a>
                    </p>
                </article>

                <article>
                    <a href="noticia5.php">
                        <img class="foto_titular" src="imagenes/butacas.jpg" alt="Foto Titular 5">
                    </a>
                    <p class="titulares">
                        <a href="noticia5.php">Cines Moreno presenta un ciclo de películas para toda la familia durante las vacaciones de verano</a>
                    </p>
                </article>

                <article>
                    <a href="noticia6.php">
                        <img class="foto_titular" src="imagenes/personas.jpg" alt="Foto Titular 6">
                    </a>
                    <p class="titulares">
                        <a href="noticia6.php">El cine Cines Moreno organiza una proyección especial de la película 'El Padrino' en versión restaurada para conmemorar su 50 aniversario</a>
                    </p>
                </article>
            </section>

            <!-- Es una barra que separa las dos cajas principales del documento-->
            <section class="separador"></section>

            <section class="caja_peliculas">
                <h2>Estrenos</h2>
                <section class="fila_peliculas">
                    <?php $contadorEstrenos = 0;
                    foreach ($peliculasEstreno as $peliculaEstreno) {
                        // Obtener las imágenes de la película desde la base de datos
                        $imagenID = $peliculaEstreno->devolverValor("ImagenID");
                        $imagen = Imagen::obtenerImagen($imagenID);

                        if ($contadorEstrenos < 3) { ?>
                            <article>
                                <div class="tooltip">
                                    <a href="templatePelicula.php?id=<?php echo $peliculaEstreno->devolverValor("ID") ?>"><img class="foto_pelicula" src="data:image/jpeg;base64,<?php echo base64_encode($imagen->devolverValor("Imagen")); ?>" alt="Poster 4"></a>
                                    <span class="tooltip_texto"><?php echo $peliculaEstreno->devolverValor("Titulo") ?> - <?php echo $peliculaEstreno->devolverValor("Categoria") ?></span>
                                </div>
                                <?php echo '<a class="titulo_pelicula" href="templatePelicula.php?id=' . $peliculaEstreno->devolverValor("ID") . '">' . $peliculaEstreno->devolverValor("Titulo") . '</a>'; ?>
                            </article>
                    <?php $contadorEstrenos++;
                        }
                    } ?>

                    <p class="ver_todas">
                        <a href="estrenos.php">Ver todas las peliculas</a>
                    </p>
                </section>

                <h2>Cartelera</h2>
                <section class="fila_peliculas">
                    <?php $contadorCartelera = 0;
                    foreach ($peliculasCartelera as $peliculaCartelera) {
                        $imagenID = $peliculaCartelera->devolverValor("ImagenID");
                        $imagen = Imagen::obtenerImagen($imagenID);

                        if ($contadorCartelera < 3) { ?>
                            <article>
                                <div class="tooltip">
                                    <a href="templatePelicula.php?id=<?php echo $peliculaCartelera->devolverValor("ID") ?>"><img class="foto_pelicula" src="data:image/jpeg;base64,<?php echo base64_encode($imagen->devolverValor("Imagen")); ?>" alt="Poster 4"></a>
                                    <span class="tooltip_texto"><?php echo $peliculaCartelera->devolverValor("Titulo") ?> - <?php echo $peliculaCartelera->devolverValor("Categoria") ?></span>
                                </div>
                                <?php echo '<a class="titulo_pelicula" href="templatePelicula.php?id=' . $peliculaCartelera->devolverValor("ID") . '">' . $peliculaCartelera->devolverValor("Titulo") . '</a>'; ?>
                            </article>
                    <?php $contadorCartelera++;
                        }
                    } ?>

                    <p class="ver_todas">
                        <a href="cartelera.php">Ver todas las peliculas</a>
                    </p>
                </section>

                <h2>Peliculas más valoradas</h2>
                <section class="fila_peliculas">
                    <?php $contadorValoradas = 0;
                    // Obtener las id de las películas más valoradas
                    $claves = array_keys($peliculasValoradas);

                    foreach ($peliculasValoradas as $peliculaValoradas) {
                        //Obtengo los datos de las películas más valoradas
                        $pelicula = Pelicula::obtenerPelicula($claves[$contadorValoradas]);

                        $imagenID = $pelicula->devolverValor("ImagenID");
                        $imagen = Imagen::obtenerImagen($imagenID);

                        if ($contadorValoradas < 3) { ?>
                            <article>
                                <div class="tooltip">
                                    <a href="templatePelicula.php?id=<?php echo $pelicula->devolverValor("ID") ?>"><img class="foto_pelicula" src="data:image/jpeg;base64,<?php echo base64_encode($imagen->devolverValor("Imagen")); ?>" alt="Poster 4"></a>
                                    <span class="tooltip_texto"><?php echo $pelicula->devolverValor("Titulo") ?> - <?php echo $pelicula->devolverValor("Categoria") ?></span>
                                </div>
                                <?php echo '<a class="titulo_pelicula" href="templatePelicula.php?id=' . $pelicula->devolverValor("ID") . '">' . $pelicula->devolverValor("Titulo") . '</a>'; ?>
                            </article>
                    <?php $contadorValoradas++;
                        }
                    } ?>

                    <p class="ver_todas">
                        <a href="masvaloradas.php">Ver todas las peliculas</a>
                    </p>
                </section>

                <h2>Próximos Estrenos</h2>
                <section class="fila_peliculas">
                    <?php $contadorProximos = 0;
                    foreach ($peliculasProximamente as $peliculaProximamente) {
                        $imagenID = $peliculaProximamente->devolverValor("ImagenID");
                        $imagen = Imagen::obtenerImagen($imagenID);

                        if ($contadorProximos < 3) { ?>
                            <article>
                                <div class="tooltip">
                                    <a href="templatePelicula.php?id=<?php echo $peliculaProximamente->devolverValor("ID") ?>"><img class="foto_pelicula" src="data:image/jpeg;base64,<?php echo base64_encode($imagen->devolverValor("Imagen")); ?>" alt="Poster 4"></a>
                                    <span class="tooltip_texto"><?php echo $peliculaProximamente->devolverValor("Titulo") ?> - <?php echo $peliculaProximamente->devolverValor("Categoria") ?></span>
                                </div>
                                <?php echo '<a class="titulo_pelicula" href="templatePelicula.php?id=' . $peliculaProximamente->devolverValor("ID") . '">' . $peliculaProximamente->devolverValor("Titulo") . '</a>'; ?>
                            </article>
                    <?php $contadorProximos++;
                        }
                    } ?>

                    <p class="ver_todas">
                        <a href="proximas.php">Ver todas las peliculas</a>
                    </p>
                </section>
            </section>

            <a href="#" class="boton-flotante"></a>
        </main>

        <footer>
            <?php include("footer.html"); ?>
        </footer>

        <script>
            // Script para mostrar el tooltip
            document.addEventListener('DOMContentLoaded', (event) => {
                // Seleccionar todos los elementos con la clase tooltip
                const tooltips = document.querySelectorAll('.tooltip');

                // Recorrer los elementos y añadir los eventos
                tooltips.forEach((tooltip) => {
                    // Añadir el evento mouseover
                    tooltip.addEventListener('mouseover', () => {
                        const tooltipTexto = tooltip.querySelector('.tooltip_texto');
                        tooltipTexto.style.visibility = 'visible';
                        tooltipTexto.style.opacity = 1;
                    });

                    // Añadir el evento mouseout
                    tooltip.addEventListener('mouseout', () => {
                        const tooltipTexto = tooltip.querySelector('.tooltip_texto');
                        tooltipTexto.style.visibility = 'hidden';
                        tooltipTexto.style.opacity = 0;
                    });
                });
            });
        </script>


</body>

</html>