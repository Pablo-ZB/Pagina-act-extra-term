<?php
if (isset($_GET['id'])) {
    $idAlumno = $_GET['id'];

    include '../../conexion.php';

    $sql = "SELECT * FROM alumnos WHERE Matricula = $idAlumno";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
    } else {
        echo "No se encontró el alumno.";
    }

    $conn->close();
} else {
    echo "ID de alumno no proporcionado.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alumno</title>
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
    </style>
</head>
<body>
    <header>
        <a href="../administradores.php"><img src="../ENGRANE_TEXTO.png" alt="Logo"></a>
        <div class="buttons">
            <a href="gestionar_alumnos.php" class="icon-button">
                <img src="back_icon.png" alt="Volver">
                Volver
            </a>
        </div>
    </header>
    <div class="container">
        <h1>Editar Alumno</h1>
        <form action="guardar_edicion.php" method="POST">
            <label for="matricula">Matrícula:</label>
            <input type="text" name="matricula" id="matricula" required maxlength="10" pattern="[0-9]+" value="<?php echo $fila['Matricula']; ?>"><br>
            <div id="matriculaError" style="color: red;"></div>

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $fila['Nombre']; ?>"><br>

            <label for="apellido_paterno">Apellido Paterno:</label>
            <input type="text" name="apellido_paterno" value="<?php echo $fila['Apellido_Paterno']; ?>"><br>

            <label for="apellido_materno">Apellido Materno:</label>
            <input type="text" name="apellido_materno" value="<?php echo $fila['Apellido_Materno']; ?>"><br>

            <label for="carrera">Carrera:</label>
            <select id="carrera" name="carrera" required>
                <option value="Ingeniería en Software" <?php if ($fila['Carrera'] == 'Ingeniería en Software') echo 'selected'; ?>>Ingeniería de Software</option>
                <option value="Ingeniería Civíl" <?php if ($fila['Carrera'] == 'Ingeniería Civíl') echo 'selected'; ?>>Ingeniería Civíl</option>
                <option value="Ingeniería en Redes y Telecomunicaciones" <?php if ($fila['Carrera'] == 'Ingeniería en Redes y Telecomunicaciones') echo 'selected'; ?>>Ingeniería en Redes y Telecomunicaciones</option>
                <option value="Ingeniería en Tecnologías de Manufactura" <?php if ($fila['Carrera'] == 'Ingeniería en Tecnologías de Manufactura') echo 'selected'; ?>>Ingeniería en Tecnologías de Manufactura</option>
                <option value="Ingeniería en Tecnología Ambiental" <?php if ($fila['Carrera'] == 'Ingeniería en Tecnología Ambiental') echo 'selected'; ?>>Ingeniería en Tecnología Ambiental</option>
                <option value="Licenciatura en Administración y Gestión Empresarial" <?php if ($fila['Carrera'] == 'Licenciatura en Administración y Gestión Empresarial') echo 'selected'; ?>>Licenciatura en Administración y Gestión Empresarial</option>
            </select><br><br>

            <label for="grupoNumero">Grupo:</label>
            <select id="grupoNumero" name="grupoNumero" required>
                <?php
                $numerosGrupo = range(1, 8);
                foreach ($numerosGrupo as $numero) {
                    $selected = ($fila['Grupo'] && is_numeric($fila['Grupo']) && $fila['Grupo'] == $numero) ? 'selected' : '';
                    echo "<option value='$numero' $selected>$numero</option>";
                }
                ?>
            </select>

            <label for="grupoLetra"></label>
            <select id="grupoLetra" name="grupoLetra" required>
                <?php
                $letrasGrupo = range('a', 'c');
                foreach ($letrasGrupo as $letra) {
                    $selected = ($fila['Grupo'] && is_string($fila['Grupo']) && $fila['Grupo'] == $letra) ? 'selected' : '';
                    echo "<option value='$letra' $selected>$letra</option>";
                }
                ?>
            </select><br>

            <label for="actividad">Actividad:</label>
            <select id="actividad" name="actividad" required>
                <?php
                include '../../conexion.php';
                $sql = "SELECT Nombre FROM actividades";
                $resultado = $conn->query($sql);
                if ($resultado->num_rows > 0) {
                    while ($fila_actividad = $resultado->fetch_assoc()) {
                        echo "<option>" . $fila_actividad["Nombre"] . "</option>";
                    }
                }
                $conn->close();
                ?>
            </select><br>

            <label for="correo_electronico">Correo electrónico:</label>
            <input type="text" name="correo_electronico" id="correo_electronico" value="<?php echo $fila['Correo_Electronico']; ?>" required><br>
            <div id="correo_electronicoError" style="color: red;"></div>

            <label for="horario">Horario:</label>
            <select id="horario" name="horario" required></select><br>

            <input type="hidden" name="id" value="<?php echo $idAlumno; ?>">

            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // ACTIVIDAD Y HORARIO
            const actividadSelect = document.getElementById("actividad");
            const horarioSelect = document.getElementById("horario");
            const actividadesHorarios = {
                <?php
                include '../../conexion.php';
                $sql = "SELECT Nombre, Horario1, Horario2 FROM actividades";
                $resultado = $conn->query($sql);
                if ($resultado->num_rows > 0) {
                    while ($fila_actividad = $resultado->fetch_assoc()) {
                        echo "'" . $fila_actividad["Nombre"] . "': ['" . $fila_actividad["Horario1"] . "', '" . $fila_actividad["Horario2"] . "'], ";
                    }
                }
                $conn->close();
                ?>
            };

            function actualizarHorario() {
                const actividadSeleccionada = actividadSelect.value;
                const horarios = actividadesHorarios[actividadSeleccionada] || [];
                horarioSelect.innerHTML = "";
                horarios.forEach(horario => {
                    const option = document.createElement("option");
                    option.value = horario;
                    option.textContent = horario;
                    horarioSelect.appendChild(option);
                });
            }

            actividadSelect.addEventListener("change", actualizarHorario);
            actualizarHorario();

            // GRUPO, MATRICULA Y CORREO
            const grupoNumero = document.getElementById("grupoNumero");
            const grupoLetra = document.getElementById("grupoLetra");
            const grupoInput = document.createElement("input");
            grupoInput.type = "hidden";
            grupoInput.name = "grupo";
            document.querySelector("form").appendChild(grupoInput);

            const matriculaInput = document.getElementById("matricula");
            const matriculaError = document.getElementById("matriculaError");
            const correoInput = document.getElementById("correo_electronico");
            const correoError = document.getElementById("correo_electronicoError");

            function updateGrupo() {
                const numeroSeleccionado = grupoNumero.value;
                const letraSeleccionada = grupoLetra.value;
                grupoInput.value = numeroSeleccionado + letraSeleccionada;
            }

            grupoNumero.addEventListener("change", updateGrupo);
            grupoLetra.addEventListener("change", updateGrupo);
            updateGrupo();

            correoInput.addEventListener("input", function() {
                const correoValue = this.value;
                const correoFormatoValido = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(correoValue);
                if (!correoFormatoValido) {
                    correoError.textContent = "Ingresa un correo electrónico válido.";
                } else {
                    correoError.textContent = "";
                }
            });
        });
    </script>
</body>
</html>
