<?php

require_once('modelo.php');

class registro extends modeloCredencialesBD{

    public function __construct(){
        parent::__construct();
    }

public function crear_registro($nombre, $correo, $contra){
    
    $instruccion = "CALL sp_registro('".$nombre."','".$correo."','".$contra."')";

    $consulta=$this->_db->query($instruccion);
    }
}

?>