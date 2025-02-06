<?php if (!isset($_SESSION['user']))  session_start(); $user = $_SESSION['user']; ?> 

<header class="container-fluid">
        <nav class="container d-flex justify-content-between align-items-center">
            <div class="pixel-text">AGENDA PERSONAL</div>
            <div>
                <?php
                    if (strcmp($user, "ADMIN") == 0) {
                        echo '<a href="listaamigos.php?action=mostrar" class="pixel-button">Contactos</a>';
                    } else {
                        echo '<a href="listaamigos.php?action=mostrar" class="pixel-button">Amigos</a>';
                    }
                ?>
                <?php
                    if (strcmp($user, "ADMIN") != 0) {
                        echo '<a href="listajuegos.php?action=mostrarJuegos" class="pixel-button">Juegos</a>';
                    } 
                ?>
                <?php
                if (strcmp($user, "ADMIN") == 0) {
                    echo '<a href="listausuarios.php?action=usuarios" class="pixel-button">Usuarios</a>';
                } else {
                    echo '<a href="listaprestamos.php?action=mostrarPrestamos" class="pixel-button">Préstamos</a>';
                }
                ?>
                <a href="../VISTA/index.php" class="pixel-button">Salir</a>
            </div>
        </nav>
    </header>