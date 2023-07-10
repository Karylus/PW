<?php
require_once("datosObject.inc.php");

class Usuario extends DataObject
{
    protected $datos = array(
        "ID" => "",
        "Mail" => "",
        "Nombre" => "",
        "Apellido" => "",
        "Fecha_de_nacimiento" => "",
        "Contrasenia" => "",
        "Newsletter" => "",
        "tipo" => ""
    );

    public static function obtenerUsuario($id)
    {
        $conexion = parent::conectar();

        $sql = "SELECT * FROM " . TABLA_USUARIOS . " WHERE ID = :id";

        try {
            $st = $conexion->prepare($sql);
            $st->bindValue(":id", $id, PDO::PARAM_INT);
            $st->execute();

            $fila = $st->fetch();

            parent::desconectar($conexion);

            if ($fila) {
                return new Usuario($fila);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallada: " . $e->getMessage());
        }
    }

    public static function obtenerUsuarioByMail($email)
    {
        $conexion = parent::conectar();

        $sql = "SELECT * FROM " . TABLA_USUARIOS . " WHERE Mail = :email";

        try {
            $st = $conexion->prepare($sql);
            $st->bindValue(":email", $email, PDO::PARAM_STR);
            $st->execute();

            $fila = $st->fetch();

            parent::desconectar($conexion);

            if ($fila) {
                return new Usuario($fila);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallada: " . $e->getMessage());
        }
    }

    public static function modificarUsuario($id, $email, $nombre, $apellidos, $nacimiento, $news)
    {
        $conexion = parent::conectar();

        $sql = "UPDATE " . TABLA_USUARIOS . " SET Mail = :email, Nombre = :nombre, Apellido = :apellidos,
            Fecha_de_nacimiento = :nacimiento, Newsletter = :news WHERE ID = :id";

        try {
            $st = $conexion->prepare($sql);
            $st->bindParam(':id', $id, PDO::PARAM_INT);
            $st->bindParam(':email', $email, PDO::PARAM_STR);
            $st->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $st->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
            $st->bindParam(':nacimiento', $nacimiento, PDO::PARAM_STR);
            $st->bindParam(':news', $news, PDO::PARAM_INT);
            $st->execute();

            parent::desconectar($conexion);

            return true;
        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallada: " . $e->getMessage());
        }
    }

    public static function insertarUsuario($email, $nombre, $apellidos, $nacimiento, $contra, $news)
    {
        $conexion = parent::conectar();

        // Convierto la constraseña a un hash seguro para que no esté almacenada en texto plano
        $contraseña_hash = password_hash($contra, PASSWORD_DEFAULT);

        $sql = "INSERT INTO " . TABLA_USUARIOS . " (Nombre, Apellido, Fecha_de_nacimiento, Newsletter,
                Mail, Contrasenia) VALUES (:nombre, :apellidos, :nacimiento, :news, :email, :contra)";

        try {
            $st = $conexion->prepare($sql);
            $st->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $st->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
            $st->bindParam(':nacimiento', $nacimiento, PDO::PARAM_STR);
            $st->bindParam(':contra', $contraseña_hash, PDO::PARAM_STR);
            $st->bindParam(':news', $news, PDO::PARAM_INT);
            $st->bindParam(':email', $email, PDO::PARAM_STR);
            $st->execute();

            $fila = $st->fetch();

            parent::desconectar($conexion);

            if ($fila)
                return new Usuario($fila);
        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallada: " . $e->getMessage());
        }
    }
}