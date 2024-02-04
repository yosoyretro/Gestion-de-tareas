<?php
session_start();
try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["usuario"])  && isset($_POST["clave"])) {

            include("../Models/Usuario.php");
            $obj_usuario = new Usuario();
            $autenticacion = $obj_usuario->autenticacion($_POST["usuario"], $_POST["clave"]);
            if ($autenticacion["ok"]) {
                $_SESSION["login"] = [
                    [
                        "data" => [
                            "id" => $autenticacion["data"]["ID"],
                            "nombres" => $autenticacion["data"]["nombres"]
                        ]
                    ]
                ];
                $_SESSION["login"]["ok"] = true;
                header("Location: ../inicio.php");
            } else {
                if ($_POST["usuario"] == "" || $_POST["clave"] == "") {
                    $_SESSION["login"]["mensaje"] = "Los campos no pueden estar vacios";
                } else {
                    $_SESSION["login"]["mensaje"] = $autenticacion["mensaje"];
                }
                header("Location: ../index.php");
            }
        }
    } else {
        header("Location: ../");
    }
} catch (Exception $e) {
    echo "A ocurrido un error ";
    echo $e->getMessage();
}
