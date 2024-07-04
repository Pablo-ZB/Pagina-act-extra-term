<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['apellido_paterno']) && isset($_POST['apellido_materno']) && isset($_POST['disciplina']) && isset($_POST['perfil']) && isset($_POST['usuario']) && isset($_POST['contrasena'])) {
        $idInstructor = $_POST['id'];
        $nuevoNombre = $_POST['nombre'];
        $nuevoApellidoP = $_POST['apellido_paterno'];
        $nuevoApellidoM = $_POST['apellido_materno'];
        $nuevoPerfil = $_POST['perfil'];
        $nuevoUsuario = $_POST['usuario'];
        $nuevaContraseña = $_POST['contrasena'];

        $nuevaDisciplina = "";
        if ($nuevoPerfil !== "Administrador") {
            $nuevaDisciplina = $_POST["disciplina"];
        }

        $hash_contraseña = password_hash($nuevaContraseña, PASSWORD_DEFAULT);
        
        include '../../conexion.php';

        $sql = "UPDATE instructores SET  Nombre = '$nuevoNombre', Apellido_Paterno = '$nuevoApellidoP', Apellido_Materno = '$nuevoApellidoM', Disciplina = '$nuevaDisciplina', Perfil = '$nuevoPerfil', Nombre_usuario = '$nuevoUsuario', Contrasena = '$hash_contraseña' WHERE ID_Instructor = $idInstructor";

        if ($conn->query($sql) === TRUE) {
            echo '
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Éxito al Guardar Cambios</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        line-height: 1.6;
                        background-color: #f2f2f2;
                        color: #333;
                        margin: 0;
                        padding: 20px;
                        text-align: center;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        background-color: #fff;
                        padding: 30px;
                        border-radius: 8px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
                    .success-icon {
                        margin-bottom: 20px;
                    }
                    .button {
                        background-color: #3f6f3f;
                        color: #fff;
                        border: none;
                        padding: 10px 20px;
                        cursor: pointer;
                        text-decoration: none;
                        border-radius: 5px;
                        display: inline-block;
                        margin-top: 20px;
                    }
                    .button:hover {
                        background-color: #2e532e;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <img src="../exito.gif" alt="Éxito" class="success-icon">
                    <h2>Cambios guardados con éxito.</h2>
                    <a href="gestionar_docentes.php" class="button">Volver</a>
                </div>
            </body>
            </html>
            ';
        } else {
            echo "Error al guardar los cambios: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Datos incompletos.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
