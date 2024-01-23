<?php
session_start();
if (!isset($_SESSION["login"]["ok"])) header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui/dist/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui/dist/semantic.min.js"></script>
</head>

<body>

    <div class="ui visible inverted left vertical sidebar menu">
        <div class="ui text center item">
            <h1>Sistema Gestion de tareas</h1>
        </div>
        <a class="item" href="/proyecto/inicio.php">
            <i class="home icon"></i>
            Inicio
        </a>

        <div class="item" id="mantenimientosDropdown">
            <i class="block layout icon"></i>
            <span class="text">Mantenimientos</span>
            <i class="dropdown icon"></i>
            <div class="menu" style="margin-left: 10px;">
                <a class="item opcion" href="/proyecto/Usuario"><i class="user icon"></i>Usuarios</a>
                <a class="item opcion" href="/proyecto/Asignaciones/"><i class="tasks icon"></i>Asignacion</a>
            </div>
        </div>

        <a class="item" href="/proyecto/Asignaciones/MisAsignaciones.php">
            <i class="calendar icon"></i>
            Mis asignaciones
        </a>

        <a class="item" href="/proyecto/Controllers/cerrarSeccion.php">
            <i class="sign-out icon"></i>
            Salir
        </a>
    </div>

    <script>
        $(document).ready(function() {
            // Inicializa el menú desplegable de Semantic UI
            $('.ui.sidebar').sidebar();

            // Oculta las opciones inicialmente
            $('.opcion').hide();

            // Agrega un evento de clic al enlace "Mantenimientos"
            $('#mantenimientosDropdown').on('click', function() {
                // Muestra u oculta las opciones del menú
                $('.opcion').toggle();
            });

            // Detiene la propagación del evento de clic en los enlaces dentro del menú desplegable
            $('.opcion').on('click', function(event) {
                event.stopPropagation();
            });
        });
    </script>

</body>

</html>