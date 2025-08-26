<?php
require("fpdf-1h/fpdf.php");
$BDD = new mysqli("localhost","root","","kratosgym");
$pdf = new FPDF('P','cm','letter');
$pdf->settitle("codigo barras",true);
$pdf->setmargins(2,1.5,2);
$pdf->setautopagebreak(true,1.5);
$pdf->addpage();
$pdf->setfont('arial','',15); $pdf->settextcolor(0,0,0);
$pdf->cell(17.59,1,"Lista de personas",1,0,'L'); $pdf->ln();
$py=3;
$M=$BDD->query("select num,nom,ap,ci from user where std='act' ");
foreach($M as $V)
{	$pdf->cell(6,3,"",1,0,'L');
	$pdf->cell(11.59,3,$V["nom"]." ".$V["ap"]." (".$V["ci"].")",1,0,'L'); $pdf->ln();
	$pdf->image("http://localhost:8080/proy15-kratosgym-v5/api/barcode/barcode.php?text=".$V["ci"]."&size=50&sizefactor=2",2.2,$py,0,0,'png');
	if($py+3<=23)
	{	$py+=3;	}
	else
	{	$py=2;	}
}
$pdf->output();
?>