<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Docentes</title>
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
        .center {
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <a href="../administradores.php"><img src="../ENGRANE_TEXTO.png" alt="Logo"></a>
        <div class="buttons">
            <a href="agregar_docente.php" class="icon-button">
                <img src="add_icon.png" alt="Agregar Docente">
                Agregar
            </a>
            <a href="../administradores.php" class="icon-button">
                <img src="back_icon.png" alt="Volver">
                Volver
            </a>
        </div>
    </header>
    <h1>Docentes</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Disciplina</th>
                <th>Perfil</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../../conexion.php';
            $sql = "SELECT * FROM instructores";
            $resultado = $conn->query($sql);
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila["ID_Instructor"] . "</td>";
                    echo "<td>" . $fila["Nombre"] . "</td>";
                    echo "<td>" . $fila["Apellido_Paterno"] . "</td>";
                    echo "<td>" . $fila["Apellido_Materno"] . "</td>";
                    echo "<td>" . $fila["Disciplina"] . "</td>";
                    echo "<td>" . $fila["Perfil"] . "</td>";
                    echo "<td>" . $fila["Nombre_usuario"] . "</td>";
                    echo "<td>";
                    echo "<button class='icon-button' onclick='editarDocente(" . $fila["ID_Instructor"] . ")'><img src='edit_icon.png' alt='Editar'>Editar</button>";
                    echo "<button class='icon-button' onclick='confirmarEliminacion(" . $fila["ID_Instructor"] . ")'><img src='trash_icon.png' alt='Eliminar'>Eliminar</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No se encontraron instructores.</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>

    <script>
        function confirmarEliminacion(idInstructor) {
            if (confirm("¿Estás seguro de que deseas eliminar este docente?")) {
                window.location.href = "eliminar_docente.php?id=" + idInstructor;
            }
        }

        function editarDocente(idInstructor) {
            window.location.href = "editar_docente.php?id=" + idInstructor;
        }
    </script>
</body>
</html>
