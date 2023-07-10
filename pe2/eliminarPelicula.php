<?php
require_once("pelicula.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    Pelicula::eliminarPelicula($id);
}

header("Location: adminpanel.php");
exit();
?>