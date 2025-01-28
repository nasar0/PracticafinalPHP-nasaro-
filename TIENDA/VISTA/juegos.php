<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <header class="container m-auto">
        <nav class="row d-flex ">
            <div class="col-4"><SPAn>AGENDA</SPAn>PERSONAL</div>
            <div class="col-6 ofset-2">
                <a href="listaamigos.php?action=mostrar" class="text-uppercase">amigos</a>
                <a href="listaJuegos.php?action=mostrarJuegos" class="text-uppercase">juegos</a>
                <a href="listaamigos.php?action=mostrarPrestamos" class="text-uppercase">prestamos</a>
                <a href="" class="text-uppercase">salir</a>
            </div>
        </nav>

    </header>
    <main>
        <section class="container">
            <div class="row d-flex ">
                <div class="col-12 d-flex justify-content-end ">
                    <a href="listaamigos.php?action=insertarAmigos" class="text-uppercase ">Insertar juegos</a>
                    <a href="listajuegos.php?action=buscador" class="text-uppercase ps-3">Buscar juegos</a>
                </div>
            </div>
        </section>
        <section class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <h2 class="text-center mb-4">Lista de Juegos</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Portada</th>
                            <th scope="col">Título</th>
                            <th scope="col">Plataforma</th>
                            <th scope="col">Año de Lanzamiento</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listaJuego as $juego) {
                            $user = $_SESSION['user'];
                            echo "
                            <tr class='text-center align-middle'>
                                <td>
                                    <img src='../img/$user/{$juego->foto}' alt='{$juego->titulo}' class='img-fluid' style='max-width: 200px; height: auto;'>
                                </td>
                                <td class='align-middle'>{$juego->titulo}</td>
                                <td class='align-middle'>{$juego->plataforma}</td>
                                <td class='align-middle'>{$juego->anio_lanzamiento}</td>
                                <td class='align-middle'>
                                    <a href='listajuegos.php?action=modificarJuego&id={$juego->id_juego}&id2={$juego->id_usuario}' class='btn btn-warning btn-sm'>Modificar</a>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>