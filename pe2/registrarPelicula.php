<?php
require_once("pelicula.php");

$titulo = $_POST["titulo"];
$director = $_POST["director"];
$genero = $_POST["genero"];
$duracion = $_POST["duracion"];
$sinopsis = $_POST["sinopsis"];
$fecha = $_POST["fecha"];
$actores = $_POST["actores"];
$imagenID = $_POST["imagen"];
$categoria = $_POST["categoria"];

$id = Pelicula:: insertarPelicula($titulo, $director, $genero, $duracion, $sinopsis, $fecha, $actores, $imagenID, $categoria);

header("Location: templatePelicula.php?id=$id");
exit();
?>