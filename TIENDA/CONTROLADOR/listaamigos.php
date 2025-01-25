<?php
require_once("../MODELO/class-amigos.php");

function mostrar()
{
    $amigos = new amigos();
    session_start();
    $user = $_SESSION['user'];
    $listaAmigos = $amigos->listarColegas($user);
    require_once("../VISTA/amigos.php");
}

function buscador(){
    require_once("../VISTA/buscador.php");
}
function insert(){
    $amigos = new amigos();
    $amigos->insertarAmigos($_POST["nombre"],$_POST["apellido"],$_POST["fecha_nacimiento"]);
}
function insertarAmigos(){
    require_once("../VISTA/insertar.php");
}

function buscar() {
    $amigos = new amigos();
    session_start();
    $user = $_SESSION['user'];
    $listaAmigos = $amigos->listarAmigosNombre($_POST["bucador"],$user);
    require_once("../VISTA/amigos.php");
}

if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
    $action();
} else {
    mostrar();
}
