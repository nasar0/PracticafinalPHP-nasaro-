<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Amigo - Minecraft Style</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css"> <!-- Archivo CSS externo -->
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
        <?php 
            if (isset($usu)) {
                ?>
                    <section class="container mt-4">
                        <h1 class="text-center pixel-text mb-4">Modificar Usuario</h1>
                        <form action="listausuarios.php?action=actualizar" method="POST" class="block-effect p-4">
                            <input type="hidden" name="id_usuario" value="<?php echo $usu->id_usuarios; ?>">

                            <div class="mb-3">
                                <label for="nombre" class="form-label pixel-text">Nombre usuario:</label>
                                <input type="text" class="pixel-input form-control" id="nombre" name="nombre" value="<?php echo $usu->nombre_usuario; ?>" required pattern="^[^\s]+$">
                            </div>

                            <div class="mb-3">
                                <label for="apellido" class="form-label pixel-text">Contraseña:</label>
                                <input type="password" class="pixel-input form-control" id="pass1" name="pass1" required pattern="^[^\s]+$">
                            </div>

                            <input type="hidden" name="pass" value="<?php echo $usu->contraseña; ?>">

                            <div class="text-center">
                                <button type="submit" class="pixel-button">>Actualizar</button>
                            </div>
                        </form>
                    </section>
                <?php 
            }else{
                ?>
                     <section class="row justify-content-center">
                        <div class="col-md-8">
                            <h2 class="text-center mb-4 pixel-text">Formulario de Usuario</h2>
                            <form action="../CONTROLADOR/listausuarios.php?action=insert" method="post" class="block-effect p-4">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label pixel-text">Nombre de usuario:</label>
                                    <input type="text" id="nombre" name="nombre" class="pixel-input form-control" required pattern="^[^\s]+$">
                                </div>

                                <div class="mb-3">
                                    <label for="apellido" class="form-label pixel-text">Contraseña: </label>
                                    <input type="password" id="pass" name="pass" class="pixel-input form-control" required pattern="^[^\s]+$">
                                </div>

                                <div class="mb-3">
                                    <label for="fecha_nacimiento" class="form-label pixel-text">Repite la Contraseña</label>
                                    <input type="password" id="passs" name="pass2" class="pixel-input form-control" required pattern="^[^\s]+$">
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="pixel-button">>Agregar Usuario</button>
                                </div>
                            </form>
                        </div>
                    </section>
                <?php 
            }
        
        ?>
       
        
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>