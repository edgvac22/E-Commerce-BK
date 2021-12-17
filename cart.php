<?php

session_start();
if (isset($_SESSION["iniciar_sesion"])) {
  $correo = $_COOKIE["correo"];
  
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
    <link href="css/cart.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <meta name="theme-color" content="#7952b3">
    <style>
      #btnEmpty {
        margin-right: 15px;
      }
    </style>
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
                case "remove":
                  if(!empty($_SESSION["cart_item"])) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                        if($_GET["code"] == $k)
                          unset($_SESSION["cart_item"][$k]);
                          require_once("class/compra.php");
                          $obj_eliminar = new compra();
                          $eliminar_compra = $obj_eliminar->eliminar_carrito($correo, $_GET["code"]);
                          if (is_array($eliminar_compra) || is_object($eliminar_compra)) {
                            foreach($eliminar_compra as $array_resp){
                              foreach($array_resp as $value){
                                $nfilas=$value;
                              }
                            }
                            if($nfilas > 0){
                              header('Location: cart.php');
                            }
                          }
                        if(empty($_SESSION["cart_item"]))
                          unset($_SESSION["cart_item"]);
                    }
                  }
                break;
                case "empty":
                  unset($_SESSION["cart_item"]);
                break;	
              }     
        }
    ?>
    
    <div id="shopping-cart">
<div class="txt-heading">Carrito de compras</div>
<a id="btnEmpty" href="thank-you.php">Proceder con la compra</a>
<a id="btnEmpty" href="cart.php?action=empty">Vaciar carrito</a>

<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Nombre</th>
<th style="text-align:left;">Código</th>
<th style="text-align:right;" width="5%">Cantidad</th>
<th style="text-align:right;" width="10%">Precio unitario</th>
<th style="text-align:right;" width="10%">Precio</th>
<th style="text-align:center;" width="5%">Remover</th>
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
				<td style="text-align:center;"><a href="cart.php?action=remove&code=<?php echo $item["codigo"]; ?>" class="btnRemoveAction"><img src="img/icon-delete.png" alt="Remove Item" />
      </a></td>
				</tr>
				<?php
				$total_quantity += $item["cantidad"];
				$total_price += ($item["precio"]*$item["cantidad"]);
        $itbms_price = ($total_price*0.07);
        $total_plusitbms = ($total_price+$itbms_price);
        require_once("class/compra.php");
          $obj_compra = new compra();
          $hacer_compra = $obj_compra->verificar_carrito($correo, $item["codigo"], $item["nombre"], $item["cantidad"]);
		}
		?>
<!-- Subtotal -->
<tr>
<td colspan="2" align="right">Subtotal:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
<!-- Itbms -->
<tr>
<td colspan="2" align="right">Itbms:</td>
<td align="right"><?php echo "7%"; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($itbms_price, 2); ?></strong></td>
<td></td>
</tr>
<!-- Total -->
<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_plusitbms, 2); ?></strong></td>
<td></td>
</tr>

</tbody>
</table>


  <?php
} else {
?>

<section class="py-4 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Su carrito está vacío</h1>
        <p class="lead text-muted">En la sección de productos encontrará una gran variedad de nuestro catalogo.</p>
        <p>
          <a href="productos.php" class="btn btn-primary my-2">Ver productos</a>

        </p>
      </div>
    </div>
  </section>

<style>
  #btnEmpty {
    visibility: hidden;
  }
</style>
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