<?php
require_once("libro.php");

$isbn;
$titulo;
$autor;
$edito;
$pag; 
$year;

isset($_POST["isbn"]) and trim($_POST["isbn"]) != "" ? $isbn = $_POST["isbn"] : $isbn = "";
isset($_POST["titulo"]) and trim($_POST["titulo"]) != "" ? $titulo = $_POST["titulo"] : $titulo = "";
isset($_POST["autor"]) and trim($_POST["autor"]) != "" ? $autor = $_POST["autor"] : $autor = "";
isset($_POST["editorial"]) and trim($_POST["editorial"]) != "" ? $edito = $_POST["editorial"] : $edito = "";
isset($_POST["numPaginas"]) and trim($_POST["numPaginas"]) != "" ? $pag = $_POST["numPaginas"] : $pag = "";
isset($_POST["anio"]) and trim($_POST["anio"]) != "" ? $year = $_POST["anio"] : $year = "";

Libro::insertarLibro($isbn, $titulo, $autor, $edito, $pag, $year);

$libro = Libro::obtenerLibro($isbn);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Libro creado</title>
    </head>

    <body>
        <h3>¡Libro insertado!</h3>
        <p>ISBN: <?php echo($libro->devolverValor("isbn"))?> <br>
            Titulo: <?php echo($libro->devolverValor("titulo"))?> <br>
            Autor: <?php echo($libro->devolverValor("autor"))?> <br>
            Editorial: <?php echo($libro->devolverValor("editorial"))?> <br>
            Numero de páginas: <?php echo($libro->devolverValor("numPaginas"))?> <br>
            Año: <?php echo($libro->devolverValor("anio"))?></p>
    </body>
</html>