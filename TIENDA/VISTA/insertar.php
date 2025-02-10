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
                <a href="listaamigos.php?action=insertarAmigos" class="pixel-button">Insertar amigos</a>
                <a href="listaamigos.php?action=buscador" class="pixel-button ms-3">Buscar amigos</a>
            </div>
        </section>
        
        


        </section>
        <?php 
            if (isset($amigo)) {
                ?>
                      <section class="container mt-4">
                            <h1 class="text-center pixel-text mb-4">Modificar Amigo</h1>
                            <form action="listaamigos.php?action=actualizar" method="POST" class="block-effect p-4">
                             <input type="hidden" name="id_amigo" value="<?php echo $amigo->id_amigo; ?>">
                                
                                <div class="mb-3">
                                    <label for="nombre" class="form-label pixel-text">Nombre:</label>
                                    <input type="text" class="pixel-input form-control" id="nombre" name="nombre" value="<?php echo $amigo->nombre; ?>" required pattern="^[^\s]+$">>
                                </div>

                                <div class="mb-3">
                                    <label for="apellido" class="form-label pixel-text">Apellido:</label>
                                    <input type="text" class="pixel-input form-control" id="apellido" name="apellido" value="<?php echo $amigo->apellido; ?>" required pattern="^[^\s]+$">>
                                </div>

                                <div class="mb-3">
                                    <label for="fecha_nacimiento" class="form-label pixel-text">Fecha de Nacimiento:</label>
                                    <input type="date" class="pixel-input form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo date('Y-m-d', strtotime(str_replace('/', '-', $amigo->fecha))); ?>" required>
                                </div>
                                
                                    <?php 
                                    if (strcmp($user, "ADMIN") == 0) {
                                        echo '<select name="id_user" id="">';
                                        foreach ($listausuarios as $usuarios) {
                                            echo "<option value=".$usuarios->id_usuarios.">".$usuarios->nombre_usuario."</option>";
                                        }
                                        echo "</select>";
                                    }
                                        
                                    ?>
                                <div class="text-center">
                                    <button type="submit" class="pixel-button">Actualizar</button>
                                </div>
                            </form>
                        </section>
                <?php
            }else{
                ?>
                    <section class="row justify-content-center">
                        <div class="col-md-8">
                            <h2 class="text-center mb-4 pixel-text">Formulario de Amigo</h2>
                            <form action="../CONTROLADOR/listaamigos.php?action=insert" method="post" class="block-effect p-4">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label pixel-text">Nombre de tu amigo:</label>
                                    <input type="text" id="nombre" name="nombre" class="pixel-input form-control" required pattern="^[^\s]+$">
                                </div>

                                <div class="mb-3">
                                    <label for="apellido" class="form-label pixel-text">Apellido de tu amigo:</label>
                                    <input type="text" id="apellido" name="apellido" class="pixel-input form-control" required pattern="^[^\s]+$">
                                </div>

                                <div class="mb-3">
                                    <label for="fecha_nacimiento" class="form-label pixel-text">Fecha de nacimiento:</label>
                                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="pixel-input form-control" required>
                                </div>
                                <?php 
                                    if (strcmp($user, "ADMIN") == 0) {
                                        echo '<select name="idUser" id="">';
                                        foreach ($listausuarios as $usuarios) {
                                            echo "<option value=".$usuarios->id_usuarios.">".$usuarios->nombre_usuario."</option>";
                                        }
                                        echo "</select>";
                                    }
                                        
                                    ?>
                                <div class="text-center">
                                    <button type="submit" class="pixel-button">>Agregar Amigo</button>
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