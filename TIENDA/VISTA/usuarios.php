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
                <a href="listausuarios.php?action=insertarUsuario" class="pixel-button">Insertar usuarios</a>
                <a href="listausuarios.php?action=buscadorUsuarios" class="pixel-button ms-3">Buscar usuarios</a>
            </div>
        </section>
        <section>
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="text-center mb-4">Lista de Usuarios</h2>
                    <div class="table-responsive block-effect">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">contraseña</th>
                                    <th scope="col">Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($listausuarios as $usuarios) {
                                    echo "
                                    <tr class='text-center align-middle'>
                                        <td class='align-middle'>{$usuarios->id_usuarios}</td>
                                        <td class='align-middle'>{$usuarios->nombre_usuario}</td>
                                        <td class='align-middle'>".str_repeat('*', strlen($usuarios->contraseña))."</td>
                                    <td class='align-middle'>
                                            <a href='listausuarios.php?action=insertarUsuario&id={$usuarios->id_usuarios}' class='btn btn-warning btn-sm pixel-button'>Modificar</a>
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