<?php

require_once __DIR__ . "/../DB/conexion.php";

class Asignacion
{

    protected $conexion_obj;

    public function __construct()
    {
        $this->conexion_obj = new Conexion("root", "", "proyecto_php");
    }

    public function createAsignacion(int $id_usuario_asignador, int $usuario_id, int $id_tarea)
    {
        try {
            $sql = "
                insert into Asignacion (UsuarioID,UsuarioIDAsignador,TareaID) values (:usuario_id,:usuario_asignador_id,:tarea_id)
            ";
            $var_con = $this->conexion_obj->conectar();
            $resultado = $var_con->prepare($sql);
            $resultado->bindParam(":usuario_id", $usuario_id, PDO::PARAM_STR);
            $resultado->bindParam(":usuario_asignador_id", $id_usuario_asignador, PDO::PARAM_STR);
            $resultado->bindParam(":tarea_id", $id_tarea, PDO::PARAM_STR);
            $resultado->execute();
            $id_insertado = $var_con->lastInsertId();
            return [
                "ok" => true,
                "mensaje" => "! Asignacion creada con exito !",
                "id" => $id_insertado
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

    public function getAsignacionesById(int $id, int $op)
    {
        try {
            $sql = "";
            switch ($op) {
                case 1:
                    //buscar por el usuario que inicia la sesion para ver sus asignaciones
                    $sql = "
                    SELECT Asignacion.ID as id_asignacion,Usuario2.nombres as usuario_asignador,Usuario1.nombres as usuario_asigna,  
                    Tarea.Titulo,Tarea.FechaVencimiento,
                    Tarea.Descripcion,
                    EstadoTarea.ID,
                    EstadoTarea.Nombre
                    FROM Asignacion 
                    JOIN Usuario as Usuario1 ON Asignacion.UsuarioID = Usuario1.ID 
                    JOIN Usuario as Usuario2 ON Asignacion.UsuarioIDAsignador = Usuario2.ID
                    JOIN Tarea on Asignacion.TareaID = Tarea.ID
                    JOIN EstadoTarea ON Tarea.EstadoID = EstadoTarea.ID
                    where Asignacion.UsuarioID = :id;
                    ";
                    //echo $sql;
                    break;
            }
            $var_con = $this->conexion_obj->conectar();
            $resultado = $var_con->prepare($sql);
            $resultado->bindParam(":id", $id, PDO::PARAM_STR);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return [
                "ok" => true,
                "data" => $data
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

?>