<?php
require_once "../Models/Asignacion.php";
session_start();
$id_tarea = $_GET["tarea"];
$obj_asignacion = new Asignacion;
$response_asignacion = $obj_asignacion->deleteAsignacionByIdTarea($id_tarea);
var_dump($response_asignacion);
$_SESSION["modulo_asignacion"]["mensaje"] = $response_asignacion["mensaje"];
$_SESSION["modulo_asignacion"]["green"] = $response_asignacion["mensaje"];
$_SESSION["modulo_asignacion"]["timestamp"] = time();
header("Location:../Asignaciones/index.php");
