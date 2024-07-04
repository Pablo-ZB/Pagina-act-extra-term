<?php

session_start();

include '../conexion.php';

$act_docente = $_SESSION['actividad'];

$sql_actividades = "SELECT * FROM actividades WHERE Nombre = '$act_docente'";
$resultado_actividades = $conn->query($sql_actividades);

$sql_alumnos = "SELECT * FROM alumnos WHERE Actividad = '$act_docente'";
$resultado_alumnos = $conn->query($sql_alumnos);

require('tcpdf/tcpdf.php');


$pdf = new TCPDF();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);


$pdf->AddPage('L', 'Letter');


$imagePath = 'Logo.png';

$x = 10; // Horizontal
$y = 10; // Vertical
$width = 260; // Ancho
$height = 0; // Altura

$pdf->Image($imagePath, $x, $y, $width, $height);

$pdf->Ln(30);
$pdf->SetLineWidth(0.5);
$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + $pdf->GetPageWidth(), $pdf->GetY());
$pdf->Ln();

$pdf->SetFont('times', 'B', 16);
$pdf->Cell(0, 10, 'Datos de Actividad', 0, 1);
$pdf->Ln();


// Títulos
$pdf->SetFont('times', 'B', 12);
$pdf->writeHTMLCell(40, 10, '', '', '<p style="text-align:center;">'.'Actividad'.'</p>', 1);
$pdf->writeHTMLCell(40, 10, '', '', '<p style="text-align:center;">'.'Horario1'.'</p>', 1);
$pdf->writeHTMLCell(40, 10, '', '', '<p style="text-align:center;">'.'Horario2'.'</p>', 1);
$pdf->writeHTMLCell(40, 10, '', '', '<p style="text-align:center;">'.'Sedes'.'</p>', 1);
$pdf->writeHTMLCell(40, 10, '', '', '<p style="text-align:center;">'.'Inscritos'.'</p>', 1);
$pdf->Ln();

//Datos
while ($row = $resultado_actividades->fetch_assoc()) {
    $pdf->SetFont('times', 12);
    $pdf->writeHTMLCell(40, 10, '', '', '<p style="text-align:center;">'.$row['Nombre'].'</p>', 1);
    $pdf->writeHTMLCell(40, 10, '', '', '<p style="text-align:center;">'.$row['Horario1'].'</p>', 1);
    $pdf->writeHTMLCell(40, 10, '', '', '<p style="text-align:center;">'.$row['Horario2'].'</p>', 1);
    $pdf->writeHTMLCell(40, 10, '', '', '<p style="text-align:center;">'.$row['Sedes'].'</p>', 1);
    $pdf->writeHTMLCell(40, 10, '', '', '<p style="text-align:center;">'.$row['Inscritos'].'</p>', 1);
    $pdf->Ln();
}


$pdf->Ln(15);
$pdf->SetLineWidth(0.5);
$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + $pdf->GetPageWidth(), $pdf->GetY());


$pdf->SetFont('times', 'B', 16);
$pdf->Cell(0, 10, 'Datos de Alumnos', 0, 1);
$pdf->Ln();

//Títulos
$pdf->SetFont('times', 'B', 12);
$pdf->writeHTMLCell(25, 10, '', '', '<p style="text-align:center;">'.'Matricula'.'</p>', 'LTRB');
$pdf->writeHTMLCell(55, 10, '', '', '<p style="text-align:center;">'.'Nombre'.'</p>', 'LTRB');
$pdf->writeHTMLCell(75, 10, '', '', '<p style="text-align:center;">'.'Carrera'.'</p>', 'LTRB');
$pdf->writeHTMLCell(18, 10, '', '', '<p style="text-align:center;">'.'Grupo'.'</p>', 'LTRB');
$pdf->writeHTMLCell(70, 10, '', '', '<p style="text-align:center;">'.'Correo Electrónico'.'</p>', 'LTRB');
$pdf->writeHTMLCell(40, 10, '', '', '<p style="text-align:center;">'.'Horario'.'</p>', 'LTRB');
$pdf->Ln();

//Datos
while ($row = $resultado_alumnos->fetch_assoc()) {
    $pdf->SetFont('times', 12);
    $nombreCompleto = $row['Nombre'] . ' ' . $row['Apellido_Paterno'] . ' ' . $row['Apellido_Materno'];
    $pdf->writeHTMLCell(25, 10, '', '', '<p style="text-align:center;">'.$row['Matricula'].'</p>', 'LTRB');
    $pdf->writeHTMLCell(55, 10, '', '', '<p style="text-align:center;">' . $nombreCompleto . '</p>', 'LTRB');
    $pdf->writeHTMLCell(75, 10, '', '', '<p style="text-align:center;">'.$row['Carrera'].'</p>', 'LTRB');
    $pdf->writeHTMLCell(18, 10, '', '', '<p style="text-align:center;">'.$row['Grupo'].'</p>', 'LTRB');
    $pdf->writeHTMLCell(70, 10, '', '', '<p style="text-align:center;">'.$row['Correo_Electronico'].'</p>', 'LTRB');
    $pdf->writeHTMLCell(40, 10, '', '', '<p style="text-align:center;">'.$row['Horario'].'</p>', 'LTRB');
    $pdf->Ln();
}

$pdf->Output('actividades.pdf', 'D');
?>