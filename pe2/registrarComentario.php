<?php
require_once("comentario.php");

$comentario = $_POST["comentario"];
$valoracion = $_POST["valoracion"];
$fecha = date('Y-m-d');
$peliculaID = $_POST["peliculaID"];
$usuarioID = $_POST["usuarioID"];

$comentario = Comentario::insertarComentario($peliculaID, $usuarioID, $comentario, $valoracion, $fecha);

header("Location: templatePelicula.php?id=$peliculaID");
exit();
?>