<?php
require_once("libro.php");

$isbn;
isset($_GET["isbn"]) and trim($_GET["isbn"]) != "" ? $isbn = $_GET["isbn"] : $isbn = "";

$libro = Libro::obtenerLibro($isbn);
?>

<form action="modificarLibro2.php" method="post">
    <label for="titulo">Introduce el nuevo titulo:</label><br>
    <input type="text" name="titulo" value="<?php echo($libro->devolverValor("titulo")) ?>"><br>

    <label for="autor">Introduce el nuevo autor:</label><br>
    <input type="text" name="autor" value="<?php echo($libro->devolverValor("titulo")) ?>"><br>

    <label for="editorial">Introduce la nueva editorial:</label><br>
    <input type="text" name="editorial" value="<?php echo($libro->devolverValor("editorial")) ?>"><br>

    <label for="numPaginas">Introduce el nuevo número de páginas:</label><br>
    <input type="text" name="numPaginas" value="<?php echo($libro->devolverValor("numPaginas")) ?>"><br>

    <label for="anio">Introduce el nuevo año:</label><br>
    <input type="text" name="anio" value="<?php echo($libro->devolverValor("anio")) ?>"><br>

    <input type="hidden" name="isbn" value="<?php echo($isbn) ?>">
    <input type="submit" value="Modificar">
</form>