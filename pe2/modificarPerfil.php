<?php

session_start();
require_once("usuario.php");

    $id = $_POST['id'];
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $nacimiento = $_POST['nacimiento'];
    $newsletter = isset($_POST['newsletter']) ? $_POST['newsletter'] : 0;

    // if (Usuario::obtenerUsuarioByMail($email) != null) {
    //     $_SESSION['mensaje'] = "El correo introducido ya está registrado.";
    //     header("Location: perfil.php");
    //     exit();
    // }

    Usuario::modificarUsuario($id, $email, $nombre, $apellidos, $nacimiento, $newsletter);

    header('Location: perfil.php');
    exit();
?>