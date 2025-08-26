<?php
require("fpdf-1h/fpdf.php");
$pdf = new FPDF('P','cm','letter');
$pdf->settitle("gatito",true);
$pdf->addpage();
$pdf->setfont('arial','B',15);
$pdf->settextcolor(0,0,0);
$pdf->cell(19.59,1,"Stanley",'RT',0,'R');  $pdf->ln();
$pdf->settextcolor(255,0,0);
$pdf->setfont('arial','',11);
for($P=1; $P<=10; $P++)
{	$pdf->cell(19.59,0.5,"Mi primer texto",1,0,'L'); $pdf->ln();
}
$pdf->addpage('L','letter');

$pdf->addpage('L','legal');

$pdf->output();
?>