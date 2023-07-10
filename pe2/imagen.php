<?php
require_once("datosObject.inc.php");

class Imagen extends DataObject
{
    protected $datos = array(
        "ID" => "",
        "Imagen" => ""
    );

    public static function obtenerImagen($id)
    {
        $conexion = parent::conectar();

        $sql = "SELECT * FROM " . TABLA_IMAGENES . " WHERE ID = :id";

        try {
            $st = $conexion->prepare($sql);
            $st->bindValue(":id", $id, PDO::PARAM_INT);
            $st->execute();

            $fila = $st->fetch();

            parent::desconectar($conexion);

            if ($fila) {
                return new Imagen($fila);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            parent::desconectar($conexion);

            die("Consulta fallada: " . $e->getMessage());
        }
    }

    public static function obtenerTodas()
    {
        $conexion = parent::conectar();

        $sql = "SELECT * FROM " . TABLA_IMAGENES . " ORDER BY ID ASC";

        try {
            $st = $conexion->prepare($sql);
            $st->execute();

            $filas = $st->fetchAll(PDO::FETCH_ASSOC);

            $imagenes = array();
            foreach ($filas as $fila) {
                $imagenes[] = new Imagen($fila);
            }

            parent::desconectar($conexion);

            return $imagenes;
        } catch (PDOException $e) {
            parent::desconectar($conexion);
            die("Consulta fallada: " . $e->getMessage());
        }
    }
}