<?php
require_once("pelicula.php");
require_once("imagen.php");

$peliculas = Pelicula::obtenerPeliculas();
$peliculas_data = array();

foreach ($peliculas as $pelicula) {

    //Creo un json con los datos de la pelicula asociados a su id
    $id = $pelicula->devolverValor('ID');

    $peliculas_data[$id] = array(
        'titulo' => $pelicula->devolverValor('Titulo'),
        'director' => $pelicula->devolverValor('Director'),
        'genero' => $pelicula->devolverValor('Genero'),
        'duracion' => $pelicula->devolverValor('Duracion'),
        'sinopsis' => $pelicula->devolverValor('Sinopsis'),
        'fecha' => $pelicula->devolverValor('Fecha_de_lanzamiento'),
        'actores' => $pelicula->devolverValor('Actores_principales'),
        'imagen' => $pelicula->devolverValor('ImagenID'),
        'categoria' => $pelicula->devolverValor('Categoria')
    );
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cines Moreno - Modificar Pelicula</title>
    <link rel="stylesheet" href="estilo.css">
    <!--Adapta la web al ancho del dispositivo y el zoom-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        //Comprueba que ningún campo esté vacío antes de enviar el formulario
        function comprobarCampos() {
            let titulo = document.getElementById('titulo').value;
            let director = document.getElementById('director').value;
            let duracion = document.getElementById('duracion').value;
            let sinopsis = document.getElementById('sinopsis').value;
            let fecha = document.getElementById('fecha').value;
            let actores = document.getElementById('actores').value;

            if (titulo == "" || director == "" || duracion == "" || sinopsis == "" ||
                fecha == "" || actores == "") {
                alert("Rellene todos los campos del formulario.");

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
        <section class="crea_pelicula">
            <h2>¿Qué película desea modificar?</h2>
            <h3>Seleccione una película de la lista:</h3>

            <form action="modificarPelicula.php" method="post" id="formulario" onsubmit="return comprobarCampos();">
                <select name="pelicula" id="pelicula">
                    <?php foreach ($peliculas as $pelicula) {
                        $id = $pelicula->devolverValor('ID');
                        $titulo = $pelicula->devolverValor('Titulo');

                        echo "<option value='$id'>$titulo</option>";
                    } ?>
                </select><br>

                <input type="hidden" name="id" id="id">

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

                <label for="sinopsis">Sinopsis:</label><br>
                <textarea name="sinopsis" rows="25" cols="50" id="sinopsis" placeholder="Escribe la sinopsis de la pelicula"></textarea><br>

                <label for="fecha">Fecha de estreno:</label>
                <input type="date" name="fecha" id="fecha"><br>

                <label for="actores">Actores:</label><br>
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

                <!-- Script que me permite actualizar los campos del formulario al cambiar de pelicula seleccionada -->
                <script>
                    let peliculasData = <?php echo json_encode($peliculas_data); ?>;

                    let selectPelicula = document.getElementById('pelicula');
                    let idText = document.getElementById('id');
                    let tituloText = document.getElementById('titulo');
                    let directorText = document.getElementById('director');
                    let generoSelect = document.getElementById('genero');
                    let duracionText = document.getElementById('duracion');
                    let sinopsisText = document.getElementById('sinopsis');
                    let fechaText = document.getElementById('fecha');
                    let actoresText = document.getElementById('actores');
                    let imagenSelect = document.getElementById('imagen');
                    let categoriaSelect = document.getElementById('categoria');

                    function actualizaValores() {
                        let id = selectPelicula.options[selectPelicula.selectedIndex].value;
                        let pelicula = peliculasData[id];

                        idText.value = id;
                        tituloText.value = pelicula.titulo;
                        directorText.value = pelicula.director;
                        duracionText.value = pelicula.duracion;
                        sinopsisText.value = pelicula.sinopsis;
                        fechaText.value = pelicula.fecha;
                        actoresText.value = pelicula.actores;
                        imagenSelect.value = pelicula.imagen;
                        categoriaSelect.value = pelicula.categoria;

                        for (let i = 0; i < generoSelect.options.length; i++) {
                            if (generoSelect.options[i].value === pelicula.genero) {
                                generoSelect.options[i].selected = true;
                                break;
                            }
                        }
                    }

                    selectPelicula.addEventListener('change', actualizaValores);
                    window.onload = actualizaValores; // esto rellenará los campos cuando se cargue la página
                </script>

                <input type="submit" id="boton" value="Modificar">

            </form>
        </section>
        <a href="#" class="boton-flotante"></a>
    </main>

    <footer>
        <?php include("footer.html"); ?>
    </footer>
</body>

</html>