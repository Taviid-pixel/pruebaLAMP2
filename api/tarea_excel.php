<?php
require("vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="analisis_costo_ropero.xlsx"');
header('Cache-Control: max-age=0');


$excel = new Spreadsheet();
$hoja = $excel->getActiveSheet();
$hoja->setTitle('Costos');


$azul = '2F75B5';
$amar = 'FFFF00';


$hoja->setCellValue('A2', 'ANALISIS DE COSTO ROPERO');
$hoja->mergeCells('A2:C2');
$hoja->getStyle('A2')->getFont()->setBold(true)->setSize(14);
$hoja->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$hoja->setCellValue('D2', 0);
$hoja->getStyle('D2')->getFont()->setBold(true)->setSize(12);
$hoja->getStyle('D2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
$hoja->getStyle('D2')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);

$f = 4;


function tituloBloque($hoja, $celda, $texto, $color) {
    $hoja->setCellValue($celda, strtoupper($texto));
    $hoja->mergeCells($celda . ":" . chr(ord($celda[0])+3) . substr($celda,1));
    $hoja->getStyle($celda)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($color);
    $hoja->getStyle($celda)->getFont()->setBold(true)->setSize(13)->getColor()->setARGB('FFFFFFFF');
    $hoja->getStyle($celda)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
}

function encabezados($hoja, $fila, $color) {
    $enc = ['Detalle','Cant.','P. Unit.','Subtotal'];
    $col = 'A';
    foreach ($enc as $e) {
        $hoja->setCellValue($col.$fila, $e);
        $hoja->getStyle($col.$fila)->getFont()->setBold(true);
        $hoja->getStyle($col.$fila)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($color);
        $hoja->getStyle($col.$fila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $col++;
    }
}

function bordes($hoja,$rango) {
    $hoja->getStyle($rango)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
}


tituloBloque($hoja,"A$f","Materia Prima",$azul); $f++;
encabezados($hoja,$f,$amar); $f++;

$materia = [
    ["Laminas de melamina",1,380],
    ["Carril para cajon",8,25],
    ["Carril para puerta",2,15],
];
$ini = $f;
foreach($materia as $row){
    [$det,$c,$p]=$row;
    $hoja->setCellValue("A$f",$det);
    $hoja->setCellValue("B$f",$c);
    $hoja->setCellValue("C$f",$p);
    $hoja->setCellValue("D$f","=B$f*C$f");
    $hoja->getStyle("B$f:D$f")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
    $f++;
}
$fin=$f-1;
$hoja->getStyle("A$f")->getFont()->setBold(true);
$hoja->getStyle("A$f")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
$hoja->setCellValue("D$f","=SUM(D$ini:D$fin)");
$hoja->getStyle("D$f")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
$totMP=$f;
bordes($hoja,"A".($ini-2).":D$f");
$f+=2;


tituloBloque($hoja,"A$f","Costos Indirectos de Fabricacion",$azul); $f++;
encabezados($hoja,$f,$amar); $f++;

$indirectos=[
    ["Tornillos",8,0.5],
    ["Tarugos",8,0.3],
    ["Carpicol",1,3],
    ["Energia electrica",1,20],
];
$ini=$f;
foreach($indirectos as $row){
    [$det,$c,$p]=$row;
    $hoja->setCellValue("A$f",$det);
    $hoja->setCellValue("B$f",$c);
    $hoja->setCellValue("C$f",$p);
    $hoja->setCellValue("D$f","=B$f*C$f");
    $hoja->getStyle("B$f:D$f")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
    $f++;
}
$fin=$f-1;
$hoja->mergeCells("A$f:C$f");
$hoja->setCellValue("A$f","TOTAL COSTOS INDIRECTOS");
$hoja->getStyle("A$f")->getFont()->setBold(true);
$hoja->getStyle("A$f")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
$hoja->setCellValue("D$f","=SUM(D$ini:D$fin)");
$hoja->getStyle("D$f")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
$totCI=$f;
bordes($hoja,"A".($ini-2).":D$f");
$f+=2;


tituloBloque($hoja,"A$f","Mano de Obra",$azul); $f++;
encabezados($hoja,$f,$amar); $f++;

$mano=[["Obreros",2,120]];
$ini=$f;
foreach($mano as $row){
    [$det,$c,$p]=$row;
    $hoja->setCellValue("A$f",$det);
    $hoja->setCellValue("B$f",$c);
    $hoja->setCellValue("C$f",$p);
    $hoja->setCellValue("D$f","=B$f*C$f");
    $hoja->getStyle("B$f:D$f")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
    $f++;
}
$fin=$f-1;
$hoja->mergeCells("A$f:C$f");
$hoja->setCellValue("A$f","TOTAL MANO DE OBRA");
$hoja->getStyle("A$f")->getFont()->setBold(true);
$hoja->getStyle("A$f")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
$hoja->setCellValue("D$f","=SUM(D$ini:D$fin)");
$hoja->getStyle("D$f")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
$totMO=$f;
bordes($hoja,"A".($ini-2).":D$f");


$hoja->setCellValue("D2","=D$totMP+D$totCI+D$totMO");


foreach(['A','B','C','D'] as $c){
    $hoja->getColumnDimension($c)->setAutoSize(true);
}


$writer = IOFactory::createWriter($excel,'Xlsx');
$writer->save('php://output');
exit;
