<?php
session_start();
require "../Models/Tarea.php";
require "../Models/Asignacion.php";

$obj_asignacion = new Asignacion();
$nombre_tarea = $_POST["nombre_tarea"];
$descripcion  = $_POST["descripcion"];
$fecha_termina = $_POST["fecha_vencimiento"];
$id_usuario = $_POST["usuario"];
$id_estado_tarea = $_POST["estado_tarea"];
$obj = new Tarea();
$response = $obj->createTarea($nombre_tarea,$descripcion,$fecha_termina,intval($id_estado_tarea));
// var_dump($response);
//var_dump($response["id_tarea"]);
$response_asignacion = $obj_asignacion->createAsignacion($_SESSION["login"][0]["data"]["id"],$id_usuario,$response["id_tarea"]);
$_SESSION["modulo_asignacion"]["mensaje"] = $response_asignacion["mensaje"];
$_SESSION["modulo_asignacion"]["green"] = $response_asignacion["mensaje"];
$_SESSION["modulo_asignacion"]["timestamp"] = time();

header("Location: ../Asignaciones/index.php");