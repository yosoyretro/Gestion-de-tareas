<?php
require_once __DIR__ . "/../DB/conexion.php";

class Usuario
{
    protected $conexion_obj;
    
    public function __construct()
    {
        $this->conexion_obj = new Conexion("root", "", "proyecto_php");
    }

    public function autenticacion(string $usuario, string $clave)
    {

        try {
            $var_con = $this->conexion_obj->conectar();
            $consulta = $var_con->prepare("select * from Usuario where Email LIKE :usuario");
            $consulta->bindParam(":usuario", $usuario, PDO::PARAM_STR);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            if (count($resultado) == 0) throw new Exception("El usuario no existe");
            if (count($resultado) >= 2) throw new Exception("Este usuario se reite varias veces eso no puede pasar verifique bien la informacion");
            $data_user = $resultado[0];
            if (!password_verify($clave, $data_user["clave"])) throw new Exception("Contraseña incorrecta");
            return [
                "ok" => true,
                "mensaje" => "Usuario logeado con exito",
                "data" => $data_user
            ];
        } catch (Exception $e) {
            return [
                "ok" => false,
                "mensaje" => $e->getMessage(),
                "error" => $e->getCode(),
            ];
        }
    }

    public function getAllUser()
    {
        try {
            $query = "
                select * from Usuario
            ";
            $var_con = $this->conexion_obj->conectar();
            $consulta = $var_con->prepare($query);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return [
                "ok" => true,
                "mensaje" => "Usuarios Obtenido con exito",
                "data" => $resultado
            ];
        } catch (Exception $e) {
            return [
                "ok" => false,
                "mensaje" => $e->getMessage(),
                "error" => $e->getCode()
            ];
        }
    }

    public function createUser(string $nombres, string $email, string $clave)
    {
        try {
            $query = "
                insert into Usuario (nombres,email,clave) values(:nombres,:email,:clave)
            ";
            $var_con = $this->conexion_obj->conectar();
            $consulta = $var_con->prepare($query);
            $consulta->bindParam(":nombres", $nombres, PDO::PARAM_STR);
            $consulta->bindParam(":email", $email, PDO::PARAM_STR);
            $consulta->bindParam(":clave", password_hash($clave, PASSWORD_BCRYPT), PDO::PARAM_STR);
            $consulta->execute();
            return [
                "ok" => true,
                "mensaje" => "Usuario creado con exito"
            ];
        } catch (Exception $e) {
            return [
                "ok" => false,
                "mensaje" => $e->getMessage(),
                "error" => $e->getCode()
            ];
        }
    }
    
}
