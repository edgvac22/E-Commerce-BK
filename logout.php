<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar sesión</title>
</head>
<body>
    <?php
        if (isset($_SESSION["iniciar_sesion"])) {
            session_destroy();
            print("<br><br><p align='center'>Conexión finalizada</p>\n");
            print("<p align='center'>[ <a href='login.html'>Iniciar sesión</a>]</p>\n");
        } else {
            print ("<br><br>\n");
            print ("<p align='center'>No existe una conexión activa</p>\n");
            print ("<p align='center'>[ <a href='login.html'>Iniciar sesión</a>]</p>\n");
        }
    ?>
</body>
</html>