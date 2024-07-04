<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Alumnos</title>
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
            align-items: center;
            gap: 10px;
        }
        .search-bar {
            display: none;
            align-items: center;
            gap: 5px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
        }
        .search-bar input {
            padding: 5px;
            font-size: 14px;
            border: none;
            outline: none;
        }
        .search-bar button {
            background-color: transparent;
            border: none;
            cursor: pointer;
            padding: 5px;
        }
        .search-bar button img {
            width: 20px;
            height: 20px;
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
            padding: 5px 10px;
            cursor: pointer;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            margin-right: 5px;
        }
        .button:hover {
            background-color: #2e532e;
        }
        .icon-button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            display: flex;
            align-items: center;
            transition: background-color 0.3s;
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
            <div class="search-bar" id="searchBar">
                <input type="text" id="searchInput" placeholder="Buscar..." onkeyup="searchTable()">
                <button onclick="searchTable()">
                    <img src="lupa.png" alt="Buscar">
                </button>
            </div>
            <button onclick="toggleSearchBar()">
                <img src="lupa.png" alt="Buscar">
            </button>
            <a href="../administradores.php" class="icon-button">
                <img src="back_icon.png" alt="Regresar">
                Volver
            </a>
        </div>
    </header>
    <h1>Alumnos</h1>
    <table id="alumnosTable">
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Carrera</th>
                <th>Grupo</th>
                <th>Actividad</th>
                <th>Correo Electrónico</th>
                <th>Horario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../../conexion.php';
            $sql = "SELECT * FROM alumnos";
            $resultado = $conn->query($sql);
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila["Matricula"] . "</td>";
                    echo "<td>" . $fila["Nombre"] . "</td>";
                    echo "<td>" . $fila["Apellido_Paterno"] . "</td>";
                    echo "<td>" . $fila["Apellido_Materno"] . "</td>";
                    echo "<td>" . $fila["Carrera"] . "</td>";
                    echo "<td>" . $fila["Grupo"] . "</td>";
                    echo "<td>" . $fila["Actividad"] . "</td>";
                    echo "<td>" . $fila["Correo_Electronico"] . "</td>";
                    echo "<td>" . $fila["Horario"] . "</td>";
                    echo "<td>";
                    echo "<button class='icon-button' onclick='editarAlumno(" . $fila["Matricula"] . ")'><img src='edit_icon.png' alt='Editar'></button>";
                    echo "<button class='icon-button' onclick='confirmarEliminacion(" . $fila["Matricula"] . ")'><img src='trash_icon.png' alt='Eliminar'></button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No se encontraron alumnos.</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
    <div class="center">
    </div>
    <script>
        function confirmarEliminacion(idAlumno) {
            if (confirm("¿Estás seguro de que deseas eliminar este alumno?")) {
                window.location.href = "eliminar_alumno.php?id=" + idAlumno;
            }
        }

        function editarAlumno(idAlumno) {
            window.location.href = "editar_alumno.php?id=" + idAlumno;
        }

        function toggleSearchBar() {
            const searchBar = document.getElementById('searchBar');
            if (searchBar.style.display === 'none' || searchBar.style.display === '') {
                searchBar.style.display = 'flex';
            } else {
                searchBar.style.display = 'none';
            }
        }

        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('alumnosTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                tr[i].style.display = 'none';
                const td = tr[i].getElementsByTagName('td');
                for (let j = 0; j < td.length; j++) {
                    if (td[j]) {
                        if (td[j].innerHTML.toLowerCase().indexOf(filter) > -1) {
                            tr[i].style.display = '';
                            break;
                        }
                    }
                }
            }
        }
    </script>
</body>
</html>

