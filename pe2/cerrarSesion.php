<?php
    session_start();

    // Eliminar todas las variables de sesión
    $_SESSION = array();

    // Destruye la sesión
    session_destroy();

    header("Location: index.php");
    exit();
?>
