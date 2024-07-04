<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["actividad"])) {
    $actividad = $_GET["actividad"];
    
    header("Location: formulario.php?actividad=$actividad");
    exit;

} else {
    echo "Error: Seleccione una actividad válida.";
}
?>
