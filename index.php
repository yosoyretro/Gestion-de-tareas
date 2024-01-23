<?php
session_start();

if(isset($_SESSION["login"]["ok"])){
    header("Location: inicio.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui/dist/semantic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui/dist/semantic.min.js"></script>
</head>

<body style="background-image: url('public/img/fondo.jpg');display:flex;align-items:center;">
    <div class="ui centered aligned stackable card" style="width:500px">
        <div class="content">
            <h1>Login</h1>
            <div>
                <form class="ui form" action="Controllers/Autenticacion.php" method="POST">
                    <div class="field">
                        <label for="">Ingrese su usuario</label>
                        <div class="ui fluid icon input">
                            <input type="email" name="usuario" require>
                            <i class="user icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label for="">Ingrese su clave</label>
                        <div class="ui fluid icon input">
                            <input type="password" name="clave" require>
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <Button class="fluid ui red button" type="submit"><i class="sign-in icon"></i>Iniciar</Button>

                </form>
                <?php
                if (isset($_SESSION["login"]["mensaje"])) {
                    echo '<div class="ui negative message">
                    <i class="close icon"></i>
                    <div class="header">
                    ! A ocurrido un error !
                    </div>
                    <p>' . $_SESSION["login"]["mensaje"] . '</p>
                </div>';
                }
                ?>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.message .close').on('click', function() {
                $(this).closest('.message').transition('fade');
            });
        });
    </script>

</body>

</html>