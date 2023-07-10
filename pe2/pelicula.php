<?php
require_once("datosObject.inc.php");
require_once("comentario.php");

class Pelicula extends DataObject
{

    protected $datos = array(
        "ID" => "",
        "Titulo" => "",
        "Director" => "",
        "Genero" => "",
        "Duracion" => "",
        "Sinopsis" => "",
        "Fecha_de_lanzamiento" => "",
        "Actores_principales" => "",
        "ImagenID" => "",
        "Categoria" => ""
    );

    public static function obtenerPelicula($id)
    {
        $conexion = parent::conectar();

        $sql = "SELECT * FROM " . TABLA_PELICULAS . " WHERE ID = :id";

        try {
            $st = $conexion->prepare($sql);
            $st->bindValue(":id", $id, PDO::PARAM_INT);
            $st->execute();

            $fila = $st->fetch();

            parent::desconectar($conexion);

            if ($fila) {
                return new Pelicula($fila);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallada: " . $e->getMessage());
        }
    }

    public static function modificarPelicula(
        $id,
        $titulo,
        $director,
        $genero,
        $duracion,
        $sinopsis,
        $fecha,
        $actores,
        $imagenID,
        $categoria
    ) {
        $conexion = parent::conectar();

        $sql = "UPDATE " . TABLA_PELICULAS . " SET Titulo = :titulo, Director = :director, Genero = :genero, Duracion = :duracion,
        Sinopsis = :sinopsis, Fecha_de_lanzamiento = :fecha, Actores_principales = :actores, ImagenID= :imagenID, Categoria = :categoria  WHERE ID = :id";

        try {
            $st = $conexion->prepare($sql);
            $st->bindParam(':id', $id, PDO::PARAM_INT);
            $st->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $st->bindParam(':director', $director, PDO::PARAM_STR);
            $st->bindParam(':genero', $genero, PDO::PARAM_STR);
            $st->bindParam(':duracion', $duracion, PDO::PARAM_STR);
            $st->bindParam(':sinopsis', $sinopsis, PDO::PARAM_STR);
            $st->bindParam(':fecha', $fecha, PDO::PARAM_STR);
            $st->bindParam(':actores', $actores, PDO::PARAM_STR);
            $st->bindParam(':imagenID', $imagenID, PDO::PARAM_INT);
            $st->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $st->execute();

            $fila = $st->fetch();

            parent::desconectar($conexion);

            if ($fila)
                return new Pelicula($fila);
        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallada: " . $e->getMessage());
        }
    }

    public static function insertarPelicula($titulo, $director, $genero, $duracion, $sinopsis, $fecha, $actores, $imagenID, $categoria)
    {
        $conexion = parent::conectar();

        $sql = "INSERT INTO " . TABLA_PELICULAS . " (Titulo, Director, Genero, Duracion, Sinopsis, Fecha_de_lanzamiento, Actores_principales, ImagenID, Categoria)
            VALUES (:titulo, :director, :genero, :duracion, :sinopsis, :fecha, :actores, :imagenID, :categoria)";

        try {
            $st = $conexion->prepare($sql);
            $st->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $st->bindParam(':director', $director, PDO::PARAM_STR);
            $st->bindParam(':genero', $genero, PDO::PARAM_STR);
            $st->bindParam(':duracion', $duracion, PDO::PARAM_INT);
            $st->bindParam(':sinopsis', $sinopsis, PDO::PARAM_STR);
            $st->bindParam(':fecha', $fecha, PDO::PARAM_STR);
            $st->bindParam(':actores', $actores, PDO::PARAM_STR);
            $st->bindParam(':imagenID', $imagenID, PDO::PARAM_INT);
            $st->bindParam(':categoria', $categoria, PDO::PARAM_STR);

            $st->execute();

            $id = $conexion->lastInsertId();

            parent::desconectar($conexion);

            return $id;
        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallada: " . $e->getMessage());
        }
    }

    public static function eliminarPelicula($id)
    {
        // Elimino los comentarios de la pelicula
        Comentario::eliminarComentariosPelicula($id);

        $conexion = parent::conectar();

        $sql = "DELETE FROM " . TABLA_PELICULAS . " WHERE ID = :id";

        try {
            $st = $conexion->prepare($sql);
            $st->bindValue(":id", $id, PDO::PARAM_INT);
            $st->execute();

            parent::desconectar($conexion);

            return true;
        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallada: " . $e->getMessage());
        }
    }

    public static function obtenerPeliculas()
    {
        $conexion = parent::conectar();

        $sql = "SELECT * FROM " . TABLA_PELICULAS . " ORDER BY ID";

        try {
            $st = $conexion->prepare($sql);
            $st->execute();

            $peliculas = array();

            foreach ($st->fetchAll() as $fila) {
                $peliculas[] = new Pelicula($fila);
            }

            parent::desconectar($conexion);

            return $peliculas;
        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallada: " . $e->getMessage());
        }
    }

    public static function obtenerValoracionMedia($id_pelicula)
    {
        $conexion = parent::conectar();

        $sql = "SELECT AVG(Puntuacion) AS Valoracion_media FROM " . TABLA_COMENTARIOS . " WHERE ID_pelicula = :id_pelicula";

        try {
            $st = $conexion->prepare($sql);
            $st->bindParam(':id_pelicula', $id_pelicula, PDO::PARAM_INT);
            $st->execute();

            $resultado = $st->fetch();
            $valoracionMedia = $resultado['Valoracion_media'];

            parent::desconectar($conexion);

            return round($valoracionMedia, 2);
        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallada: " . $e->getMessage());
        }
    }
}
