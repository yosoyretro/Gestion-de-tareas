<?php
require "../aside.php";

?>
<div class="pusher">
    <div class="ui basic segment">

        <div class="ui feed" <div class="ui header">
            <h3 class="ui header">Mantenimientos de Asignaciones</h3>
            <div class="content">
                <div class="ui breadcrumb">
                    <a class="section" href="/proyecto/inicio.php"><i class="home icon"></i>Inicio</a>
                    <div class="divider"> / </div>
                    <div class="active section">Mantenimientos <a href="#">Asignaciones</a></div>
                    <div class="ui fluid container">
                        <div class="ui basic segment">
                            <button class="ui primary button" data-target="#crearAsignacionoModal"><i class="plus circle icon"></i>Crear Asignacion</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<!--ABRIR MODAL-->
<div class="ui modal small" id="crearAsignacionoModal">
    <div class="header"><i class="user plus icon"></i>Crear Asignacion</div>
    <div class="content">
        <form action="../Controllers/CrearAsignaciones.php" method="POST" class="ui form">
            <div class="field">
                <label for="">Ingrese el titulo de la tarea</label>
                <div class="field">
                    <input type="text" name="nombre_tarea" placeholder="Nombre de la tarea">
                </div>
            </div>
            <div class="field">
                <label for="">Ingrese la descripcion de la tarea</label>
                <textarea type="text" name="descripcion" placeholder="Descripcion de la tarea"></textarea>
            </div>
            <div class="field">
                <label for="">Fecha de vencimiento</label>
                <input type="date" name="fecha_vencimiento" placeholder="fecha de vencimiento"></input>
            </div>
            <div class="field">
                <label for="">Selecione el estado de la tarea</label>

                <select name="estado_tarea">
                    <option default>Selecione el estado de la tarea</option>
                    <?php
                    require_once "../Models/EstadoTarea.php";

                    $obj = new EstadoTarea();
                    $variable = $obj->getEstadoTarea();
                    foreach ($variable["data"] as $registro) {
                        echo "<option value='" . $registro["ID"] . "'>" . $registro["Nombre"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="field">
                <label for="">Selecione al usuario que se le va a asignar la tarea</label>
                <select name="usuario">
                    <option default>Selecione al usuario de la asignacion</option>
                    <?php
                    include "../Models/Usuario.php";
                    $obj_usuario = new Usuario();
                    $modelo = $obj_usuario->getAllUser();
                    foreach ($modelo["data"] as $registro) {
                        echo '
                                <option value="' . $registro["ID"] . '">' . $registro["nombres"] . '</option>            
                            ';
                    }
                    ?>
                </select>
                <div id="mensajeValidacion" style="color: red;"></div>
            </div>
            <div class="actions">
                <button type="submit" class="ui primary button"><i class="save icon"></i> Guardar</button>
                <div class="ui cancel button"><i class="close icon"></i> Cancelar</div>
            </div>
        </form>
    </div>


    <script src="index.js"></script>