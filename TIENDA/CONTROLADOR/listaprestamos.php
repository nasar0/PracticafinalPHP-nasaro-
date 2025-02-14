<?php
    // Se requieren los modelos necesarios
    require_once("../MODELO/class-prestamos.php");
    require_once("../MODELO/class-juegos.php");
    require_once("../MODELO/class-amigos.php");

    // Función para mostrar la lista de préstamos
    function mostrarPrestamos(){
        $prestamo = new prestamos();
        $user = $_SESSION['user']; // Se obtiene el usuario de la sesión
        $listaPrestamos = $prestamo->mostrar($user); // Se obtienen los préstamos del usuario
        require_once("../VISTA/prestamos.php"); // Se carga la vista de préstamos
    }

    // Función para mostrar el formulario de inserción de préstamos
    function insertarPrestamo(){ 
        session_start(); 
        $user = $_SESSION['user']; // Se obtiene el usuario de la sesión
        $jue = new juegos(); // Se crea una instancia de la clase juegos
        $ami = new amigos(); // Se crea una instancia de la clase amigos
        $amigo = $ami->selectPrestamoAmigos($user); // Se obtiene la lista de amigos disponibles para préstamo
        $juego = $jue->selectPrestamoJuegos($user); // Se obtiene la lista de juegos disponibles para préstamo
        require_once("../VISTA/insertarPrestamos.php"); // Se carga la vista de insertar préstamos
    }

    // Función para insertar un nuevo préstamo en la base de datos
    function insert(){
        session_start();
        $user = $_SESSION['user']; // Se obtiene el usuario de la sesión
        $prestamo = new prestamos(); // Se crea una instancia de la clase préstamos
        // Se inserta el préstamo con los datos enviados por el formulario
        $prestamo->insert($_POST["amigo"], $_POST["juego"], $_POST["fecha_prestamo"], $user);
        // Se redirige a la lista de préstamos
        header("Location: ../CONTROLADOR/listaprestamos.php");
    }

    // Función para mostrar el buscador de préstamos
    function buscador() {
        require_once("../VISTA/buscadorPrestamos.php");
    }

    // Función para buscar préstamos en la base de datos
    function buscadorPrestamos() {
        $prestamo = new prestamos();
        // session_start();
        $user = $_SESSION['user']; // Se obtiene el usuario de la sesión
        // Se busca el préstamo por el término ingresado en el formulario
        $listaPrestamos = $prestamo->buscar($_POST["bucador"], $user);
        require_once("../VISTA/prestamos.php"); // Se carga la vista con los resultados
    }

    // Función para marcar un préstamo como devuelto
    function devolver(){
        $prestamo = new prestamos();
        $id_prestamo = $_GET['id']; // Se obtiene el ID del préstamo a devolver
        $prestamo->devolver($id_prestamo); // Se procesa la devolución
        // Se redirige a la lista de préstamos
        header("Location: ../CONTROLADOR/listaprestamos.php");
    }

    
    
     session_start();
     if (isset($_SESSION['user'])){
        // Verifica si hay una acción en la solicitud y la ejecuta
        if (isset($_REQUEST['action'])) {
            $action = $_REQUEST['action'];
            $action(); // Llama a la función con el nombre especificado en `action`
        } else {
            mostrarPrestamos(); // Si no hay acción especificada, muestra la lista de préstamos por defecto
        }// Verifica si hay una acción en la solicitud y la ejecuta
     }else{
         header("Location: ../VISTA/index.php");
     }
?>
