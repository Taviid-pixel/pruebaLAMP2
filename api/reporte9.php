<?php
require("fpdf-1h/fpdf.php");
$pdf = new FPDF('P','cm','letter');
$pdf->settitle("codigo qr",true);
$pdf->setmargins(2,1.5,2);
$pdf->setautopagebreak(true,1.5);

$pdf->addpage();
$pdf->setfont('arial','',15); $pdf->settextcolor(0,0,0);
$pdf->cell(17.59,1,"Codigos QR",1,0,'L'); $pdf->ln();

$pdf->image("http://localhost/web/proy15-kratos-v4/api/phpqrcode21/qrfpdf.php?text=hola",1,1,4,4,'png');

$pdf->image("http://localhost/web/proy15-kratos-v4/api/phpqrcode21/qrfpdf.php?text=".urlencode("Hola como estas"),6,1,4,4,'png');

$pdf->image("http://localhost/web/proy15-kratos-v4/api/phpqrcode21/qrfpdf.php?text=".urlencode("https://www.youtube.com/watch?v=wbHHkg9MLNg"),1,6,9,9,'png');



$pdf->output();
?>