<?php
session_start();
require_once("usuario.php");

$email = $_POST["email"];
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$nacimiento = $_POST["nacimiento"];
$contra = $_POST["contrasenia"];
$news = $_POST["newsletter"];

if (Usuario::obtenerUsuarioByMail($email) != null) {
    $_SESSION['mensaje'] = "El correo introducido ya está registrado.";
    header("Location: altausuarios.php");
    exit();
}   

Usuario::insertarUsuario($email, $nombre, $apellidos, $nacimiento, $contra, $news);

header("Location: registrado.php");
exit();
?>