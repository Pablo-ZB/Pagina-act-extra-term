<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Actividades</title>
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
        .button {
            background-color: #3f6f3f;
            color: #fff;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            text-decoration: none;
        }
        .button:hover {
            background-color: #2e532e;
        }
        .icon-button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            transition: background-color 0.3s;
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
            <a href="agregar_actividad.html" class="icon-button">
                <img src="add_icon.png" alt="Agregar Actividad">
                Agregar
            </a>
            <a href="../administradores.php" class="icon-button">
                <img src="back_icon.png" alt="Volver">
                Volver
            </a>
        </div>
    </header>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Horario 1</th>
                <th>Horario 2</th>
                <th>Sedes</th>
                <th>Inscritos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../../conexion.php';
            $sql = "SELECT * FROM actividades";
            $resultado = $conn->query($sql);
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila["ID_Actividad"] . "</td>";
                    echo "<td>" . $fila["Nombre"] . "</td>";
                    echo "<td>" . $fila["Tipo"] . "</td>";
                    echo "<td>" . $fila["Horario1"] . "</td>";
                    echo "<td>" . $fila["Horario2"] . "</td>";
                    echo "<td>" . $fila["Sedes"] . "</td>";
                    echo "<td>" . $fila["Inscritos"] . "</td>";
                    echo "<td>";
                    echo "<button class='icon-button' onclick='editarActividad(" . $fila["ID_Actividad"] . ")'><img src='edit_icon.png' alt='Editar'>Editar</button>";
                    echo "<button class='icon-button' onclick='confirmarEliminacion(" . $fila["ID_Actividad"] . ")'><img src='trash_icon.png' alt='Eliminar'>Eliminar</button>";
                    echo "<button class='icon-button ver-inscritos' data-nombre='" . $fila["Nombre"] . "'><img src='view_icon.png' alt='Ver Inscritos'>Ver Inscritos</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No se encontraron actividades.</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
    <div id="inscritos-container" class="center">
        <!-- Aquí se mostrará la lista de inscritos -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function confirmarEliminacion(idActividad) {
            if (confirm("¿Estás seguro de que deseas eliminar esta actividad?")) {
                window.location.href = "eliminar_actividad.php?id=" + idActividad;
            }
        }

        function editarActividad(idActividad) {
            window.location.href = "editar_actividad.php?id=" + idActividad;
        }

        $(document).ready(function() {
            $(".ver-inscritos").click(function() {
                var actividadNombre = $(this).data("nombre");
                // Enviar una solicitud AJAX para obtener la lista de inscritos
                $.ajax({
                    url: "obtener_inscritos.php", // Reemplaza con la URL correcta
                    type: "GET",
                    data: { actividad_nombre: actividadNombre },
                    success: function(response) {
                        // Mostrar la lista de inscritos en el contenedor
                        $("#inscritos-container").html(response);
                    },
                    error: function() {
                        alert("Error al cargar la lista de inscritos.");
                    }
                });
            });
        });
    </script>
</body>
</html>
