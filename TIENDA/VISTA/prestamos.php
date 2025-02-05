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
                <a href="listaprestamos.php?action=insertarPrestamo" class="pixel-button">Insertar prestamo</a>
                <a href="listaprestamos.php?action=buscador" class="pixel-button ms-3">Buscar prestamo</a>
            </div>
        </section>
        <section>
            <div class="row justify-content-center">
                <div class="col-12">
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
                                            <td class='align-middle'>";
                                             if ($prestamo->devuelto == 0) {
                                                echo "<button disabled class='btn btn-warning btn-sm pixel-button'>Devolver</button>";
                                             }else{
                                                echo "<a href='listaprestamos.php?action=devolver&id={$prestamo->id_prestamo}' class='btn btn-warning btn-sm pixel-button' >Devolver</a>";
                                             }
                                    
                                    echo"
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
    <a href="" disavled></a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
