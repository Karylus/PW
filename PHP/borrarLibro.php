<?php
require_once("libro.php");

$isbn;

isset($_GET["isbn"]) and trim($_GET["isbn"]) != "" ? $isbn = $_GET["isbn"] : $isbn = "";

$libro = Libro::eliminarLibro($isbn);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Libro eliminado</title>
    </head>

    <body>
        <h3>¡Libro eliminado!</h3>
    </body>
</html>