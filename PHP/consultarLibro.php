<?php
require_once("libro.php");

$isbn;

isset($_GET["isbn"]) and trim($_GET["isbn"]) != "" ? $isbn = $_GET["isbn"] : $isbn = "";

$libro = Libro::obtenerLibro($isbn);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Consultar Libro</title>
    </head>

    <body>
        
        <p>ISBN: <?php echo($libro->devolverValor("isbn"))?> <br>
            Titulo: <?php echo($libro->devolverValor("titulo"))?> <br>
            Autor: <?php echo($libro->devolverValor("autor"))?> <br>
            Editorial: <?php echo($libro->devolverValor("editorial"))?> <br>
            Numero de páginas: <?php echo($libro->devolverValor("numPaginas"))?> <br>
            Año: <?php echo($libro->devolverValor("anio"))?></p>
    </body>
</html>