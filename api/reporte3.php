<?php
require("fpdf-1h/fpdf.php");
$pdf = new FPDF('P','cm','letter');
$pdf->settitle("Carta",true);
$pdf->setmargins(2.5,2,2.5); 
$pdf->addpage();
$pdf->image("res/logo.png",2.5,2,2,2,'png');
$pdf->image("res/logo.png",15,17,3,0,'png');
$pdf->setfont('arial','',15);
$pdf->settextcolor(0,0,0);
$pdf->cell(16.59,0.5,"La Paz, 21 de Julio de 2025",0,0,'R'); $pdf->ln(3);
$pdf->cell(16.59,0.7,utf8_decode("Señor.-"),0,0,'L'); $pdf->ln();
$pdf->cell(16.59,0.7,utf8_decode("Lic. Juan Carlos Ticona Quispe"),0,0,'L'); $pdf->ln();
$pdf->setfont('arial','BU',15);
$pdf->cell(16.59,0.7,utf8_decode("GERENTE GENERAL ABSIB"),0,0,'L'); $pdf->ln();
$pdf->setfont('arial','B',15);
$pdf->cell(16.59,0.7,utf8_decode("Presente.-"),0,0,'L'); $pdf->ln(2);
$pdf->setfont('arial','BU',15);
$pdf->cell(16.59,0.7,utf8_decode("REF:SOLICITUD DE PASANTIA"),0,0,'R'); $pdf->ln(2);
$pdf->setfont('arial','',11);
$pdf->multicell(16.59,0.5,utf8_decode("Con mucho agrado lo saludo.."),1,"J");
$pdf->ln(0.5);
$pdf->multicell(16.59,0.5,utf8_decode("El motiva motivo de esta carta es para solicitar su autorizacion de pasantia en la empresa \"ABSIB\" debido a que soy estudiante de tercer año de la carrera de SISTEMAS INFORMATICOS. "),1,"J");
$pdf->ln(0.5);
$pdf->multicell(16.59,0.5,utf8_decode("Sin mas que decir me despido de usted, deseandole salud y exito su vida."),1,"J");

$pdf->ln(4);
$pdf->setfont('arial','',8);
$pdf->cell(6.59,0.3,"",0,0,'L'); $pdf->cell(4,0.3,".............................................",0,0,'C'); $pdf->ln();
$pdf->cell(6.59,0.3,"",0,0,'L'); $pdf->cell(4,0.3,"MAURICIO LOPEZ TORREZ",0,0,'C'); $pdf->ln();
$pdf->cell(6.59,0.3,"",0,0,'L'); $pdf->cell(4,0.3,"C.I. 6846354 L.P.",0,0,'C'); $pdf->ln();

$pdf->output();
?>