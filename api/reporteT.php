<?php
require('fpdf/fpdf.php');
require('phpqrcode/qrlib.php'); // Asegúrate de tener instalada la librería phpqrcode

// ================== GENERAR QR ==================
$qrTexto = "Chávez, Maicol, Angel";
$qrFile = "qr.png"; // archivo temporal del qr
QRcode::png($qrTexto, $qrFile, QR_ECLEVEL_H, 5); // genera QR

// ================== PDF ==================
$pdf = new FPDF('P','mm','Letter');
$pdf->AddPage();

// ---------------- CABECERA ----------------
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,5,'CLINICA: RENACER',0,1,'L');
$pdf->Cell(0,5,'CB: 78945',0,1,'L');

$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'PERFIL PSICOLOGICO',0,1,'C');

// Foto
$pdf->Image('res/logo.png',15,25,35,35);

// QR (ya generado dinámicamente con phpqrcode)
$pdf->Image($qrFile,170,25,30,30);

// ---------------- DATOS PACIENTE ----------------
$pdf->SetFont('Arial','',10);

$pdf->SetXY(60,30);
$pdf->Cell(40,6,'Paciente:',0,0);
$pdf->Cell(60,6,'Ramon Valdez',0,1);

$pdf->SetX(60);
$pdf->Cell(40,6,'Fecha de nacimiento:',0,0);
$pdf->Cell(60,6,'15/12/1945',0,1);

$pdf->SetX(60);
$pdf->Cell(40,6,'Fecha de ingreso:',0,0);
$pdf->Cell(60,6,'12/02/2023',0,1);

$pdf->SetXY(130,30);
$pdf->Cell(40,6,'Grupo sanguineo:',0,0);
$pdf->Cell(50,6,'ORH+',0,1);

$pdf->SetX(130);
$pdf->Cell(40,6,'Genero:',0,0);
$pdf->Cell(50,6,'Masculino',0,1);

$pdf->SetX(130);
$pdf->Cell(40,6,'Celular:',0,0);
$pdf->Cell(50,6,'74859954',0,1);

$pdf->Ln(15);

// ---------------- TABLAS 2x2 ----------------
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(169,204,227);

// Anchuras para dos columnas
$col1_x = 10;
$col2_x = 110;
$table_width = 95; // ancho de cada tabla
$row_height = 6;

// ========== TABLA CONDUCTA ==========
$pdf->SetXY($col1_x,80);
$pdf->Cell($table_width,7,'CONDUCTA (SI / NO)',1,1,'C',true);

$pdf->SetFont('Arial','',9);
$conducta = [
    ["Usted se considera una persona agresiva?", "NO"],
    ["Se considera una persona introvertida?", "SI"],
    ["La reunion de personas lo molesta?", "SI"],
    ["Es mejor hacer las cosas solo?", "SI"],
    ["Te gusta trabajar en equipo?", "NO"],
    ["Te molestan los espacios estrechos?", "NO"],
    ["Te distraes con facilidad?", "NO"],
    ["Te enfadas de forma rapida?", "SI"],
];
foreach($conducta as $row){
    $pdf->SetX($col1_x);
    $pdf->Cell($table_width*0.7,$row_height,$row[0],1);
    $pdf->Cell($table_width*0.3,$row_height,$row[1],1,1,'C');
}

// ========== TABLA ALIMENTACION ==========
$pdf->SetXY($col2_x,80);
$pdf->SetFont('Arial','B',10);
$pdf->Cell($table_width,7,'ALIMENTACION',1,1,'C',true);

$pdf->SetFont('Arial','',9);
$alimentacion = [
    ["Que dieta sigues?", "Omnivoro"],
    ["Alguna fruta te da alergia?", "Ninguna"],
    ["Prefieres azucarado o salado?", "Salado"],
    ["Menciona tu primer plato favorito.", "Chicharron"],
    ["Menciona tu segundo plato favorito.", "Fritanga"],
    ["Menciona tu tercer plato favorito.", "Sajta"],
    ["Cual es tu fruta favorita?", "Manzana"],
    ["Te gustan las papas fritas?", "Si"],
];
foreach($alimentacion as $row){
    $pdf->SetX($col2_x);
    $pdf->Cell($table_width*0.7,$row_height,$row[0],1);
    $pdf->Cell($table_width*0.3,$row_height,$row[1],1,1,'C');
}

// ========== TABLA SALUD ==========
$pdf->SetXY($col1_x,140);
$pdf->SetFont('Arial','B',10);
$pdf->Cell($table_width,7,'SALUD',1,1,'C',true);

$pdf->SetFont('Arial','',9);
$salud = [
    ["Cual es tu estatura?", "1.68 m"],
    ["Cual es tu peso actual?", "68 Kg"],
    ["Cuantas veces te da resfrio al año?", "3 veces"],
    ["Sueles usar pastillas cuando te da resfrio?", "SI"],
    ["Cada cuanto haces ejercicios?", "No hago"],
    ["Que metabolismo tienes?", "Acelerado"],
];
foreach($salud as $row){
    $pdf->SetX($col1_x);
    $pdf->Cell($table_width*0.7,$row_height,$row[0],1);
    $pdf->Cell($table_width*0.3,$row_height,$row[1],1,1,'C');
}

// ========== TABLA EMOCIONAL ==========
$pdf->SetXY($col2_x,140);
$pdf->SetFont('Arial','B',10);
$pdf->Cell($table_width,7,'EMOCIONAL',1,1,'C',true);

$pdf->SetFont('Arial','',9);
$emocional = [
    ["Te consideras sentimental?", "Muy poco"],
    ["Como fue el trato con tu padre?", "No lo conozco"],
    ["Como fue el trato con tu madre?", "Distante"],
    ["Te ilusionas rapido?", "Si"],
    ["Sentimientos o razon?", "Sentimientos"],
    ["Te gustan los animales?", "No"],
];
foreach($emocional as $row){
    $pdf->SetX($col2_x);
    $pdf->Cell($table_width*0.7,$row_height,$row[0],1);
    $pdf->Cell($table_width*0.3,$row_height,$row[1],1,1,'C');
}

// ---------------- OBSERVACION ----------------
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,7,'OBSERVACION',1,1,'C',true);

$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0,15,'',1);

// ---------------- FIRMAS ----------------
$pdf->Ln(15);
$pdf->SetFont('Arial','',9);
$pdf->Cell(95,6,'_________',0,0,'C');
$pdf->Cell(95,6,'_________',0,1,'C');

$pdf->Cell(95,6,'PACIENTE',0,0,'C');
$pdf->Cell(95,6,'EVALUADOR',0,1,'C');

$pdf->Cell(95,6,'CI: ...................',0,0,'C');
$pdf->Cell(95,6,'DR. CHAPATIN - CI: 46553644 LPZ',0,1,'C');

$pdf->Output();
?>