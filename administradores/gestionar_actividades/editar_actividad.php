<?php
if (isset($_GET['id'])) {
    $idActividad = $_GET['id'];

    include '../../conexion.php';

    $sql = "SELECT * FROM actividades WHERE ID_Actividad = $idActividad";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
    } else {
        echo "No se encontró la actividad.";
    }

    $conn->close();
} else {
    echo "ID de actividad no proporcionado.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Actividad</title>
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
        .button {
            background-color: #3f6f3f;
            color: #fff;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #2e532e;
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
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            color: #424949;
        }
        input[type="text"],
        input[type="time"],
        input[type="submit"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #3f6f3f;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #2e532e;
        }
        .checkbox-container {
            display: flex;
            flex-wrap: wrap;
        }
        .checkbox-container label {
            margin-right: 10px;
        }
        a {
            text-decoration: none;
            color: #3f6f3f;
            display: inline-block;
            margin-top: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <a href="../administradores.php"><img src="../ENGRANE_TEXTO.png" alt="Logo"></a>
        <div class="buttons">
            <a href="gestionar_actividades.php" class="icon-button">
                <img src="back_icon.png" alt="Volver">
                Volver
            </a>
        </div>
    </header>
    <div class="container">
        <h1>Editar <?php echo $fila["Nombre"]; ?></h1>
        <form action="guardar_edicion.php" method="POST">
            <label>Horario 1:</label>
            <div class="checkbox-container">
                <input type="checkbox" id="lun1" name="horario1_dias[]" value="Lun">
                <label for="lun1">Lunes</label>
                <input type="checkbox" id="mar1" name="horario1_dias[]" value="Mar">
                <label for="mar1">Martes</label>
                <input type="checkbox" id="mie1" name="horario1_dias[]" value="Mie">
                <label for="mie1">Miércoles</label>
                <input type="checkbox" id="jue1" name="horario1_dias[]" value="Jue">
                <label for="jue1">Jueves</label>
                <input type="checkbox" id="vie1" name="horario1_dias[]" value="Vie">
                <label for="vie1">Viernes</label>
                <input type="checkbox" id="sab1" name="horario1_dias[]" value="Sab">
                <label for="sab1">Sábado</label>
                <input type="checkbox" id="dom1" name="horario1_dias[]" value="Dom">
                <label for="dom1">Domingo</label>
            </div>
            <label for="horario1_hora">Hora:</label>
            <input type="time" id="horario1_hora" name="horario1_hora" required>
            
            <label>Horario 2:</label>
            <div class="checkbox-container">
                <input type="checkbox" id="lun2" name="horario2_dias[]" value="Lun">
                <label for="lun2">Lunes</label>
                <input type="checkbox" id="mar2" name="horario2_dias[]" value="Mar">
                <label for="mar2">Martes</label>
                <input type="checkbox" id="mie2" name="horario2_dias[]" value="Mie">
                <label for="mie2">Miércoles</label>
                <input type="checkbox" id="jue2" name="horario2_dias[]" value="Jue">
                <label for="jue2">Jueves</label>
                <input type="checkbox" id="vie2" name="horario2_dias[]" value="Vie">
                <label for="vie2">Viernes</label>
                <input type="checkbox" id="sab2" name="horario2_dias[]" value="Sab">
                <label for="sab2">Sábado</label>
                <input type="checkbox" id="dom2" name="horario2_dias[]" value="Dom">
                <label for="dom2">Domingo</label>
            </div>
            <label for="horario2_hora">Hora:</label>
            <input type="time" id="horario2_hora" name="horario2_hora" required>
            
            <label for="sedes">Sedes:</label>
            <input type="text" id="sedes" name="sedes" value="<?php echo $fila["Sedes"]; ?>" required>
            
            <input type="hidden" name="id" value="<?php echo $idActividad; ?>">
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
</body>
</html>
