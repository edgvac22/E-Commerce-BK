<?php
session_start();

if(isset($_REQUEST['correo']) && isset($_REQUEST['contra'])) {
    $correo = $_REQUEST['correo'];
    $contra = $_REQUEST['contra'];
    
    $salt = substr($correo, 0,2);
    $clave_crypt = crypt ($contra, $salt);

    require_once("class/usuarios.php");

    $obj_usuarios = new usuarios();
    $iniciar_sesion = $obj_usuarios->iniciar_sesion($correo, $clave_crypt);

    foreach ($iniciar_sesion as $array_resp) {
        foreach ($array_resp as $value) {
            $nfilas = $value;
        }
    }

    if($nfilas > 0) {
        $iniciar_sesion = $correo;
        $_SESSION["iniciar_sesion"] = $iniciar_sesion;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if (isset($_SESSION["iniciar_sesion"])) {
    ?>

    <h1>Bienvenido!</h1>
    <p><a href="logout.php">Cerrar sesión</a></p>

<?php
}

else if (isset ($correo)) {
    print("<br><br>\n");
    print("<p align='center'>Acceso no autorizado</p>\n");
    print("<p align='center'>[ <a href='login.html'>Iniciar sesión</a> ]</p>\n");
} else {
    print("<br><br>\n");
    print("<p align='center'>Favor identificarse!</p>\n");
    print("<p align='center'>[ <a href='login.html'>Iniciar sesión</a> ]</p>\n");
}
?>
</body>
</html>