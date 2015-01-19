<?php
extract($_POST);
$from = 'From: Disenno<'.$email.'>';
$to = 'yo@pablosanchezweb.com';
$subject = 'Disenno web. Contacto';
$body = "Nombre: ".$nombre."\r\n Telefono: ".$telefono."\r\n  Email: ".$email."\r\n Comentarios: ". $cuerpo;

if (mail ($to, $subject, $body, $from)) {
header("Location:http://www.pablosanchezweb.com/");

 } else {
echo 'MAIL FAILED';
}
?> 