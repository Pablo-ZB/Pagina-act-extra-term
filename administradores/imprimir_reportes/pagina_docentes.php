<?php
session_start();

if (isset($_SESSION["docente"])) {
    $docente = $_SESSION["docente"];
   

    include '../../conexion.php';


    $sql_docentes = "SELECT * FROM instructores WHERE Nombre = '$docente'";
    $resultado_docentes = $conn->query($sql_docentes);

    if ($resultado_docentes) {
        $fila_docente = $resultado_docentes->fetch_assoc();
        $act_docente = $fila_docente['Disciplina'];
        $nombre_completo = $fila_docente['Nombre'] . ' ' . $fila_docente['Apellido_Paterno'] . ' ' . $fila_docente['Apellido_Materno'];
    } else {
        echo "Error al obtener la disciplina del docente.";
    }

    $sql_actividades = "SELECT * FROM actividades WHERE Nombre = '$act_docente'";
    $resultado_actividades = $conn->query($sql_actividades);

    $sql_alumnos = "SELECT * FROM alumnos WHERE Actividad = '$act_docente'";
    $resultado_alumnos = $conn->query($sql_alumnos);

} else {
    echo "Error: No se proporcionó el parámetro 'docente' en la sesión.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Docentes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f2f2f2;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        header img {
            height: 50px;
        }
        header .buttons {
            display: flex;
            gap: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e6e6e6;
        }
        a {
            text-decoration: none;
            color: #3f6f3f;
        }
        a:hover {
            text-decoration: underline;
        }
        .icon-button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            display: flex;
            align-items: center;
        }
        .icon-button img {
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }
        .icon-button:hover {
            background-color: #e0e0e0;
        }
        .center {
            text-align: center;
        }
        .top-right {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    <header>
        <a href="../administradores.php"><img src="../ENGRANE_TEXTO.png" alt="Logo"></a>
        <div class="buttons">
            <a href="generar_pdf.php" target="_blank" class="icon-button">
                <img src="pdf_icon.png" alt="Guardar en PDF">
                Guardar en PDF
            </a>
            <a href="generar_excel.php" class="icon-button">
                <img src="excel_icon.png" alt="Guardar en Excel">
                Guardar en Excel
            </a>
            <a href="reportes.php" class="icon-button">
                <img src="back_icon.png" alt="Volver">
                Volver
            </a>
        </div>
    </header>
    <h1><?php echo $nombre_completo; ?></h1>

    <h2>Actividad:</h2>
    <table>
        <thead>
            <tr>
                <th>Actividad</th>
                <th>Horario 1</th>
                <th>Horario 2</th>
                <th>Sedes</th>
                <th>Inscritos</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultado_actividades->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['Nombre']; ?></td>
                    <td><?php echo $row['Horario1']; ?></td>
                    <td><?php echo $row['Horario2']; ?></td>
                    <td><?php echo $row['Sedes']; ?></td>
                    <td><?php echo $row['Inscritos']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h2>Alumnos:</h2>
    <table>
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Nombre</th>
                <th>Carrera</th>
                <th>Grupo</th>
                <th>Correo Electrónico</th>
                <th>Horario</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultado_alumnos->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['Matricula']; ?></td>
                    <td><?php echo $row['Nombre'] . ' ' . $row['Apellido_Paterno'] . ' ' . $row['Apellido_Materno']; ?></td>
                    <td><?php echo $row['Carrera']; ?></td>
                    <td><?php echo $row['Grupo']; ?></td>
                    <td><?php echo $row['Correo_Electronico']; ?></td>
                    <td><?php echo $row['Horario']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
