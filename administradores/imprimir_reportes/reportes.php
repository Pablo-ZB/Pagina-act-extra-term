<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir Reportes</title>
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
    </style>
</head>
<body>
    <header>
        <a href="../administradores.php"><img src="../ENGRANE_TEXTO.png" alt="Logo"></a>
        <div class="buttons">
            <a href="../administradores.php" class="icon-button">
                <img src="back_icon.png" alt="Volver">
                Volver
            </a>
        </div>
    </header>
    <h1>Reportes</h1>
    <table>
        <thead>
            <tr>
                <th>Docente</th>
                <th>Actividad</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../../conexion.php';

            $sql = "SELECT * FROM instructores WHERE Perfil = 'Instructor'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $nombre_completo = $row['Nombre'] . ' ' . $row['Apellido_Paterno'] . ' ' . $row['Apellido_Materno'];
                    echo "<tr>";
                    echo '<td><a href="procesar_seleccion.php?docente=' . urlencode($row['Nombre']) . '">' . $nombre_completo . '</a></td>';
                    echo "<td>" . $row["Disciplina"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No se encontraron actividades en la base de datos.</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
    <div class="center">
    </div>
</body>
</html>
