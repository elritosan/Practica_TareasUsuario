<?php

include_once(__DIR__.'/../ClassConsultasBD.php');
include_once(__DIR__.'/../../View/VPlantilla.php');
include_once(__DIR__ . '/../../Script/Func/ClassRotulosEntidades.php');
$oBD = new ClassConsultasBD();
$rotulos = new ClassRotulosEntidades();

$Listaencuesta = $oBD->ConsultarEncuesta();


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 6, 'idencuesta', 1, 0, 'C');
$pdf->Cell(30, 6, 'descripcion', 1, 0, 'C');
$pdf->Cell(30, 6, 'tarea', 1, 0, 'C');
$pdf->Ln(5);
foreach($Listaencuesta as $x) { //recorrer el arreglo $resultado
    $pdf->Cell(30, 6, $x->idencuesta, 1, 0, 'C');
    $pdf->Cell(30, 6, $x->descripcion, 1, 0, 'C');
    $pdf->Cell(30, 6, $rotulos->RetornarRotulo_Tarea($x->idencuesta), 1, 0, 'C');
    $pdf->Ln(5);
    }
    $pdf->Output('i');

