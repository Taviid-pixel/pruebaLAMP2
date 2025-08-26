<?php
require("fpdf-1h/fpdf.php");
$BDD = new mysqli("localhost","root","","kratosgym");
$num=$_GET["x"];
$pdf = new FPDF('L','cm','letter');
$pdf->settitle("certificado",true);
$pdf->setmargins(2,1.5,2);
$pdf->setautopagebreak(true,1.5);

$M=$BDD->query("select num,nom,ap,ci from user where num=$num ");
foreach($M as $V)
{	$pdf->addpage();
	$pdf->image("res/certific.jpg",0,0,27.94,0,'jpg');
	$pdf->image("res/logo.png",2.5,2,3,0,'png');
	$pdf->image("res/person.jpg",21,1.8,4.6,0);
	$pdf->ln(4);
	$pdf->setfont('arial','',15); $pdf->settextcolor(0,0,0);
	$pdf->cell(23.94,1,"Se confiere el presente:",0,0,'L'); $pdf->ln();
	$pdf->setfont('arial','B',30); $pdf->settextcolor(0,0,0);
	$pdf->cell(23.94,1,"CERTIFICADO",0,0,'C'); $pdf->ln();
	$pdf->setfont('arial','',23);
	$pdf->cell(23.94,1,utf8_decode(strtoupper("A: ".$V["nom"]." ".$V["ap"])),0,0,'C'); $pdf->ln(1.5);
	$pdf->setfont('arial','',11); $pdf->settextcolor(0,0,0);
	$pdf->cell(5,1,"",0,0,'C');
	$pdf->multicell(14.94,0.5,utf8_decode("Por haber concluido el curso de \"PHP AVANZADO\", este curso se brindo del 23 de marzo al 24 de mayo del año 2025. "),0,"C");
	$pdf->ln(8.9);
	$pdf->setfont('arial','',15); $pdf->settextcolor(0,0,0);
	$pdf->cell(23.94,1,"La Paz, 10 de Junio del 2025",0,0,'R'); $pdf->ln();
}


$pdf->output();
?>