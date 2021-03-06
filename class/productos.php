<?php

require_once('modelo.php');

class productos extends modeloCredencialesBD{

    public function __construct(){
        parent::__construct();
    }

public function traer_productos(){
    
    $instruccion = "CALL sp_traer_productos";

    $consulta=$this->_db->query($instruccion);
    $resultado=$consulta->fetch_all(MYSQLI_ASSOC);

    if($resultado){

        return $resultado;
        $resultado->close();
        $this->_db->close();
    }
}

public function contar_productos(){
    
    $instruccion = "CALL sp_contar_productos";

    $consulta=$this->_db->query($instruccion);
    $resultado=$consulta->fetch_all(MYSQLI_ASSOC);

    if($resultado){

        return $resultado;
        $resultado->close();
        $this->_db->close();
    }
}

public function especifico_producto($codigo){
    
    $instruccion = "CALL sp_traer_especifico_producto('".$codigo."')";

    $consulta=$this->_db->query($instruccion);
    $resultado=$consulta->fetch_all(MYSQLI_ASSOC);

    if($resultado){

        return $resultado;
        $resultado->close();
        $this->_db->close();
    }
}

}

?>