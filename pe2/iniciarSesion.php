<?php
session_start();
require_once("usuario.php");

$email = $_POST['usuario'];
$contrasenia = $_POST['contraseña'];

$usuario = Usuario::obtenerUsuarioByMail($email);

if ($usuario != null)
    $contra_hash = $usuario->devolverValor("Contrasenia");

if ($usuario == null || !password_verify($contrasenia, $contra_hash)) {
    // El usuario no existe o la contraseña no es válida
    $_SESSION['login_fallado'] = true;    
    $_SESSION['mensaje'] = "El correo o la contraseña introducidos no son válidos.";

    header('Location: index.php');
    exit();

} else {
    $_SESSION['login_fallado'] = false;
    $_SESSION['inicio_sesion'] = true;

    $_SESSION['id'] = $usuario->devolverValor("ID");
    $_SESSION['nombre'] = $usuario->devolverValor("Nombre");
    $_SESSION['tipo'] = $usuario->devolverValor("tipo");
    $_SESSION['email'] = $usuario->devolverValor("Mail");

    header('Location: index.php');
    exit();
}
