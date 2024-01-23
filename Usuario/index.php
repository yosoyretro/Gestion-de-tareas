<?php
session_start();
if (isset($_SESSION["modulo_usuario"]) && time() - $_SESSION["modulo_usuario"]["timestamp"] > 3) {
    unset($_SESSION["modulo_usuario"]);
}
include("../aside.php");


?>

<div class="pusher">
    <div class="ui basic segment">
        <div class="ui feed">
            <h3 class="ui header">Mantenimientos de Usuario</h3>
            <div class="content">
                <div class="ui breadcrumb">
                    <a class="section" href="/proyecto/inicio.php"><i class="home icon"></i>Inicio</a>
                    <div class="divider"> / </div>
                    <div class="active section">Mantenimientos <a href="#">Usuarios</a></div>
                    <div class="ui fluid container">
                        <div class="ui basic segment">
                            <button class="ui primary button" data-target="#crearUsuarioModal"><i class="plus circle icon"></i>Crear Usuario</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui container" style="padding-bottom: 15px;">
            <div>
                <?php
                if (isset($_SESSION["modulo_usuario"])) {
                    echo '
                <div class="ui ' . $_SESSION["modulo_usuario"]["tipo"] . ' message">
                    <i class="close icon"></i>
                    <div class="header">
                        ! Operacion realizado con exito !
                    </div>
                    <p>' . $_SESSION["modulo_usuario"]["mensaje"] . '</p>
                </div>';
                }
                ?>

                <table class="ui single table inverted collapsing celled" >
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Nombres y apellidos</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../Models/Usuario.php";
                        $obj = new Usuario();
                        $model_usuario = $obj->getAllUser();
                        $data = $model_usuario["data"];
                        if (count($data) >= 1) {
                            foreach ($data as $contador => $registro) {
                                echo '
                                <tr>
                                <td>' . $contador + 1 . '</td>
                                <td>' . $registro["nombres"] . '</td>
                                <td>' . $registro["email"] . '</td>
                                <td class="center aligned">
                                    <button id="editar-' . $registro["id"] . '" class="ui primary button"><i class="icon edit icon"></i>Editar</button>
                                    <button id="eliminar-' . $registro["id"] . '" class="ui red button delete-button"><i class="icon delete icon"></i>Eliminar</button>
                                </td>
                            </tr>    
                                ';
                            }
                        } else {
                            echo '
                            <tr colspan="4" aling="center">
                                <td>No existen usuario</td>
                            </tr>
                        ';
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<div class="ui modal small" id="crearUsuarioModal">
    <div class="header"><i class="user plus icon"></i>Crear Usuario</div>
    <div class="content">
        <form action="../Controllers/UsuarioCrear.php" method="POST" class="ui form">
            <div class="field">
                <label for="">Ingrese su nombres y apellidos</label>
                <div class="two fields">
                    <div class="field">
                        <input type="text" name="nombres" placeholder="Nombres completos">
                    </div>
                    <div class="field">
                        <input type="text" name="apellidos" placeholder="Apellidos completos">
                    </div>
                </div>
            </div>
            <div class="field">
                <label for="">Ingrese su correo</label>
                <div class="field">
                    <input type="text" name="email"></input>
                </div>
            </div>
            <div class="field">
                <label for="">Ingrese la clave</label>
                <div class="two fields">
                    <div class="field">
                        <input type="password" id="clave" name="clave" placeholder="Clave">
                    </div>
                    <div class="field">
                        <input type="password" id="clave_verify" name="shipping[clave_verify]" placeholder="confirme su contraseña">
                    </div>
                </div>
                <div id="mensajeValidacion" style="color: red;"></div>
            </div>
            <div class="actions">
                <button type="submit" class="ui primary button"><i class="save icon"></i> Guardar</button>
                <div class="ui cancel button"><i class="close icon"></i> Cancelar</div>
            </div>
        </form>
    </div>

</div>


<script src="index.js"></script>