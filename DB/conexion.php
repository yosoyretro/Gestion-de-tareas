<?php 

Class Conexion
{
    protected $usuario;
    protected $clave;
    protected $base_dato;
    protected $servidor;

    public function __construct(string $usuario,string $clave,string $base_dato,string $servidor="127.0.0.1")
    {
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->base_dato = $base_dato;
        $this->servidor = $servidor;            
    }

    public function conectar()
    {
        try{
            $connexion = new PDO("mysql:host=".$this->servidor.";dbname=" . $this->base_dato , $this->usuario,$this->clave);
            $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $connexion;
        }catch(Exception $e){
            return false;
        }
    }

}

?>