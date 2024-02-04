<?php
session_start();
require_once "../Models/Tarea.php";
require_once "../Models/Comentarios.php";
require_once "../Models/Asignacion.php";
try {
    $obj_tarea = new Tarea();
    $obj_asignacion = new Asignacion();
    $titulo = $_POST["nombre_tarea"];
    $descripcion = $_POST["descripcion"];
    $fecha_vencimiento = $_POST["fecha_vencimiento"];
    $id_estado = intval($_POST["estado_tarea"]);
    $id_usuario = intval($_POST["usuario"]);
    $comentario = $_POST["comentario"] ?? null;
    $id_tarea = $_GET["tarea"];
    $response_tarea = $obj_tarea->updateTareaById($id_tarea, $titulo, $descripcion, $fecha_vencimiento, $id_estado);

    if ($comentario) {
        $obj_comentario = new Comentarios();
        $response_comentario = $obj_comentario->createComentario($_SESSION["login"][0]["data"]["id"], $id_tarea, $comentario);
    }

    if (intval($_GET["redirect"]) == 1) {
        $response_asignacion = $obj_asignacion->updateAsignacionByIdTarea($id_tarea, $id_usuario);
        $_SESSION["modulo_asignacion"]["mensaje"] = $response_asignacion["mensaje"];
        $_SESSION["modulo_asignacion"]["green"] = $response_asignacion["mensaje"];
        $_SESSION["modulo_asignacion"]["timestamp"] = time();
        header("Location: ../Asignaciones/index.php");
    }
    if (intval($_GET["redirect"]) == 2) {
        header("Location: ../Asignaciones/MisAsignaciones.php");
    }
} catch (Exception $e) {
    var_dump($e->getMessage());
}
