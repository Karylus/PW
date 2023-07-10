<?php
require_once("libro.php");

$datos = Libro::obtenerLibros(0, 5, "isbn");

$libros = $datos[0];

foreach ($libros as $libro) {
    echo "ISBN: " . $libro->devolverValor("isbn") . "<br>";
    echo "Titulo: " . $libro->devolverValor("titulo") . "<br>";
    echo "Autor: " . $libro->devolverValor("autor") . "<br>";
    echo "Editorial: " . $libro->devolverValor("editorial") . "<br>";
    echo "Numero de páginas: " . $libro->devolverValor("numPaginas") . "<br>";
    echo "Año: " . $libro->devolverValor("anio") . "<br><br>";
}
?>