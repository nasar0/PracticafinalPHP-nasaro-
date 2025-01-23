<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header></header>
    <main>
        <div>
            <h2>Iniciar sesión</h2>
            <form action="../CONTROLADOR/login.php?action=inicio" method="POST">
                <input type="text" name="user"  placeholder="Nombre de usuario" value="<?php  if (isset($_COOKIE["user"])) echo $_COOKIE["user"]; ?>" required><br>
                <input type="password" name="pass" id="pass" placeholder="Contraseña" required><input type="checkbox" name="ocultar" id="ocultar"><i></i><br>
                <label for="">Mantener la sesion iniciada</label>
                <input type="checkbox" name="mantener" <?php   if (isset($_COOKIE["user"])) echo "checked";    ?>>
                <button type="submit" class="btn-login">Iniciar sesión</button>
            </form>
        </div>
    </main>
    <footer></footer>
    <script>
        document.addEventListener("DOMContentLoaded",()=>{
            let ocultar = document.querySelector("#ocultar");
            let pass = document.querySelector("#pass");
            ocultar.addEventListener("change", () => {
                if (ocultar.checked) {
                    pass.type = "text"; 
                } else {
                    pass.type = "password"; 
                }
            });

        })
    </script>
</body>
</html>