<?php
require_once("datosObject.inc.php");

class Comentario extends DataObject
{
    protected $datos = array(
        "ID" => "",
        "ID_usuario" => "",
        "ID_pelicula" => "",
        "Comentario" => "",
        "Puntuacion" => "",
        "Fecha_de_publicacion" => ""
    );

    public static function obtenerComentariosPelicula($id_pelicula)
    {
        $conexion = parent::conectar();

        $sql = "SELECT * FROM " . TABLA_COMENTARIOS . " WHERE ID_pelicula = :id_pelicula ORDER BY Fecha_de_publicacion";

        try {
            $st = $conexion->prepare($sql);
            $st->bindParam(':id_pelicula', $id_pelicula, PDO::PARAM_INT);
            $st->execute();

            $comentarios = array();

            foreach ($st->fetchAll() as $fila) {
                $comentarios[] = new Comentario($fila);
            }

            parent::desconectar($conexion);

            return $comentarios;
        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallada: " . $e->getMessage());
        }
    }

    public static function insertarComentario($id_pelicula, $id_usuario, $comentario, $puntuacion, $fecha)
    {
        $conexion = parent::conectar();

        $sql = "INSERT INTO " . TABLA_COMENTARIOS . " (ID_pelicula, ID_usuario, Comentario, Puntuacion, Fecha_de_publicacion)
            VALUES (:id_pelicula, :id_usuario, :comentario, :puntuacion, :fecha)";

        try {
            $st = $conexion->prepare($sql);
            $st->bindParam(':id_pelicula', $id_pelicula, PDO::PARAM_INT);
            $st->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $st->bindParam(':comentario', $comentario, PDO::PARAM_STR);
            $st->bindParam(':puntuacion', $puntuacion, PDO::PARAM_INT);
            $st->bindParam(':fecha', $fecha, PDO::PARAM_STR);
            $st->execute();

            $fila = $st->fetch();

            parent::desconectar($conexion);

            if ($fila)
                return new Comentario($fila);

        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallada: " . $e->getMessage());
        }
    }

    public static function eliminarComentariosPelicula($id_pelicula)
    {
        $conexion = parent::conectar();

        $sql = "DELETE FROM " . TABLA_COMENTARIOS . " WHERE ID_pelicula = :id_pelicula";

        try {
            $st = $conexion->prepare($sql);
            $st->bindParam(':id_pelicula', $id_pelicula, PDO::PARAM_INT);
            $st->execute();

            parent::desconectar($conexion);

        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallada: " . $e->getMessage());
        }
    }
}