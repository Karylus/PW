<?php
require_once("datosObject.php");

class Libro extends DataObject
{
    protected $datos = array(
        "isbn" => "",
        "titulo" => "",
        "autor" => "",
        "editorial" => "",
        "numPaginas" => "",
        "anio" => ""
    );

    public static function obtenerLibros($filaInicio, $numeroFilas, $orden)
    {
        $conexion = parent::conectar();

        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_LIBROS .
            " ORDER BY " . $orden . " LIMIT :filaInicio, :numeroFilas";

        try {
            $st = $conexion->prepare($sql);

            $st->bindValue(":filaInicio", $filaInicio, PDO::PARAM_INT);
            $st->bindValue(":numeroFilas", $numeroFilas, PDO::PARAM_INT);
            $st->execute();

            $libros = array();

            foreach ($st->fetchAll() as $fila) {
                $libros[] = new Libro($fila);
            }

            $st = $conexion->query("SELECT found_rows() AS filasTotales");

            $fila = $st->fetch();

            parent::desconectar($conexion);

            return array($libros, $fila["filasTotales"]);
        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallida: " . $e->getMessage());
        }
    }

    public static function obtenerLibro($isbn)
    {
        $conexion = parent::conectar();

        $sql = "SELECT * FROM " . TABLA_LIBROS . " WHERE isbn = :isbn";

        try {
            $st = $conexion->prepare($sql);
            $st->bindValue(":isbn", $isbn, PDO::PARAM_INT);
            $st->execute();

            $fila = $st->fetch();

            parent::desconectar($conexion);

            if ($fila)
                return new Libro($fila);
        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallada: " . $e->getMessage());
        }
    }

    public static function modificarLibro($isbn, $titulo, $autor, $edito, $pag, $year)
    {
        $conexion = parent::conectar();

        $sql = "UPDATE " . TABLA_LIBROS . " SET titulo = :titulo, autor = :autor, editorial = :edito, numPaginas = :pag, anio = :year WHERE isbn = :isbn";

        try {
            $st = $conexion->prepare($sql);
            $st->bindParam(':isbn', $isbn, PDO::PARAM_INT);
            $st->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $st->bindParam(':autor', $autor, PDO::PARAM_STR);
            $st->bindParam(':edito', $edito, PDO::PARAM_STR);
            $st->bindParam(':pag', $pag, PDO::PARAM_INT);
            $st->bindParam(':year', $year, PDO::PARAM_INT);
            $st->execute();

            parent::desconectar($conexion);

            return true;
        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallada: " . $e->getMessage());
        }
    }

    public static function eliminarLibro($isbn)
    {
        $conexion = parent::conectar();

        $sql = "DELETE FROM " . TABLA_LIBROS . " WHERE isbn = :isbn";

        try {
            $st = $conexion->prepare($sql);
            $st->bindValue(":isbn", $isbn, PDO::PARAM_INT);
            $st->execute();

            parent::desconectar($conexion);

            return true;
        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallada: " . $e->getMessage());
        }
    }

    public static function insertarLibro($isbn, $titulo, $autor, $edito, $pag, $year)
    {
        $conexion = parent::conectar();

        $sql = "INSERT INTO " . TABLA_LIBROS . " (isbn, titulo, autor, editorial, numPaginas, anio) 
                VALUES (:isbn, :titulo, :autor, :edito, :pag, :year)";

        try {
            $st = $conexion->prepare($sql);
            $st->bindParam(':isbn', $isbn, PDO::PARAM_INT);
            $st->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $st->bindParam(':autor', $autor, PDO::PARAM_STR);
            $st->bindParam(':edito', $edito, PDO::PARAM_STR);
            $st->bindParam(':pag', $pag, PDO::PARAM_INT);
            $st->bindParam(':year', $year, PDO::PARAM_INT);
            $st->execute();

            $fila = $st->fetch();

            parent::desconectar($conexion);

            if ($fila)
                return new Libro($fila);
        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallada: " . $e->getMessage());
        }
    }
}
