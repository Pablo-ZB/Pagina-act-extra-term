<?php
if (isset($_GET['id'])) {
    $idActividad = $_GET['id'];

    include '../../config/conexion.php';

    $sql = "DELETE FROM actividades WHERE ID_Actividad = $idActividad";

    if ($conn->query($sql) === TRUE) {
        echo "Actividad eliminada con éxito.";
        echo '<br><a href="gestionar_actividades.php">Volver</a>';
    } else {
        echo "Error al eliminar la actividad: " . $conn->error;
    }

    $conn->close();
} else {
    echo "ID de actividad no proporcionado.";
}
?>
