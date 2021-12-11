<?php

require_once('modelo.php');

class usuarios extends modeloCredencialesBD{

    public function __construct(){
        parent::__construct();
    }

public function iniciar_sesion($correo, $contra){
    
    $instruccion = "CALL sp_iniciar_sesion('".$correo."','".$contra."')";

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