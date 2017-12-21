<?php
/** 
 * @version V0 3 April 2012 (c) 2011-2013 Sergio Vasquez (servasp@gmail.com). All rights reserved.
 */
 
//error_reporting(E_ALL);



if($_SERVER["REMOTE_ADDR"] == "190.0.19.18"){

$para = 'cgiraldo7@gmail.com';
$titulo = 'Notificación Sincronización Cartera Web';
$msg = $_GET["msg"];
$cabeceras = 'From: info@parsoniisolutions.com' . "\r\n" .
    'Reply-To: info@parsoniisolutions.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
mail($para, $titulo, $msg, $cabeceras);

}

?>