<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["docente"])) {
    $docente = $_GET["docente"];
    
    $_SESSION["docente"] = $docente;
    header("Location: pagina_docentes.php");
    exit;
} else {
    echo "Error: Seleccione una actividad válida.";
}
?>
