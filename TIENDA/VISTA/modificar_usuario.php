<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Personal - Minecraft Style</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php require_once("header.php") ?>
    <main class="container mt-4">
        <section class="mb-4">
            <div class="d-flex justify-content-end">
                <a href="listausuarios.php?action=insertarUsuario" class="pixel-button">Insertar usuarios</a>
                <a href="listausuarios.php?action=buscadorUsuarios" class="pixel-button ms-3">Buscar usuarios</a>
            </div>
        </section>
        <section class="container mt-4">
            <h1 class="text-center pixel-text mb-4">Modificar Usuario</h1>
            <form action="listausuarios.php?action=actualizar" method="POST" class="block-effect p-4">
                <input type="hidden" name="id_usuario" value="<?php echo $usu->id_usuarios; ?>">

                <div class="mb-3">
                    <label for="nombre" class="form-label pixel-text">Nombre usuario:</label>
                    <input type="text" class="pixel-input form-control" id="nombre" name="nombre" value="<?php echo $usu->nombre_usuario; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="apellido" class="form-label pixel-text">Contraseña:</label>
                    <input type="text" class="pixel-input form-control" id="pass1" name="pass1" >
                </div>

                <input type="hidden" name="pass" value="<?php echo $usu->contraseña; ?>">

                <div class="text-center">
                    <button type="submit" class="pixel-button">>Actualizar</button>
                </div>
            </form>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>