<?php
require("fpdf-1h/fpdf.php");
class PDF extends FPDF
{	function header()
	{	$this->image("res/logo.png",2.5,2,2,2,'png');
		$this->setfont('arial','', 15);
		$this->cell(17.59,0.5,"encabezado",1,0,'C');
		$this->ln();
	}
	function footer()
	{ 	$this->sety(26.2);
		$this->setfont('arial','',8); $this->settextcolor(0,0,0);
		$this->cell(10,0.5,"Empresa Kratos GYM",1,0,'L');
		$this->cell(7.59,0.5,"Pagina ".$this->pageno()." de {nb}",1,0,'R');
	}
}

$pdf = new PDF('P','cm','letter');
$pdf->aliasnbpages();
$pdf->settitle("Encabezado y pie",true);
$pdf->setmargins(2,1.5,2);
$pdf->setautopagebreak(true,1.5);
$pdf->addpage();
$pdf->setfont('arial','',15);
$pdf->settextcolor(0,0,0);
$pdf->cell(17.59,0.5,"INFORME",1,0,'C'); $pdf->ln();
$pdf->setfont('arial','',11);
for($P=1; $P<=240; $P++)
{	$pdf->cell(17.59,0.5,"Linea de texto $P",1,0,'L'); $pdf->ln();
}
$pdf->output();
?>