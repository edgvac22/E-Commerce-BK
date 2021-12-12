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

<!-- Header -->

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

    <!-- Carousel -->

  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
        <img src="img/bk-1.jpg" alt="Background first">
        <div class="container">
          <div class="carousel-caption text-start">
            <h1>Las mejores hamburguesas</h1>
            <p>Encuentra una gran variedad en un solo lugar y al mejor precio.</p>
            <p><a class="btn btn-lg btn-primary" href="productos.php">Ver productos</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
        <img src="img/bk-2.jpg" alt="Background 2nd">
        <div class="container">
          <div class="carousel-caption">
            <h1>¿Quiéres contactarnos?</h1>
            <p>Nada es tan fácil, como enviarnos un mensaje, solo dale click al botón.</p>
            <p><a class="btn btn-lg btn-primary" href="contacto.php">Contáctanos</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
        <img src="img/bk-3.png" alt="background third">
        <div class="container">
          <div class="carousel-caption text-end">
            <h1>¿Quieres ver actualizaciones de tu pedido?</h1>
            <p>Ahora con la nueva funcionalidad, podrás verlo de una manera muy sencilla.</p>
            <p><a class="btn btn-lg btn-primary" href="mi-cuenta.php">Click Aquí</a></p>
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

    <!-- Servicios -->

    <div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <div class="row">
      <div class="col-lg-4">
        <img src="img/compras-online.png" alt="Envío gratis" class="bd-placeholder-img rounded-circle" width="140" height="140">
        <h2>Compras Online</h2>
        <p>Podrás comprar cualquier comida desde tu casa u oficina. En tan solo pocos pasos, ya podrá tener su pedido listo.</p>
        <p><a class="btn btn-secondary" href="productos.php">Ver más detalles &raquo;</a></p>
      </div>
      
      <div class="col-lg-4">
      <img src="img/delivery.png" alt="Envío gratis" class="bd-placeholder-img rounded-circle" width="140" height="140">
        <h2>Envío gratis</h2>
        <p>Una vez procesado su pedido, procederemos a realizarle la entrega. Solo tendrá que pagar por su comida.</p>
        <p><a class="btn btn-secondary" href="productos.php">Ver más detalles &raquo;</a></p>
      </div>
      <div class="col-lg-4">
        <img src="img/garantia.png" alt="Garantia" class="bd-placeholder-img rounded-circle" width="140" height="140">
        <h2>Garantía</h2>
        <p>Todas nuestras comidas están hechas por los mejores chefs, y al mejor precio del mercado. ¿Qué estas esperando?</p>
        <p><a class="btn btn-secondary" href="productos.php">Ver más detalles &raquo;</a></p>
      </div>
    </div>

    <!-- Footer -->
    <hr class="featurette-divider">
    <footer class="container">
    <p class="float-end"><a href="inicio.php">Regresar al inicio</a></p>
    <p>&copy; Edgardo Vaca - 2021 &middot; <a href="politicas.php">Políticas</a> &middot; <a href="condiciones.php">Condiciones</a></p>
  </footer>
</main>

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