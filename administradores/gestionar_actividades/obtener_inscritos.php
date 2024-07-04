<?php

if (isset($_GET['actividad_nombre'])) {
    $actividadNombre = $_GET['actividad_nombre'];

    include '../../conexion.php';

    $actividadNombre = $conn->real_escape_string($actividadNombre);

    $sql = "SELECT Matricula, Nombre, Apellido_Paterno, Apellido_Materno FROM alumnos WHERE Actividad = '$actividadNombre'";

    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<h2></h2>";
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Matrícula</th>";
        echo "<th>Nombre</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["Matricula"] . "</td>";
            echo "<td>" . $fila["Nombre"]." ". $fila["Apellido_Paterno"]." ".$fila["Apellido_Materno"] . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No hay inscritos en esta actividad.";
    }

    $conn->close();
} else {
    echo "Nombre de actividad no válido.";
}
?>

