<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['perfil'] !== 'Administrador') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalla de Administrador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        header img {
            height: 50px;
        }
        header .buttons {
            display: flex;
            gap: 10px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #424949;
        }
        ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }
        li {
            margin: 10px;
            margin-bottom: 10px;
        }
        a.nav-link {
            display: block;
            text-decoration: none;
            background-color: #3f6f3f;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a.nav-link:hover {
            background-color: #2e532e;
        }
        .icon-button {
            display: flex;
            align-items: center;
            justify-content: center;
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            transition: background-color 0.3s;
        }
        .icon-button:hover {
            background-color: #e0e0e0;
        }
        .icon-button img {
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }
    </style>
</head>
<body>
<header>
    <a href="administradores.php"><img src="ENGRANE_TEXTO.png" alt="Logo"></a>
    <div class="buttons">
        <a href="cerrar_sesion.php" class="icon-button">
            <img src="logout_icon.png" alt="Cerrar sesión">
            Cerrar sesión
        </a>
    </div>
</header>
<div class="container">
    <h1>Panel de Administrador</h1>
    <ul>
        <li><a href="gestionar_actividades/gestionar_actividades.php" class="nav-link">Gestionar Actividades</a></li>
        <li><a href="gestionar_docentes/gestionar_docentes.php" class="nav-link">Gestionar Docentes</a></li>
        <li><a href="gestionar_alumnos/gestionar_alumnos.php" class="nav-link">Gestionar Alumnos</a></li>
        <li><a href="imprimir_reportes/reportes.php" class="nav-link">Imprimir Reportes</a></li>
    </ul>
</div>
</body>
</html>

