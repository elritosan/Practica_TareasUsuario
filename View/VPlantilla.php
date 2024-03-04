<?php
require('../fpdf182/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    // Cabecera de página
function Header()
{
    // Logo
    $this->Image('../img/TAREAS.png', 10, 8, 33);
    // Título
    $this->SetFont('Arial', 'B', 15);
    $this->Cell(0, 10, 'TAREAS', 0, 1, 'C');
    // Línea de separación
    $this->Line(10, 42, 200, 42);
    $this->Ln(40); // Espacio después del título
}

// Pie de página
function Footer()
{
    
    // Posición: a 1,5 cm del final
    $this->SetY(-15);

    // Número de página
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    // Nombre de la empresa
    $this->Ln(5); // Espacio antes del nombre
    $this->SetFont('Arial', '', 10);
    $this->Cell(0, 10, 'TAREAS', 0, 0, 'C');
}

// Tabla coloreada
// Tabla coloreada
function FancyReservaTable($header, $data)
{
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(192, 194, 215); // #C0C2D7
    $this->SetTextColor(0);
    $this->SetDrawColor(128, 0, 0);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B', 10);

    // Calcular el ancho total de la tabla
    $w = array(30, 45, 30, 30); // Anchos de las columnas
    $anchoTotal = array_sum($w);

    // Calcular la posición X para alinear a la izquierda
    $margenIzquierdo = 10; // Margen izquierdo
    $this->SetX($margenIzquierdo);

    // Cabecera
    for ($i = 0; $i < count($header); $i++) {
        $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
    }
    $this->Ln();

    // Restauración de colores y fuentes
    $this->SetFillColor(224, 235, 255);
    $this->SetTextColor(0);
    $this->SetFont('');

    // Datos
    foreach ($data as $row) {
        $this->SetX($margenIzquierdo);
        foreach ($row as $column) {
            $this->Cell($w[$i], 6, $column, 1, 0, 'C');
        }
        $this->Ln(); // Salto de línea después de cada fila
    }

    // Línea de cierre
    $this->Cell($anchoTotal, 0, '', 'T');
}


}
?>