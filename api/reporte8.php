<?php
require("fpdf-1h/fpdf.php");
$pdf = new FPDF('P','cm',array(8,27.98));
$pdf->settitle("Nota de venta",true);
$pdf->setmargins(0.5,1,0.5);
$pdf->setautopagebreak(true,1.5);

$pdf->addpage();
$pdf->image("res/logo.png",2.5,1,3,0,'png');

$pdf->setfont('arial','',11); $pdf->settextcolor(0,0,0);
$pdf->ln(3);
$pdf->cell(7,0.5,"NOTA DE VENTA",1,0,'C'); $pdf->ln(1);
$pdf->cell(7,0.5,"MI TELEFERICO",1,0,'L'); $pdf->ln();
$pdf->cell(7,0.5,"NIT: 280023534",1,0,'L'); $pdf->ln();
$pdf->multicell(7,0.5,utf8_decode("Z/San Pedro C/Flores de la barra #332"),0,"C");
$pdf->ln(0.5);
$pdf->cell(7,0.5,"NUMERO: 238",1,0,'R'); $pdf->ln();
$pdf->cell(7,0.5,"DETALLE",1,0,'C'); $pdf->ln(1);
$pdf->setfont('arial','',8); $pdf->settextcolor(0,0,0);
$pdf->cell(5.5,0.5,"Plan ejecutivo",1,0,'L');
$pdf->cell(1.5,0.5,"80 Bs",1,0,'R'); $pdf->ln();
$pdf->cell(5.5,0.5,"Proteina RAY 300gr",1,0,'L');
$pdf->cell(1.5,0.5,"600 Bs",1,0,'R'); $pdf->ln();

$pdf->cell(5.5,0.5,"Totales",1,0,'R');
$pdf->cell(1.5,0.5,"680 Bs",1,0,'R'); $pdf->ln();
$pdf->cell(5.5,0.5,"Descuento",1,0,'R');
$pdf->cell(1.5,0.5,"20 Bs",1,0,'R'); $pdf->ln();
$pdf->cell(5.5,0.5,"Total a pagar",1,0,'R');
$pdf->cell(1.5,0.5,"660 Bs",1,0,'R'); $pdf->ln();

$pdf->output();
?>