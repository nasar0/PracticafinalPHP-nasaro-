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
        <div class="col-4"><span class="fw-bold">AGENDA</span>PERSONAL</div>
            <div class="col-6 ofset-2">
                <a href="listaamigos.php?action=mostrar" class="text-uppercase">amigos</a>
                <a href="listajuegos.php?action=mostrarJuegos" class="text-uppercase">juegos</a>
                <a href="listaamigos.php?action=mostrarPrestamos" class="text-uppercase">prestamos</a>
                <a href="" class="text-uppercase">salir</a>
            </div>
        </nav>

    </header>
    <main>
        <section class="container">
            <div class="row d-flex ">
                <div class="col-12 d-flex justify-content-end ">
                    <a href="listaamigos.php?action=insertarAmigos" class="text-uppercase ">Insertar amigos</a>
                    <a href="listaamigos.php?action=buscador" class="text-uppercase ps-3">Buscar amigos</a>
                </div>
            </div>
        </section>
        <section class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <h2 class="text-center mb-4">Lista de Amigos</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Fecha de Nacimiento</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listaAmigos as $amigo) {
                            echo "
                            <tr class='text-center align-middle'>
                                <td class='align-middle'>{$amigo->nombre}</td>
                                <td class='align-middle'>{$amigo->apellido}</td>
                                <td class='align-middle'>{$amigo->fecha}</td>
                                <td class='align-middle'>
                                    <a href='listaamigos.php?action=modificar&id={$amigo->id_amigo}' class='btn btn-warning btn-sm'>Modificar</a>
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