<?php

session_start();


include '../conexion.php';

$act_docente = $_SESSION['actividad'];

$sql_actividades = "SELECT * FROM actividades WHERE Nombre = '$act_docente'";
$resultado_actividades = $conn->query($sql_actividades);

$sql_alumnos = "SELECT * FROM alumnos WHERE Actividad = '$act_docente'";
$resultado_alumnos = $conn->query($sql_alumnos);

require 'PhpSpreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


$sheet->setCellValue('A1', 'Datos de Actividades');
$sheet->mergeCells('A1:E1');
$sheet->setCellValue('A2', 'Nombre');
$sheet->setCellValue('B2', 'Horario1');
$sheet->setCellValue('C2', 'Horario2');
$sheet->setCellValue('D2', 'Sedes');
$sheet->setCellValue('E2', 'Inscritos');


$row = 3; 
while ($rowActividad = $resultado_actividades->fetch_assoc()) {
    $sheet->setCellValue('A' . $row, $rowActividad['Nombre']);
    $sheet->setCellValue('B' . $row, $rowActividad['Horario1']);
    $sheet->setCellValue('C' . $row, $rowActividad['Horario2']);
    $sheet->setCellValue('D' . $row, $rowActividad['Sedes']);
    $sheet->setCellValue('E' . $row, $rowActividad['Inscritos']);
    $row++;
}



$rowAlumnosStart = $row + 2;

$sheet->setCellValue('A' . $rowAlumnosStart, 'Alumnos:');
$sheet->mergeCells('A' . $rowAlumnosStart . ':F' . $rowAlumnosStart);
$sheet->setCellValue('A' . ($rowAlumnosStart + 1), 'Matricula');
$sheet->setCellValue('B' . ($rowAlumnosStart + 1), 'Nombre');
$sheet->setCellValue('C' . ($rowAlumnosStart + 1), 'Carrera');
$sheet->setCellValue('D' . ($rowAlumnosStart + 1), 'Grupo');
$sheet->setCellValue('E' . ($rowAlumnosStart + 1), 'Correo Electrónico');
$sheet->setCellValue('F' . ($rowAlumnosStart + 1), 'Horario');

$rowAlumnosStart += 2; 
while ($rowAlumno = $resultado_alumnos->fetch_assoc()) {
    $nombreCompleto = $rowAlumno['Nombre'] . ' ' . $rowAlumno['Apellido_Paterno'] . ' ' . $rowAlumno['Apellido_Materno'];
    $sheet->setCellValue('A' . $rowAlumnosStart, $rowAlumno['Matricula']);
    $sheet->setCellValue('B' . $rowAlumnosStart, $nombreCompleto);
    $sheet->setCellValue('C' . $rowAlumnosStart, $rowAlumno['Carrera']);
    $sheet->setCellValue('D' . $rowAlumnosStart, $rowAlumno['Grupo']);
    $sheet->setCellValue('E' . $rowAlumnosStart, $rowAlumno['Correo_Electronico']);
    $sheet->setCellValue('F' . $rowAlumnosStart, $rowAlumno['Horario']);
    $rowAlumnosStart++;
}



$writer = new Xlsx($spreadsheet);
$writer->save('datos.xlsx');


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="datos.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: cache, must-revalidate');
header('Pragma: public');
readfile('datos.xlsx');
?>
