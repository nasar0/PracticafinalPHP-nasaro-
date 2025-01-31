<?php
    require_once("../MODELO/class-prestamos.php");
    function mostrarPrestamos(){
        $prestamo = new prestamos();
        session_start();
        $user = $_SESSION['user'];
        $listaPrestamos=$prestamo->mostrar($user);
        require_once("../VISTA/prestamos.php");
    }
    if (isset($_REQUEST['action'])) {
        $action = $_REQUEST['action'];
        $action();
    } else {
        mostrarPrestamos();
    }
?>