<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Iniciar Sesión - Administrador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('Unipoli.jpg'); /* Fondo de imagen */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco semi-transparente */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 300px;
        }

        h2 {
            background-color: #3f6f3f; /* Verde */
            color: #fff;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            margin-top: 0;
        }

        form {
            padding: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
            color: #666; /* Gris medio */
        }

        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
            color: #333; /* Gris oscuro */
        }

        input[type="submit"] {
            background-color: #3f6f3f; /* Verde */
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #2e532e; /* Verde más oscuro al pasar */
        }

        #mostrarContrasena {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Iniciar Sesión - Administrador</h2>
        <form method="post" action="procesar_login.php">
            <label for="nombre_usuario">Nombre de Usuario:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required><br><br>
            
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>
            <span id="mostrarContrasena" onclick="mostrarOcultarContrasena()">
                <i class="fas fa-eye" id="iconoOjo"></i>
            </span><br>
            
            <input type="submit" value="Iniciar Sesión">
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
    </script>
</body>
</html>
