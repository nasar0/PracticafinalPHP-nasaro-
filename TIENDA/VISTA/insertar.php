<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Amigo - Minecraft Style</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css"> <!-- Archivo CSS externo -->
</head>

<body>
    <?php require_once("header.php") ?>

    <main class="container mt-4">
        <section class="row mb-4">
            <div class="col-12 text-end">
                <a href="listaamigos.php?action=insertarAmigos" class="pixel-button me-3">Insertar amigos</a>
                <a href="listaamigos.php?action=buscador" class="pixel-button">Buscar amigos</a>
            </div>
        </section>
        <section class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4 pixel-text">Formulario de Amigo</h2>
                <form action="../CONTROLADOR/listaamigos.php?action=insert" method="post" class="block-effect p-4">
                    <div class="mb-3">
                        <label for="nombre" class="form-label pixel-text">Nombre de tu amigo:</label>
                        <input type="text" id="nombre" name="nombre" class="pixel-input form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="apellido" class="form-label pixel-text">Apellido de tu amigo:</label>
                        <input type="text" id="apellido" name="apellido" class="pixel-input form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label pixel-text">Fecha de nacimiento:</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="pixel-input form-control" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="pixel-button">>Agregar Amigo</button>
                    </div>
                </form>
            </div>
        </section>';
        
        
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>