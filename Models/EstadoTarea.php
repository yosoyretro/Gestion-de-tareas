<?php
require_once "../DB/conexion.php";

class EstadoTarea
{
    protected $conexion_obj;
    public function __construct()
    {
        $this->conexion_obj = new Conexion("root", "", "proyecto_php");
    }

    public function getEstadoTarea()
    {
        try{
            $query = "select * from EstadoTarea";
            $var_const  = $this->conexion_obj->conectar();
            $consulta = $var_const->prepare($query);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return [
                "ok" => true,
                "data" => $resultado,
                "mensaje" => "Estado de tareas obtenido con exito"
            ];
        }catch(Exception $e){
            return [
                "ok" => false,
                "mensaje" => $e->getMessage(),
                "error" => $e->getCode()
            ];
        }
    }
}
