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
    <title>Políticas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- CSS Interno + icon + theme color -->
    <link href="css/inicio.css" rel="stylesheet">
    <link href="css/politicas.css" rel="stylesheet">
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
        <li><a href="inicio.php" class="nav-link px-2 link-dark">Inicio</a></li>
        <li><a href="contacto.php" class="nav-link px-2 link-dark">Contacto</a></li>
        <li><a href="quienes-somos.php" class="nav-link px-2 link-dark">¿Quiénes somos?</a></li>
        <li><a href="productos.php" class="nav-link px-2 link-dark">Productos</a></li>
        <!-- <li><a href="#" class="nav-link px-2 link-dark">Preguntas frecuentes</a></li> -->
      </ul>

      <div class="col-md-3 text-end">
      <a href="logout.php">
        <button type="button" class="btn btn-outline-primary me-2">Cerrar sesión</button>
      </a>  
      
      <a href="cart.php">
        <button type="button" class="btn btn-primary">Ver carrito</button>
    </a>

      </div>
    </header>
  </div>

  <!-- Text -->
    <div class="contenedor">
    <h2>Política de privacidad</h2><br>
    <b><span>¿Cómo obtenemos sus datos personales?</span></b>
    <p><br>
    Recogemos sus datos personales en distintas ocasiones:<br><br>
- Cada vez que usted contacta directamente con nosotros, por ejemplo a través de la webs <a href="https://burgerking.es">www.burgerking.es</a>, <a href="https://burgerkingencasa.es">www.burgerkingencasa.es</a> y <a href="https://bkspain.es">www.bkspain.es</a>  o a través de las líneas de atención telefónica a clientes, para solicitar información sobre nuestros productos y servicios.
<br>- Cuando usted compra   un producto o servicio (por ejemplo, en Burger King en casa de nuestra web).
<br>- Cuando usted participa en nuestras campañas de marketing, por ejemplo, rellenando una tarjeta de respuesta o participando en alguna promoción a través de nuestras webs o restaurantes que requiere que usted complete un formulario on-line con sus datos personales.
<br><br>Los productos y servicios de BURGERKING, así como sus campañas promocionales, están dirigidos y pensados en su mayoría para adultos. En este sentido, solo recogeremos y trataremos sus datos personales si usted tiene, al menos, 14 años. BURGERKING se reserva la posibilidad de realizar verificaciones de la edad de las personas que le facilitan datos personales. Cualquier dato de un menor de 14 años, será eliminado.
<br><br>Le agradeceríamos que nos ayudase a mantener actualizados sus datos personales informándonos de cualquier cambio en sus datos de contacto o sus preferencias.
    </p>
<br>
    <b><span>¿Qué información podemos obtener sobre usted?</span></b><br>
    <br><p>A través de los distintos servicios y canales de contacto descritos en esta Política de Privacidad, se pueden recabar los siguientes tipos de datos acerca de usted:-Datos de Contacto: nombre, dirección, números de teléfono, correo electrónico.
Preferencias: información que usted nos facilite acerca de sus preferencias, por ejemplo, el tipo de productos.
Uso de la web y de las comunicaciones: cómo utiliza nuestra web; si abre o reenvía nuestros mensajes; así como la información recabada por medio de cookies y otras tecnologías de rastreo.</p>
    </div>
    

  <!-- Footer -->
  <hr class="featurette-divider">
    <footer class="container">
    <p class="float-end"><a href="inicio.php">Inicio</a></p>
    <p>&copy; Edgardo - 2021 &middot; <a href="politicas.php">Políticas</a> &middot; <a href="condiciones.php">Condiciones</a></p>
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