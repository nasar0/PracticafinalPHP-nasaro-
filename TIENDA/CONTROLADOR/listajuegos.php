<?php
    require_once("../MODELO/class-juegos.php");
    function mostrarJuegos()
    {
        $juegos = new juegos();
        session_start();
        $user = $_SESSION['user'];
        echo $user;
        $listaJuegos = $juegos->listarJuegos($user);
        require_once("../VISTA/juegos.php");
    }
    function modificarJuego() {
        $juegos = new juegos();
        $id_juego = $_GET['id']; 
        $id_usuario = $_GET['id2'];
        $juego = $juegos->obtenerAmigo($id_juego,$id_usuario); 
        require_once("../VISTA/modificar_juego.php"); 
    }
    function actualizar() {
        $juegos = new juegos();
        $id_juego = $_POST['id_juego'];
        $titulo = $_POST['titulo'];
        $plataforma = $_POST['plataforma'];
        $anio_lanzamiento = $_POST['anio_lanzamiento'];
        $foto=$_POST['foto'];
    
        if ($juegos->modificarJuego($id_juego, $titulo, $plataforma, $anio_lanzamiento,$foto)) {
            echo "Amigo actualizado correctamente.";
        } else {
            echo "Error al actualizar el amigo.";
        }
    
        header("Location: listaamigos.php?action=mostrar");
        exit;
    }
    if (isset($_REQUEST['action'])) {
        $action = $_REQUEST['action'];
        $action();
    } else {
        mostrar();
    }
?>