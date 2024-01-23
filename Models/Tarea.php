<?php
require_once "../DB/conexion.php";

class Tarea
{

    protected $conexion_obj;

    public function __construct()
    {
        $this->conexion_obj = new Conexion("root", "", "proyecto_php");
    }

    public function createTarea(string $titulo, string $descripcion,string $fecha_Vencimiento, int $id_estado_tarea)
    {
        try {
            $sql = "INSERT INTO Tarea (Titulo, Descripcion, FechaVencimiento, EstadoID) VALUES (:titulo, :descripcion, :fecha_vencimiento, :id_estado_tarea)";
            $var_con = $this->conexion_obj->conectar();
            $resultado = $var_con->prepare($sql);
            $resultado->bindParam(":titulo", $titulo, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_vencimiento", $fecha_Vencimiento, PDO::PARAM_STR);
            $resultado->bindParam(":id_estado_tarea", $id_estado_tarea, PDO::PARAM_INT);
            $resultado->execute();
            $id_insertado = $var_con->lastInsertId();

            return [
                "ok" => true,
                "mensaje" => "Tarea creada con exito",
                "id_tarea" => $id_insertado
            ];
        } catch (Exception $e) {
            return [
                "ok" => false,
                "error" => $e->getCode(),
                "linea" => $e->getLine(),
                "mensaje" => $e->getMessage()
            ];
        }
    }
}
