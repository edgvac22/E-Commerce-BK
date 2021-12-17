<?php
session_start();

if(isset($_REQUEST['nombre']) && isset($_REQUEST['correo']) && isset($_REQUEST['contra'])) {
    $nombre = $_REQUEST['nombre'];
    $correo = $_REQUEST['correo'];
    $contra = $_REQUEST['contra'];
    
    $salt = substr($correo, 0,2);
    $clave_crypt = crypt ($contra, $salt);

    require_once("class/registro.php");

    $obj_crear = new registro();
    $crear_registro = $obj_crear->crear_registro($nombre, $correo, $clave_crypt);
    
    if (is_array($crear_registro) || is_object($crear_registro)) {
      foreach($crear_registro as $array_resp){
        foreach($array_resp as $value){
            $nfilas=$value;
        }
  }
  if($nfilas > 0){
    header('Location: login.html');
  }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/signin.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <meta name="theme-color" content="#7952b3">
</head>
<body class="text-center">
<main class="form-signin">
  <form action="registro.php" method="post" name="registro">
    <img class="mb-4" src="img/logo.png" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Registro</h1>


    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" placeholder="Nombre + Apellido" name="nombre">
      <label for="floatingInput">Nombre completo</label>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="nombre@ejemplo.com" name="correo">
      <label for="floatingInput">Correo electrónico</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Contraseña" name="contra">
      <label for="floatingPassword">Contraseña</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Crear cuenta</button>
    <p class="para">¿Ya tienes cuenta? <a href="login.html" class="link-primary">Inicia sesión</a></p>
    <p class="mt-5 mb-3 text-muted">&copy; Edgardo - 2021</p>
  </form>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
