<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "act_extraescolares";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}
?>
