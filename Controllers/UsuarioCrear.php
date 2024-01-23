<?php
session_start();
try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include "../Models/Usuario.php";
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $email = $_POST["email"];
        $clave = $_POST["clave"];
        $nombres_apellidos = strtoupper($nombres . " " . $apellidos);
        $obj_cone = new Usuario();
        $validacion = $obj_cone->createUser($nombres_apellidos, $email, $clave);
        $_SESSION["modulo_usuario"] = [
            "ok" => $validacion["ok"], 
            "mensaje" =>$validacion["mensaje"],
            "tipo" => "positive",
            "timestamp" => time()
        ];

        $_SESSION["mensaje"] = "usuariio";
        header("Location: ../Usuario/index.php");
    }
} catch (Exception $e) {
    $_SESSION["mensaje"] = $e->getMessage();
    echo $e->getLine();
    echo $e->getCode();
    echo $e->getMessage();
}

