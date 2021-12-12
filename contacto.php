<?php

session_start();

if (isset($_SESSION["iniciar_sesion"])) {
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

    <!-- Contact Form -->

    <!-- Wrapper container -->
<div class="container py-4">

<!-- Bootstrap 5 starter form -->
<form id="contactForm" method="post" action="enviar-email.php">

  <!-- Name input -->
  <div class="mb-3">
    <label class="form-label" for="name">Nombre</label>
    <input class="form-control" id="name" type="text" placeholder="Nombre" data-sb-validations="required" name="nombre" />
    <div class="invalid-feedback" data-sb-feedback="name:required">Su nombre es requerido.</div>
  </div>

  <!-- Email address input -->
  <div class="mb-3">
    <label class="form-label" for="emailAddress">Correo electrónico</label>
    <input name="correo" class="form-control" id="emailAddress" type="email" placeholder="Correo electrónico" data-sb-validations="required, email" />
    <div class="invalid-feedback" data-sb-feedback="emailAddress:required">El correo electrónico es requerido.</div>
    <div class="invalid-feedback" data-sb-feedback="emailAddress:email">Favor colocar un formato válido.</div>
  </div>

  <!-- Subject input -->

  <div class="mb-3">
    <label class="form-label" for="subject">Asunto</label>
    <input class="form-control" id="name" type="text" placeholder="Asunto" data-sb-validations="required" name="asunto" />
    <div class="invalid-feedback" data-sb-feedback="subject:required">El asunto es requerido.</div>
  </div>

  <!-- Message input -->
  <div class="mb-3">
    <label class="form-label" for="message">Mensaje</label>
    <textarea name="mensaje" class="form-control" id="message" type="text" placeholder="Mensaje" style="height: 10rem;" data-sb-validations="required"></textarea>
    <div class="invalid-feedback" data-sb-feedback="message:required">Los mensajes son requeridos.</div>
  </div>

  <!-- Form submissions success message -->
  <div class="d-none" id="submitSuccessMessage">
    <div class="text-center mb-3">Mensaje enviado satisfactoriamente!</div>
  </div>

  <!-- Form submissions error message -->
  <div class="d-none" id="submitErrorMessage">
    <div class="text-center text-danger mb-3">Error al enviar dicho mensaje!</div>
  </div>

  <!-- Form submit button -->
  <div class="d-grid">
    <button type="submit" name="enviar" class="btn btn-primary btn-lg" id="submitButton">Enviar</button>
  </div>

</form>

</div>

  <!-- Footer -->
  <hr class="featurette-divider">
    <footer class="container">
    <p class="float-end"><a href="inicio.php">Regresar al inicio</a></p>
    <p>&copy; Edgardo Vaca - 2021 &middot; <a href="politicas.php">Políticas</a> &middot; <a href="condiciones.php">Condiciones</a></p>
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