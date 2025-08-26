<?php
//SOLO PARA FPDF
require_once("qrlib.php");
$text=$_GET["text"];
//NIVEL L=Baja M=Mediana, Q=Alta, H=Maxima
QRcode::png($text,null,'Q',10,0);
?>