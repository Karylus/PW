<?php 
require_once("imagen.php") ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cines Moreno - Crear Pelicula</title>
    <link rel="stylesheet" href="estilo.css">
    <!--Adapta la web al ancho del dispositivo y el zoom-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script>
        function validarPelicula() {
            let titulo = document.getElementById('titulo').value;
            let director = document.getElementById('director').value;
            let genero = document.getElementById('genero').value;
            let duracion = document.getElementById('duracion').value;
            let sinopsis = document.getElementById('sinopsis').value;
            let fecha = document.getElementById('fecha').value;
            let actores = document.getElementById('actores').value;
            let imagen = document.getElementById('imagen').value;
            let categoria = document.getElementById('categoria').value;

            if (titulo.trim() === '' || director.trim() === '' || genero.trim() === '' || duracion.trim() === '' || sinopsis.trim() === '' ||
                fecha.trim() === '' || actores.trim() === '' || imagen.trim() === '' || categoria.trim() === '') {
                alert('Rellene todos los campos del formulario.');

                return false;
                
            } else {
                return true;
            }
        }
    </script>
</head>

<body>
    <header>
        <?php include("header.php"); ?>
    </header>

    <main>
        <form class="crea_pelicula" action="registrarPelicula.php" method="post" onsubmit="return validarPelicula();">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo"><br>

            <label for="director">Director:</label>
            <input type="text" name="director" id="director"><br>

            <section>
                <label for="genero">Género:</label>
                <select name="genero" id="genero">
                    <option value="Accion">Acción</option>
                    <option value="Comedia">Comedia</option>
                    <option value="Drama">Drama</option>
                    <option value="Ciencia ficcion">Ciencia ficción</option>
                    <option value="Romance">Romance</option>
                    <option value="Thriller">Thriller</option>
                    <option value="Fantasia">Fantasía</option>
                    <option value="Aventura">Aventura</option>
                    <option value="Animacion">Animación</option>
                    <option value="Misterio">Misterio</option>
                </select><br>

                <label for="duracion">Duración:</label>
                <input type="number" name="duracion" id="duracion"><br>
            </section>
            <label for="sinopsis">Sinopsis:</label>
            <textarea name="sinopsis" rows="25" cols="50" id="sinopsis" placeholder="Escribe la sinopsis de la pelicula"></textarea><br>

            <label for="fecha">Fecha de estreno:</label>
            <input type="date" name="fecha" id="fecha"><br>

            <label for="actores">Actores:</label>
            <textarea name="actores" rows="4" cols="50" id="actores" placeholder="Escribe los actores de la pelicula"></textarea><br>

            <section>
                <label for="imagenes">Imágenes:</label>
                <select name="imagen" id="imagen">
                    <?php

                    $imagenes = Imagen::obtenerTodas();

                    // Generar las opciones del select con las imágenes
                    foreach ($imagenes as $imagen) {
                        $imagen_datos = base64_encode($imagen->devolverValor("Imagen"));

                        echo '<option value="' . $imagen->devolverValor("ID") . '" imagenDatos="' . $imagen_datos . '">' . $imagen->devolverValor("ID") . '</option>';
                    }
                    ?>
                </select>

                <script>
                    // Cuando se cambie la opción del select, cambiar la imagen
                    document.getElementById('imagen').addEventListener('change', function() {
                        let idElegido = this.options[this.selectedIndex];

                        let imagenDatos = idElegido.getAttribute('imagenDatos');

                        let imgElement = document.getElementById('imagenSeleccionada');

                        imgElement.src = 'data:image/png;base64,' + imagenDatos;
                    });
                </script>

                <label for="categoria">Categoría:</label>
                <select name="categoria" id="categoria">
                    <option value="Estrenos">Estrenos</option>
                    <option value="Proximamente">Próximamente</option>
                    <option value="Cartelera">Cartelera</option>
                </select>
            </section>

            <article class="imagen_seleccionada"><img id="imagenSeleccionada" src="" alt="Imagen seleccionada"></article>

            <input type="submit" id="boton" value="Registrar">
        </form>

        <a href="#" class="boton-flotante"></a>
    </main>

    <footer>
        <?php include("footer.html"); ?>
    </footer>
</body>

</html>