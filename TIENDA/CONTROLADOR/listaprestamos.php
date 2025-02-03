<?php
    require_once("../MODELO/class-prestamos.php");
    require_once("../MODELO/class-juegos.php");
    require_once("../MODELO/class-amigos.php");
    function mostrarPrestamos(){
        $prestamo = new prestamos();
        session_start();
        $user = $_SESSION['user'];
        $listaPrestamos=$prestamo->mostrar($user);
        require_once("../VISTA/prestamos.php");
    }
    function  insertarPrestamo(){ 
        session_start(); 
        $user = $_SESSION['user'];
        $jue = new juegos();
        $ami = new amigos();
        $amigo =$ami->selectPrestamoAmigos($user);
        $juego =$jue->selectPrestamoJuegos($user);
        require_once("../VISTA/insertarPrestamos.php");
    }
    function insert(){
        session_start();
        $user = $_SESSION['user'];
        $prestamo = new prestamos();
        $prestamo->insert($_POST["amigo"],$_POST["juego"],$_POST["fecha_prestamo"],$user);
    }
    function buscador()
    {
        require_once("../VISTA/buscadorPrestamos.php");
    }
    function buscadorPrestamos()
    {
        $prestamo = new prestamos();
        session_start();
        $user = $_SESSION['user'];
        $listaPrestamos = $prestamo->buscar($_POST["bucador"], $user);
        require_once("../VISTA/prestamos.php");
    }
    function devolver(){
        $prestamo = new prestamos();
        $id_prestamo = $_GET['id'];
        $prestamo->devolver($id_prestamo);
    }
    if (isset($_REQUEST['action'])) {
        $action = $_REQUEST['action'];
        $action();
    } else {
        mostrarPrestamos();
    }
?>