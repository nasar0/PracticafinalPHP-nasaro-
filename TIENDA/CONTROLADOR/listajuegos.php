<?php
    require_once("../MODELO/class-juegos.php");
    function mostrarJuegos()
    {
        $juegos = new juegos();
        session_start();
        $user = $_SESSION['user'];
        $listaJuego = $juegos->listarJuegos($user);
        require_once("../VISTA/juegos.php");
    }
    function modificarJuego()
    {
        $juegos = new juegos();
        $id_juego = $_GET['id'];
        $id_usuario = $_GET['id2'];
        $juego = $juegos->obtenerAmigo($id_juego, $id_usuario);
        require_once("../VISTA/modificar_juego.php");
    }
    function actualizar()
    {
        $juegos = new juegos();
        $id_juego = $_POST['id_juego'];
        $titulo = $_POST['titulo'];
        $plataforma = $_POST['plataforma'];
        $anio_lanzamiento = $_POST['anio_lanzamiento'];
        session_start();
        $user = $_SESSION['user'];
        $ruta = "../img/" . $user . "/";

        if (!is_dir($ruta)) mkdir($ruta);

        if (isset($_FILES['foto'])) {
            $foto = $_FILES['foto']['name'];
            $ruta_temporal = $_FILES['foto']['tmp_name'];
            $ruta_destino = $ruta . $foto;

            if (move_uploaded_file($ruta_temporal, $ruta_destino)) {
                echo "La imagen se ha subido correctamente y se ha guardado en: " . $ruta_destino;
            } else {
                echo "Hubo un error al mover el archivo a la carpeta de destino.";
            }
            $fotoRuta = "../img/$user/" . $juegos->obtenerFoto($id_juego);
            unlink($fotoRuta);
        } else {
            $foto = null;
        }

        if ($juegos->modificarJuego($id_juego, $titulo, $plataforma, $anio_lanzamiento, $foto)) {
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
        mostrarJuegos();
    }
    function buscador()
    {
        require_once("../VISTA/buscadorJuegos.php");
    }



    function insert()
    {
        $juegos = new juegos();
        session_start();
        $user = $_SESSION['user'];
        $foto = $_FILES['foto']['name'];
        $juegos->insertarJuegos($user, $_POST["titulo"], $_POST["plataforma"], $_POST["anio_lanzamiento"], $foto);
        $ruta = "../img/" . $user . "/";
        $ruta_temporal = $_FILES['foto']['tmp_name'];
        $ruta_destino = $ruta . $foto;

        if (move_uploaded_file($ruta_temporal, $ruta_destino)) {
            echo "La imagen se ha subido correctamente y se ha guardado en: " . $ruta_destino;
        } else {
            echo "Hubo un error al mover el archivo a la carpeta de destino.";
        }
    }
    function insertarJuego()
    {
        require_once("../VISTA/insertarJuego.php");
    }




    function buscar()
    {
        $juego = new juegos();
        session_start();
        $user = $_SESSION['user'];
        $listaJuego = $juego->listarJuegosNombre($_POST["bucador"], $user);
        require_once("../VISTA/juegos.php");
    }
?>