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
            <div class="col-4"><span>AGENDA</span>PERSONAL</div>
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
            <h1>Modificar Amigo</h1>
            <form action="listaamigos.php?action=actualizar" method="POST">
                <input type="hidden" name="id_amigo" value="<?php echo $amigo->id_amigo; ?>">
                
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $amigo->nombre; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido:</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $amigo->apellido; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo date('Y-m-d', strtotime(str_replace('/', '-', $amigo->fecha))); ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>