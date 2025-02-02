<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Préstamos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <header class="container m-auto">
        <nav class="row d-flex">
            <div class="col-4"><span class="fw-bold">AGENDA</span>PERSONAL</div>
            <div class="col-6 offset-2">
                <a href="listaamigos.php?action=mostrar" class="text-uppercase">Amigos</a>
                <a href="listajuegos.php?action=mostrarJuegos" class="text-uppercase">Juegos</a>
                <a href="listaprestamos.php?action=mostrarPrestamos" class="text-uppercase">Préstamos</a>
                <a href="" class="text-uppercase">Salir</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="container">
            <div class="row d-flex">
                <div class="col-12 d-flex justify-content-end">
                    <a href="listaprestamos.php?action=insertarPrestamo" class="text-uppercase">Insertar préstamo</a>
                    <a href="listaprestamos.php?action=buscador" class="text-uppercase ps-3">Buscar préstamos</a>
                </div>
            </div>
        </section>

        <section class="container">
            <div class="row justify-content-center">
                <div class="col-10">
                    <h2 class="text-center mb-4">Lista de Préstamos</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Amigo</th>
                                    <th scope="col">Juego</th>
                                    <th scope="col">Fecha de préstamo</th>
                                    <th scope="col">Devuelto</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($listaPrestamos as $prestamo) {
                                    $estadoDevuelto = ($prestamo->devuelto == 0) ? "Si" : "No";
                                    $user = $_SESSION['user'];
                                    echo "
                                        <tr class='text-center align-middle'>
                                            <td class='align-middle'>{$prestamo->nombreAmigo}</td>
                                            <td>
                                                <img src='../img/{$user}/{$prestamo->foto}' alt='{$prestamo->nombreAmigo}' class='img-fluid' style='max-width: 200px; height: auto;'>
                                            </td>
                                            <td class='align-middle'>{$prestamo->fecha_prestamo}</td>
                                            <td class='align-middle'>{$estadoDevuelto}</td>
                                            <td class='align-middle'>
                                                <a href='listaprestamos.php?action=devolver&id={$prestamo->id_prestamo}' class='btn btn-warning btn-sm pixel-button'>Devolver</a>
                                            </td>
                                        </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <img src="" alt="">
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>