<?php
    // Se requiere la clase "juegos" del modelo
    require_once("../MODELO/class-juegos.php");

    // Función para mostrar la lista de juegos del usuario
    function mostrarJuegos() {
        $juegos = new juegos();
        session_start(); // Se inicia la sesión
        $user = $_SESSION['user']; // Se obtiene el usuario de la sesión
        $listaJuego = $juegos->listarJuegos($user); // Se obtiene la lista de juegos
        require_once("../VISTA/juegos.php"); // Se carga la vista de juegos
    }

    // Función para actualizar un juego existente
    function actualizar() {
        $juegos = new juegos();
        $id_juego = $_POST['id_juego'];
        $titulo = $_POST['titulo'];
        $plataforma = $_POST['plataforma'];
        $anio_lanzamiento = $_POST['anio_lanzamiento'];
        
        session_start();
        $user = $_SESSION['user']; // Se obtiene el usuario de la sesión
        $ruta = "../img/" . $user . "/"; // Se define la ruta donde se guardarán las imágenes

        // Si la carpeta de imágenes del usuario no existe, se crea
        if (!is_dir($ruta)) mkdir($ruta);

        // Verifica si se ha subido una nueva imagen
        if (isset($_FILES['foto'])) {
            $foto = $_FILES['foto']['name']; // Nombre del archivo
            $ruta_temporal = $_FILES['foto']['tmp_name']; // Ruta temporal
            $ruta_destino = $ruta . $foto; // Ruta de destino

            // Se mueve la imagen a la carpeta de destino
            if (move_uploaded_file($ruta_temporal, $ruta_destino)) {
                echo "La imagen se ha subido correctamente y se ha guardado en: " . $ruta_destino;
            } else {
                echo "Hubo un error al mover el archivo a la carpeta de destino.";
            }

            // Se elimina la imagen anterior del juego
            $fotoRuta = "../img/$user/" . $juegos->obtenerFoto($id_juego);
            unlink($fotoRuta);
        } else {
            $foto = null; // Si no hay imagen nueva, se mantiene la anterior
        }

        // Se actualiza el juego en la base de datos
        if ($juegos->modificarJuego($id_juego, $titulo, $plataforma, $anio_lanzamiento, $foto)) {
            echo "Juego actualizado correctamente.";
        } else {
            echo "Error al actualizar el juego.";
        }

        // Redirección a la lista de juegos
        header("Location: ../CONTROLADOR/listajuegos.php");
        exit;
    }

    // Verifica si hay una acción en la solicitud y la ejecuta
    if (isset($_REQUEST['action'])) {
        $action = $_REQUEST['action'];
        $action(); // Llama a la función con el nombre especificado en `action`
    } else {
        mostrarJuegos(); // Si no hay acción especificada, se muestran los juegos
    }

    // Función para mostrar la vista del buscador de juegos
    function buscador() {
        require_once("../VISTA/buscadorJuegos.php");
    }

    // Función para insertar un nuevo juego
    function insert() {
        $juegos = new juegos();
        session_start();
        $user = $_SESSION['user']; // Se obtiene el usuario de la sesión
        $foto = $_FILES['foto']['name']; // Se obtiene el nombre de la imagen

        // Se inserta el nuevo juego en la base de datos
        $juegos->insertarJuegos($user, $_POST["titulo"], $_POST["plataforma"], $_POST["anio_lanzamiento"], $foto);

        $ruta = "../img/" . $user . "/"; // Se define la ruta para guardar la imagen
        $ruta_temporal = $_FILES['foto']['tmp_name'];
        $ruta_destino = $ruta . $foto;

        // Se mueve la imagen a la carpeta del usuario
        if (move_uploaded_file($ruta_temporal, $ruta_destino)) {
            echo "La imagen se ha subido correctamente y se ha guardado en: " . $ruta_destino;
        } else {
            echo "Hubo un error al mover el archivo a la carpeta de destino.";
        }

        // Redirección a la lista de juegos
        header("Location: ../CONTROLADOR/listajuegos.php");
    }

    // Función para insertar un juego (parece más relacionada con la obtención de datos para la vista)
    function insertarJuego() {
        if (isset($_GET['id'])) {
            $juegos = new juegos();
            $id_juego = $_GET['id'];
            $id_usuario = $_GET['id2'];
            $juego = $juegos->obtenerJuego($id_juego, $id_usuario); // Se obtiene el juego específico
        }
        require_once("../VISTA/insertarJuego.php"); // Se carga la vista para insertar juegos
    }

    // Función para buscar juegos por nombre
    function buscar() {
        $juego = new juegos();
        session_start();
        $user = $_SESSION['user']; // Se obtiene el usuario de la sesión
        $listaJuego = $juego->listarJuegosNombre($_POST["bucador"], $user); // Se busca en la base de datos
        require_once("../VISTA/juegos.php"); // Se carga la vista con los resultados
    }
?>
