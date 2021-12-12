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
    <title>Inicio</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- CSS Interno + icon + theme color -->
    <link href="css/inicio.css" rel="stylesheet">
    <link href="css/carusel.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <meta name="theme-color" content="#7952b3">
</head>
<body>
<?php
if (isset($_SESSION["iniciar_sesion"])) {
    ?>

<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <a href="inicio.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
      <img src="img/logo.png" alt="" width="40" height="32">  
      </a>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="inicio.php" class="nav-link px-2 link-secondary">Inicio</a></li>
        <li><a href="contacto.php" class="nav-link px-2 link-dark">Contacto</a></li>
        <li><a href="quienes-somos.php" class="nav-link px-2 link-dark">¿Quiénes somos?</a></li>
        <li><a href="productos.php" class="nav-link px-2 link-dark">Productos</a></li>
        <!-- <li><a href="#" class="nav-link px-2 link-dark">Preguntas frecuentes</a></li> -->
      </ul>

      <div class="col-md-3 text-end">
      <a href="mi-cuenta.php">
        <button type="button" class="btn btn-outline-primary me-2">Mi cuenta</button>
      </a>  
      
      <a href="cart.php">
        <button type="button" class="btn btn-primary">Ver carrito</button>
    </a>

        

      </div>
    </header>
  </div>

  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>

        <div class="container">
          <div class="carousel-caption text-start">
            <h1>Example headline.</h1>
            <p>Some representative placeholder content for the first slide of the carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>

        <div class="container">
          <div class="carousel-caption">
            <h1>Another example headline.</h1>
            <p>Some representative placeholder content for the second slide of the carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>

        <div class="container">
          <div class="carousel-caption text-end">
            <h1>One more for good measure.</h1>
            <p>Some representative placeholder content for the third slide of this carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <footer class="footer mt-auto py-3 bg-light">
  <div class="container">
    <span class="text-muted">&copy; Edgardo - 2021</span>
  </div>
</footer>

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
<!-- Boostrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>