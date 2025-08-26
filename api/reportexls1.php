<?php
require("vendor\autoload.php");
use PhpOffice\PhpSpreadsheet\SpreadSheet;
use PhpOffice\PhpSpreadsheet\Writer\XLsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="miexcel.xlsx"');

$excel=new SpreadSheet();
$excel->getProperties()->setCreator("Taviid")->setTitle("Mi excel");

$excel->setActiveSheetIndex(0);
$hoja=$excel->getActiveSheet();
$hoja->setTitle('mihoja1');
$hoja->setCellValue('A1','Hola mundo');
$hoja->setCellValue('A2',30);
$hoja->setCellValue('B2',40);
$hoja->setCellValue('C2',"=SUM(A2+B2)");


$wri= IOFactory::createWriter($excel, 'Xlsx');
$wri->save('php://output');

?>