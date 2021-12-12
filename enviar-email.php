<?php 
if(isset($_POST['enviar'])){
    $name = $_POST['nombre'];
    $mailFrom = $_POST['correo'];
    $subject = $_POST['asunto'];
    $message = $_POST['mensaje'];
    
    $mailTo = "edgardovac2298@gmail.com";
    $headers =  'MIME-Version: 1.0' . "\r\n"; 
    $headers .= "De: ".$mailFrom;
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $txt = "Usted ha recibido un e-mail de ".$name.".\n\n".$message;
    mail($mailTo, $subject, $txt, $headers); 
    header("Location: contacto.php?mailenviado");
}
?>