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
                <a href="listaprestamos.php?action=insertarPrestamo" class="pixel-button">Insertar prestamo</a>
                <a href="listaprestamos.php?action=buscador" class="pixel-button ms-3">Buscar prestamo</a>
            </div>
        </section>
        <section>
            <div class="row justify-content-center">
            <div class="col-md-8">
            <h2 class="text-center mb-4 pixel-text">Formulario de Juego</h2>
                <form action="../CONTROLADOR/listaprestamos.php?action=insert" method="post" enctype="multipart/form-data" class="block-effect p-4">
                    <div class="mb-3">
                        <label for="titulo" class="form-label pixel-text">Amigo:</label>
                        <select name="amigo" id="">
                            <?php 
                            foreach ($amigo as $key => $value) {
                                echo "<option value='$key'>$value</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="plataforma" class="form-label pixel-text">Juego:</label>
                        <select name="juego" id="">
                            <?php 
                            foreach ($juego as $key => $value) {
                                echo "<option value='$key'>$value</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="anio_lanzamiento" class="form-label pixel-text">Dia:</label>
                        <input type="date" id="fecha_prestamo" name="fecha_prestamo" class="pixel-input form-control" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="pixel-button">>Enviar</button>
                    </div>
                </form>
            </div>
        </section>
        
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>