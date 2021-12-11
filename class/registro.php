<?php

require_once('modelo.php');

class registro extends modeloCredencialesBD{

    public function __construct(){
        parent::__construct();
    }

public function crear_registro($nombre, $correo, $contra){
    
    $instruccion = "CALL sp_registro('".$nombre."','".$correo."','".$contra."')";

    $consulta=$this->_db->query($instruccion);
    $resultado=$consulta->fetch_all(MYSQLI_ASSOC);

    if($resultado){
        return $resultado;
        $resultado->close();
        $this->_db->close();
    }
}

public function validar_correo($correo){
    
    $instruccion = "CALL sp_validar_usuario('".$nombre."')";

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