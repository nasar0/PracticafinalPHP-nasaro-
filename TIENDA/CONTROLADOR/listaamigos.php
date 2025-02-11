<?php
    // Se requiere la clase "amigos" del modelo
    require_once("../MODELO/class-amigos.php");

    // Función para mostrar la lista de amigos
    function mostrar() {
        $amigos = new amigos();
        $user = $_SESSION['user']; // Se obtiene el usuario de la sesión
        $listaAmigos = $amigos->listarColegas($user); // Se obtiene la lista de amigos del usuario
        require_once("../VISTA/amigos.php"); // Se carga la vista de amigos
    }

    // Función para mostrar la vista del buscador
    function buscador() {
        require_once("../VISTA/buscador.php");
    }

    // Función para insertar un nuevo amigo
    function insert() {
        $amigos = new amigos();
        $user = 0;
        echo "<br>" . $_POST['idUser'] . "<br>";

        // Se verifica si se envió un ID de usuario por POST
        if (isset($_POST['idUser'])) {
            $user = $_POST['idUser'];
            $user = intval($user); // Se convierte a entero
        } else {
            session_start();
            $user = $_SESSION['user']; // Se obtiene el usuario de la sesión si no se envió por POST
        }
        echo "<br>" . $user . "<br>";

        // Se inserta el amigo en la base de datos con los datos recibidos por POST
        $amigos->insertarAmigos($_POST["nombre"], $_POST["apellido"], $_POST["fecha_nacimiento"], $user);

        // Redirección a la lista de amigos
        header("Location: ../CONTROLADOR/listaamigos.php");
    }

    // Función para insertar un amigo (parece una variante de `insert()`, pero con más lógica)
    function insertarAmigos() {
        require_once("../MODELO/class-usuarios.php");

        // Se verifica si se envió un ID de amigo por GET
        if (isset($_GET['id'])) {
            $amigos = new amigos();
            $id_amigo = $_GET['id'];
            $amigo = $amigos->obtenerAmigo($id_amigo); // Se obtiene la información del amigo
        }

        // Se obtiene la lista de usuarios
        $usuarios = new usuarios();
        $listausuarios = $usuarios->mostrarUsuarios();

        // Se carga la vista de insertar amigos
        require_once("../VISTA/insertar.php");
    }

    // Función para buscar amigos por nombre
    function buscar() {
        $amigos = new amigos();
        session_start();
        $user = $_SESSION['user']; // Se obtiene el usuario de la sesión
        // Se busca en la base de datos según el nombre ingresado en el formulario
        $listaAmigos = $amigos->listarAmigosNombre($_POST["bucador"], $user);
        require_once("../VISTA/amigos.php"); // Se carga la vista con los resultados
    }

    // Función para actualizar la información de un amigo
    function actualizar() {
        $amigos = new amigos();
        $id_amigo = $_POST['id_amigo']; // Se obtiene el ID del amigo a modificar
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];

        // Se obtiene el ID del usuario actual
        if (isset($_POST["id_user"])) {
            $id_usu = $_POST["id_user"];
        } else {
            session_start();
            $user = $_SESSION['user'];
            $id_usu = $amigos->obtenerIDuser($user);
        }

        // Se intenta modificar el amigo en la base de datos
        if ($amigos->modificarAmigo($id_amigo, $nombre, $apellido, $fecha_nacimiento, $id_usu)) {
            echo "Amigo actualizado correctamente.";
        } else {
            echo "Error al actualizar el amigo.";
        }

        // Redirección a la lista de amigos tras la actualización
        header("Location: listaamigos.php?action=mostrar");
        exit;
    }

    // Verifica si hay una acción en la solicitud y la ejecuta
    session_start();
    if (isset($_SESSION['user'])){
        if (isset($_REQUEST['action'])) {
            $action = $_REQUEST['action'];
            $action(); // Llama a la función con el nombre especificado en `action`
        } else {
            mostrar(); // Si no hay acción especificada, muestra la lista de amigos por defecto
        } 
    }else{
        header("Location: ../VISTA/index.php");
    }
        
    
    
?>
