<?php
require("fpdf-1h/fpdf.php");
$pdf = new FPDF('P','cm','letter');
$pdf->settitle("tortuga",true);
$pdf->setmargins(2,1,2); 
$pdf->addpage();
$pdf->setfont('arial','I',15);
$pdf->settextcolor(255,0,0);
$pdf->cell(17.59,1,"Titulo",0,0,'R');  $pdf->ln();
$pdf->settextcolor(255,255,255);
$pdf->setfont('arial','B',11);
$pdf->setfillcolor(0,0,255);
$pdf->cell(1,0.5,"#",1,0,'C',true); 
$pdf->cell(10,0.5,"Apellidos y Nombres",1,0,'C',true);
$pdf->cell(6.59,0.5,"Carnet",1,0,'C',true);  $pdf->ln();
$pdf->settextcolor(0,0,0);
$pdf->setfont('arial','',11);
for($P=1; $P<=50; $P++)
{	$pdf->cell(1,0.5,$P,1,0,'L');
	$pdf->cell(10,0.5,"Nombre".$P." Apellido".$P,1,0,'L');
	$pdf->cell(6.59,0.5,"Carnet".$P,1,0,'R'); $pdf->ln();
}
$pdf->output();
?>