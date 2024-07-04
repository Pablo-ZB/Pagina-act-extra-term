<?php
if (isset($_GET['id'])) {
    $idInstructor = $_GET['id'];

    include '../../conexion.php';

    $sql = "SELECT * FROM instructores WHERE ID_Instructor = $idInstructor";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
    } else {
        echo "No se encontró el docente.";
    }
    $conn->close();
} else {
    echo "ID de instructor no proporcionado.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Docente</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            border-radius: 5px;
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
        input[type="password"],
        input[type="submit"],
        select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .password-container {
            display: flex;
            align-items: center;
            position: relative;
        }
        .password-container input[type="password"] {
            flex: 1;
            padding-right: 30px;
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
        a {
            text-decoration: none;
            color: #3f6f3f;
            display: inline-block;
            margin-top: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
        .top-right {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        #disciplinaContainer {
            display: none;
            margin-top: 5px;
        }
        .eye-icon {
            cursor: pointer;
            position: absolute;
            right: 10px;
        }
    </style>
</head>
<body>
    <header>
        <a href="../administradores.php"><img src="../ENGRANE_TEXTO.png" alt="Logo"></a>
        <div class="buttons">
            <a href="gestionar_docentes.php" class="icon-button">
                <img src="back_icon.png" alt="Volver">
                Volver
            </a>
        </div>
    </header>
    <div class="container">
        <h1>Editar Docente</h1>
        <form action="guardar_edicion.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $fila["Nombre"]; ?>">

            <label for="apellido_paterno">Apellido Paterno:</label>
            <input type="text" name="apellido_paterno" value="<?php echo $fila["Apellido_Paterno"]; ?>">

            <label for="apellido_materno">Apellido Materno:</label>
            <input type="text" name="apellido_materno" value="<?php echo $fila["Apellido_Materno"]; ?>">

            <div id="disciplinaContainer">
                <label for="disciplina" id="disciplinaLabel">Disciplina:</label>
                <select id="disciplina" name="disciplina" required>
                    <?php
                    include '../../conexion.php';
                    $sql = "SELECT nombre FROM actividades";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["nombre"] . '">' . $row["nombre"] . '</option>';
                        }
                    } else {
                        echo '<option value="">No hay disciplinas disponibles</option>';
                    }

                    $conn->close();
                    ?>
                </select>
            </div>

            <label for="perfil">Perfil:</label>
            <select id="perfil" name="perfil" required onchange="toggleDisciplinas()">
                <option value="Instructor">Instructor</option>
                <option value="Administrador">Administrador</option>
            </select>

            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" value="<?php echo $fila["Nombre_usuario"]; ?>">

            <label for="contrasena">Contraseña:</label>
            <div class="password-container">
                <input type="password" id="contrasena" name="contrasena" value="<?php echo $fila["Contrasena"]; ?>" required>
                <span class="eye-icon" onclick="mostrarOcultarContrasena()">
                    <i class="fas fa-eye" id="iconoOjo"></i>
                </span>
            </div>

            <input type="hidden" name="id" value="<?php echo $idInstructor; ?>">
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>

    <script>
        function mostrarOcultarContrasena() {
            var contrasena = document.getElementById("contrasena");
            var iconoOjo = document.getElementById("iconoOjo");

            if (contrasena.type === "password") {
                contrasena.type = "text";
                iconoOjo.classList.remove("fa-eye");
                iconoOjo.classList.add("fa-eye-slash");
            } else {
                contrasena.type = "password";
                iconoOjo.classList.remove("fa-eye-slash");
                iconoOjo.classList.add("fa-eye");
            }
        }

        function toggleDisciplinas() {
            var perfil = document.getElementById("perfil");
            var disciplinaContainer = document.getElementById("disciplinaContainer");

            if (perfil.value === "Administrador") {
                disciplinaContainer.style.display = "none";
            } else {
                disciplinaContainer.style.display = "block";
            }
        }

        toggleDisciplinas();
    </script>
</body>
</html>
