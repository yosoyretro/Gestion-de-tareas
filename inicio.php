<?php
session_start();
include("aside.php");

?>
<div class="pusher">
    <div class="ui basic segment">
        <h3 class="ui header">BIENVENIDO <?php echo $_SESSION["login"][0]["data"]["nombres"]  ?></h3>
        <div class="ui container" style="padding-bottom: 15px;">

            <div class="ui breadcrumb">
                <a class="section" href="/proyecto/inicio.php"><i class="home icon"></i>Inicio</a>
            </div>

        </div>

        <div class="ui container">
            <div class="ui container center aligned cards">

                <div class="card" style="margin-left: 50px;">
                    <div class="content">
                        <div class="header">Usuarios Registrador</div>
                        <div class="ui statistic">
                            <div class="value">
                                <i class="users icon"></i>
                                <?php
                                    include "Models/Usuario.php";
                                    $obj_usuario = new Usuario();
                                    $data = $obj_usuario->getAllUser()["data"];
                                    echo count($data);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="content">
                        <div class="header">Total Tareas</div>
                        <div class="ui statistic">
                            <div class="value">
                                <i class="tasks icon"></i>
                                5
                            </div>
                        </div>
                    </div>
                </div </div>

                <div class="container">
                    <?php
                    require_once "Models/Asignacion.php";
                    $obj = new Asignacion();
                    //var_dump($_SESSION["login"][0]["data"]["id"]);
                    $servicio = $obj->getAsignacionesById($_SESSION["login"][0]["data"]["id"], 1);
                    foreach ($servicio["data"] as $registro) {
                        echo '
                    <div class="ui feed">
                        <div class="event">
                        <div class="label">
                            <a><i class="bell icon"></i></a>
                        </div>
                        <div class="content">
                            <div class="summary">
                                <a>' . $registro["usuario_asignador"] . '</a> Te asigno una tarea
                                <div class="date">
                                    fecha de vencimiento ' . $registro["FechaVencimiento"] . '
                                </div>
                            </div>
                            <div class="extra text">
                                ' . $registro["Titulo"] . '
                            </div>  
                        </div>
                        </div>
                    </div>
                        ';
                    }
                    ?>
                </div>
            </div>


        </div>
    </div>