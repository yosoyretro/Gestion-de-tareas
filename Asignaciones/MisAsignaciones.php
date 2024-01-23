<?php
require "../aside.php";
session_start();
?>
<div class="pusher">
    <div class="ui basic segment">
        <div class="ui feed">
            <h3 class="ui header">Mis Asignaciones</h3>
            <div class="content">
                <div class="ui breadcrumb">
                    <a class="section" href="/proyecto/inicio.php"><i class="home icon"></i>Inicio</a>
                    <div class="divider"> / </div>
                    <a href="#">Asignaciones</a>
                </div>

            </div>
        </div>

        <div class="ui container special cards">
            <?php
            include "../Models/Asignacion.php";
            $obj_asignacion = new Asignacion();
            $data = $obj_asignacion->getAsignacionesById($_SESSION["login"][0]["data"]["id"], 1);
            //var_dump($data);
            foreach ($data["data"] as $registro) {
                echo '
                        <div class="card">
                            <div class="content">
                                <a class="header">' . $registro["Titulo"] . '</a>
                                
                            </div>
                            <div class="content">
                            <div class="meta">
                                    <span class="date">' . $registro["usuario_asignador"] . '</span>
                                </div>
                                <div class="meta">
                                    <span class="date">Estado tarea : ' . $registro["Nombre"] . '</span>
                                </div>
                                <div class="meta">
                                    <span class="date">Fecha de vencimiento : ' . $registro["FechaVencimiento"] . '</span>
                                </div>
                                ' . $registro["Descripcion"] . '
                            </div>
                            <div class="extra content">
                                <div class="ui buttons">
                                    <button class="ui button primary" abrir-modal-id=' . $registro["id_asignacion"] . '>Editar Asignacion</button>
                                    <button class="ui button positive">Ver historial </button>
                                </div>
                            </div>
                        </div>
                ';
            }
            ?>

        </div>

    </div>
</div>

<div class="ui modal" id="modal-0">
    <!-- Contenido del modal -->
</div>
