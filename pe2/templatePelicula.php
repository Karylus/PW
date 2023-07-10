<?php
session_start();

require_once("pelicula.php");
require_once("imagen.php");
require_once("comentario.php");
require_once("usuario.php");

// Obtener el ID de la película
$id = $_GET["id"];

// Obtener el ID y correo del usuario
if (isset($_SESSION["id"]) && isset($_SESSION["email"])) {
    $idUsuario = $_SESSION["id"];
    $correoUsuario = $_SESSION["email"];
}

// Obtener la película desde la base de datos
$pelicula = Pelicula::obtenerPelicula($id);

// Obtener los comentarios de la película
$comentarios = Comentario::obtenerComentariosPelicula($id);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cines Moreno - Detalles Pelicula</title>
    <link rel="stylesheet" href="estilo.css">
    <!--Adapta la web al ancho del dispositivo y el zoom-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script>
        function validarComentario() {
            let comentario = document.getElementById("comentario").value;

            // Validar comentario
            if (comentario.length < 1) {
                alert("Por favor, introduzca un comentario.");
                return false;
            }

            // Validar valoración
            let valoracion = document.getElementById("valoracion").value;
            
            if (valoracion < 0 || valoracion > 5) {
                alert("Por favor, introduzca una valoración entre 0 y 5.");
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
        <section class="caja_datos">
            <h2><?php echo $pelicula->devolverValor("Titulo"); ?></h2>

            <section class="break"></section>

            <section class="fila_imagenes">
                <?php
                // Obtener las imágenes de la película desde la base de datos
                $imagenesID = $pelicula->devolverValor("ImagenID");
                $imagen = Imagen::obtenerImagen($imagenesID);

                echo '<img class="frame" src="data:image/jpeg;base64,' . base64_encode($imagen->devolverValor("Imagen")) . '" alt="Frame">';

                ?>
            </section>

            <section class="datos_pelicula">
                <h3>Director</h3>
                <p><?php echo $pelicula->devolverValor("Director"); ?></p>

                <h3>Actores Principales</h3>
                <p><?php echo $pelicula->devolverValor("Actores_principales"); ?></p>

                <h3>Sinopsis</h3>
                <p><?php echo $pelicula->devolverValor("Sinopsis"); ?></p>

                <h3>Género</h3>
                <p><?php echo $pelicula->devolverValor("Genero"); ?></p>
            </section>

            <section class="clasificacion">
                <?php
                // Obtener la valoración media de la película desde la base de datos
                $valoracionMedia = Pelicula::obtenerValoracionMedia($id);

                // Mostrar las estrellas de clasificación según la valoración media
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $valoracionMedia) {
                        echo '<article class="estrella_llena"></article>';
                    } else {
                        echo '<article class="estrella_vacia"></article>';
                    }
                }
                ?>
            </section>

            <section class="comentarios">
                <h2>Comentarios (<?php echo (sizeof($comentarios)) ?>)</h2>

                <?php
                // Mostrar un mensaje si no hay comentarios
                if (sizeof($comentarios) == 0) {
                    echo ('<p>No hay comentarios.</p>');
                }

                // Mostrar los comentarios de la película
                foreach ($comentarios as $comentario) {
                    $idComentario = $comentario->devolverValor("ID");
                    $idUsuarioComentario = $comentario->devolverValor("ID_usuario");

                    $usuarioComentario = Usuario::obtenerUsuario($idUsuarioComentario);
                    $nombreUsuarioComentario = $usuarioComentario->devolverValor("Nombre");

                    $textoComentario = $comentario->devolverValor("Comentario");
                    $valoracionComentario = $comentario->devolverValor("Puntuacion");
                    
                    echo '<article>';
                    echo '<h3>' . $nombreUsuarioComentario . '</h3>';
                    echo '<p>' . $textoComentario . '</p>';
                    echo '<h4>' . $valoracionComentario . '/5</h4>';
                    echo '</article>';
                }
                ?>

                <?php if (isset($_SESSION['inicio_sesion'])) { ?>
                    <h2>Enviar comentario</h2>
                    <form class="formulario_comentario" action="registrarComentario.php" method="post" onsubmit="return validarComentario();" >

                        <label for="comentario">Comentario</label><br>
                        <textarea name="comentario" id="comentario" rows="10" cols="40" placeholder="Escribe tu comentario..."></textarea><br>

                        <label for="valoracion">Valoración</label><br>
                        <input type="number" id="valoracion" name="valoracion" min="0" max="5" step="0.5"><br>

                        <input type="hidden" name="peliculaID" value="<?php echo $id; ?>">
                        <input type="hidden" name="usuarioID" value="<?php echo $idUsuario; ?>">

                        <input type="submit" id="boton" name="Enviar">
                    </form>
                <?php } else { ?>
                    <p>Por favor, inicia sesión para comentar.</p>
                <?php } ?>
            </section>
        </section>

        <a href="#" class="boton-flotante"></a>
    </main>

    <footer>
        <?php include("footer.html"); ?>
    </footer>
</body>

</html>