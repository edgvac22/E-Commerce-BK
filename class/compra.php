<?php

require_once('modelo.php');

class compra extends modeloCredencialesBD{

    public function __construct(){
        parent::__construct();
    }

public function verificar_carrito($correo, $codigo, $nombre_pro, $cantidad){

    $instruccion = "CALL sp_agregar_producto_carrito('".$correo."','".$codigo."','".$nombre_pro."','".$cantidad."')";
    $consulta=$this->_db->query($instruccion);
}
public function eliminar_carrito($correo, $codigo){

    $instruccion = "CALL sp_borrar_productos_carrito('".$correo."','".$codigo."')";
    $consulta=$this->_db->query($instruccion);
}

public function actualizar_carrito($correo, $codigo, $cantidad){

    $instruccion = "CALL sp_actualizar_productos_carrito('".$correo."','".$codigo."','".$cantidad."')";
    $consulta=$this->_db->query($instruccion);
}


}

?>