<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Amigo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="container m-auto">
        <nav class="row d-flex">
        <div class="col-4"><span class="fw-bold">AGENDA</span>PERSONAL</div>
            <div class="col-6 offset-2">
                <a href="listaamigos.php?action=mostrar" class="text-uppercase">amigos</a>
                <a href="" class="text-uppercase">juegos</a>
                <a href="" class="text-uppercase">prestamos</a>
                <a href="" class="text-uppercase">salir</a>
            </div>
        </nav>
    </header>
    <main>
    <section class="container">
    <h1 class="text-center mb-4">Modificar Juego</h1>
    <form action="listajuegos.php?action=actualizar" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_juego" value="<?php echo $juego->id_juego; ?>">
        
        <!-- Campo: Título -->
        <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $juego->titulo; ?>" required>
        </div>

        <!-- Campo: Plataforma -->
        <div class="mb-3">
            <label for="plataforma" class="form-label">Plataforma:</label>
            <input type="text" class="form-control" id="plataforma" name="plataforma" value="<?php echo $juego->plataforma; ?>" required>
        </div>

        <!-- Campo: Año de Lanzamiento -->
        <div class="mb-3">
            <label for="anio_lanzamiento" class="form-label">Año de Lanzamiento:</label>
            <input type="number" class="form-control" id="anio_lanzamiento" name="anio_lanzamiento" value="<?php echo $juego->anio_lanzamiento; ?>" required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Portada del Juego:</label>
            <input type="file" class="form-control" id="foto" name="foto">
            <small class="form-text text-muted">Sube una nueva imagen si deseas cambiar la portada.</small>
        </div>

        <!-- Botón de Actualización -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
</section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>