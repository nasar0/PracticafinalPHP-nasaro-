<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Minecraft Style</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css"> 
</head>

<body>
    <header class="header">
        <h1 class="pixel-text">Bienvenido a la Agenda</h1>
    </header>
    <main class="main">
        <div class="login-container block-effect">
            <h2 class="pixel-text">Iniciar sesión</h2>
            <form action="../CONTROLADOR/listausuarios.php?action=inicio" method="POST" class="login-form">
                <div class="form-group">
                    <input type="text" name="user" class="pixel-input" placeholder="Nombre de usuario" value="<?php if (isset($_COOKIE["user"])) echo $_COOKIE["user"]; ?>" required>
                </div>
                <div class="form-group">
                    <input type="password" name="pass" id="pass" class="pixel-input" placeholder="Contraseña" required>
                    <label class="show-password pixel-text">
                        <input type="checkbox" name="ocultar" id="ocultar">
                        Mostrar contraseña
                    </label>
                </div>
                <div class="form-group">
                    <label class="remember-me pixel-text">
                        <input type="checkbox" name="mantener" class="fs-5" <?php if (isset($_COOKIE["user"])) echo "checked"; ?>>
                        Mantener la sesión iniciada
                    </label>
                </div>
                <button type="submit" class="btn-login pixel-button">Iniciar sesión</button>
            </form>
        </div>
    </main>
    <footer class="footer pixel-text">
        <p>&copy; 2014 - Todos los derechos reservados</p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const ocultar = document.querySelector("#ocultar");
            const pass = document.querySelector("#pass");

            ocultar.addEventListener("change", () => {
                pass.type = ocultar.checked ? "text" : "password";
            });
        });
    </script>
</body>

</html>