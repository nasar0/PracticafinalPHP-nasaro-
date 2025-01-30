<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Juego</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header class="container m-auto py-3">
        <nav class="row d-flex align-items-center">
            <div class="col-4"><span class="fw-bold">AGENDA</span>PERSONAL</div>
            <div class="col-8 text-end">
                <a href="listaamigos.php?action=mostrar" class="text-uppercase me-3 text-decoration-none">Amigos</a>
                <a href="listaJuegos.php?action=mostrarJuegos" class="text-uppercase me-3 text-decoration-none">Juegos</a>
                <a href="listaprestamos.php?action=mostrarPrestamos" class="text-uppercase me-3 text-decoration-none">Préstamos</a>
                <a href="" class="text-uppercase text-decoration-none">Salir</a>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        <section class="row mb-4">
            <div class="col-12 text-end">
                <a href="listajuegos.php?action=insertarJuego" class="text-uppercase me-3 text-decoration-none">Insertar juegos</a>
                <a href="listajuegos.php?action=buscador" class="text-uppercase text-decoration-none">Buscar juegos</a>
            </div>
        </section>

        <section class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Formulario de Juego</h2>
                <form action="../CONTROLADOR/listajuegos.php?action=insert" method="post" enctype="multipart/form-data" class="border p-4 rounded shadow-sm">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título:</label>
                        <input type="text" id="titulo" name="titulo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="plataforma" class="form-label">Plataforma:</label>
                        <input type="text" id="plataforma" name="plataforma" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="anio_lanzamiento" class="form-label">Año de Lanzamiento:</label>
                        <input type="number" id="anio_lanzamiento" name="anio_lanzamiento" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto:</label>
                        <input type="file" id="foto" name="foto" class="form-control" accept="image/*" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>