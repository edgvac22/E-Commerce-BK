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
    <title>Carrito</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- CSS Interno + icon + theme color -->
    <link href="css/inicio.css" rel="stylesheet">
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
      <a href="mi-cuenta.php">
        <button type="button" class="btn btn-outline-primary me-2">Mi cuenta</button>
      </a>  
      
      <a href="cart.php">
        <button type="button" class="btn btn-primary">Ver carrito</button>
    </a>

      </div>
    </header>
  </div>

  <!-- Cart -->
<?php

if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "añadir":
            if(!empty($_POST["cantidad"])) {
                require_once("class/productos.php");
                $obj_productos = new productos();
                $get_especifico_producto = $obj_productos->especifico_producto($_GET["codigo"]);

                $itemArray = array($get_especifico_producto[0]['codigo']=>array('nombre'=>$get_especifico_producto[0]['nombre'], 'codigo'=>$get_especifico_producto[0]['codigo'], 'cantidad'=>$_POST["cantidad"], 'precio'=>$get_especifico_producto[0]['precio'], 'imagen'=>$get_especifico_producto[0]['imagen']));

                if(!empty($_SESSION["cart_item"])) {
                    if(in_array($get_especifico_producto[0]["codigo"],array_keys($_SESSION["cart_item"]))) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                            if($get_especifico_producto[0]["codigo"] == $k) {
                                if(empty($_SESSION["cart_item"][$k]["cantidad"])) {
                                  $_SESSION["cart_item"][$k]["cantidad"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["cantidad"] += $_POST["cantidad"];
                            }
                        }
                    } else {
                      $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                    }
                  } else {
                    $_SESSION["cart_item"] = $itemArray;
                  }
                }
                break;
        }
    }
    ?>
    
    <div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>

<a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["cantidad"]*$item["precio"];
		?>
				<tr>
				<td><img src="<?php echo $item["imagen"]; ?>" class="cart-item-image" /><?php echo $item["nombre"]; ?></td>
				<td><?php echo $item["codigo"]; ?></td>
				<td style="text-align:right;"><?php echo $item["cantidad"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["precio"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="cart.php?action=remover&codigo=<?php echo $item["codigo"]; ?>" class="btnRemoveAction"><img src="img/icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["cantidad"];
				$total_price += ($item["precio"]*$item["cantidad"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records">Tu carrito está vacío</div>
<?php 
}
?>
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