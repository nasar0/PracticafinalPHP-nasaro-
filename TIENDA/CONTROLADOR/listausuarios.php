<?php
    // Se incluye el archivo de la clase usuarios
    require_once("../MODELO/class-usuarios.php");

    // Función para mostrar la vista de login
    function login(){
        require_once('../VISTA/index.php');
    }

    // Función para manejar el inicio de sesión
    function inicio(){
        $user = $_POST["user"]; // Se obtiene el usuario del formulario
        $pass = $_POST["pass"]; // Se obtiene la contraseña del formulario
        $usr = new usuarios();
        $validacion = $usr->iniciar_sesion($user, $pass); // Se verifica si el usuario es válido

        session_start(); // Se inicia la sesión
        $_SESSION['user'] = $user; // Se guarda el usuario en la sesión

        // Si el usuario marcó "mantener sesión iniciada", se guarda en una cookie por 30 días
        if (isset($_POST["mantener"])) {
            setcookie("user", $user, time() + (86400 * 30), "/");
        }

        // Si la validación es correcta, se redirige a lista de amigos, si no, a lista de usuarios
        if ($validacion) {
            header("Location: listaamigos.php");
        } else {
            header("Location: listausuarios.php");
        }
    }

    // Función para obtener y mostrar la lista de usuarios
    function usuarios(){
        $amigos = new usuarios();
        $listausuarios = $amigos->mostrarUsuarios();
        require_once("../VISTA/usuarios.php");
    }

    // Función para mostrar la vista del buscador de usuarios
    function buscadorUsuarios(){
        require_once("../VISTA/buscadorUsuarios.php");
    }

    // Función para buscar usuarios en la base de datos
    function buscador(){
        $usuarios = new usuarios();
        // Se obtiene el valor del campo "bucador" del formulario
        $listausuarios = $usuarios->listarUsuarios($_POST["bucador"]);
        require_once("../VISTA/usuarios.php");
    }

    // Función para insertar un nuevo usuario
    function insertarUsuario(){
        if (isset($_GET['id'])) {
            $user = new usuarios();
            $id_usu = $_GET['id'];
            $usu = $user->obtenerUsuario($id_usu); // Se obtiene la información del usuario a insertar
        }
        require_once("../VISTA/insertarUsuario.php");
    }

    // Función para insertar un usuario en la base de datos
    function insert() {
        $usuarios = new usuarios();
        // Se comprueba que las dos contraseñas coincidan antes de insertar el usuario
        if (strcmp($_POST["pass"], $_POST["pass2"]) == 0) {
            $usuarios->insertarAmigos($_POST["nombre"], $_POST["pass"]);
        }
    }

    // Función para actualizar un usuario
    function actualizar(){
        $user = new usuarios();
        // Si la nueva contraseña está vacía, se mantiene la anterior
        if (strcmp($_POST["pass1"], "") == 0) {
            $user->modificarUsuario($_POST["id_usuario"], $_POST["nombre"], $_POST["pass"]);
        } else {
            $user->modificarUsuario($_POST["id_usuario"], $_POST["nombre"], $_POST["pass1"]);
        }

        // Redirección a la lista de usuarios después de actualizar
        header("Location: ../CONTROLADOR/listausuarios.php?action=usuarios");
    }

    // Verifica si hay una acción en la solicitud y la ejecuta
    if(isset($_REQUEST['action'])){
        $action = $_REQUEST['action'];
        $action(); // Llama a la función con el nombre especificado en `action`
    } else {
        login(); // Si no hay acción especificada, muestra la pantalla de login
    }
?>
