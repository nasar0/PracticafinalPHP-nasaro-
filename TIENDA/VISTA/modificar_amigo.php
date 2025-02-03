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
    <header class="container-fluid">
        <nav class="container d-flex justify-content-between align-items-center">
            <div class="pixel-text">AGENDA PERSONAL</div>
            <div>
                <a href="listaamigos.php?action=mostrar" class="pixel-button">Amigos</a>
                <a href="listajuegos.php?action=mostrarJuegos" class="pixel-button">Juegos</a>
                <a href="listaprestamos.php?action=mostrarPrestamos" class="pixel-button">Préstamos</a>
                <a href="../VISTA/index.php" class="pixel-button">Salir</a>
            </div>
        </nav>
    </header>
    <main class="container mt-4">
        <section class="mb-4">
            <div class="d-flex justify-content-end">
                <a href="listaamigos.php?action=insertarAmigos" class="pixel-button">Insertar amigos</a>
                <a href="listaamigos.php?action=buscador" class="pixel-button ms-3">Buscar amigos</a>
            </div>
        </section>
        <section class="container mt-4">
    <h1 class="text-center pixel-text mb-4">Modificar Amigo</h1>
    <form action="listaamigos.php?action=actualizar" method="POST" class="block-effect p-4">
        <input type="hidden" name="id_amigo" value="<?php echo $amigo->id_amigo; ?>">
        
        <div class="mb-3">
            <label for="nombre" class="form-label pixel-text">Nombre:</label>
            <input type="text" class="pixel-input form-control" id="nombre" name="nombre" value="<?php echo $amigo->nombre; ?>" required>
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label pixel-text">Apellido:</label>
            <input type="text" class="pixel-input form-control" id="apellido" name="apellido" value="<?php echo $amigo->apellido; ?>" required>
        </div>

        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label pixel-text">Fecha de Nacimiento:</label>
            <input type="date" class="pixel-input form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo date('Y-m-d', strtotime(str_replace('/', '-', $amigo->fecha))); ?>" required>
        </div>

        <div class="text-center">
            <button type="submit" class="pixel-button">Actualizar</button>
        </div>
    </form>
</section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>