<?php
    require_once("../MODELO/class-usuarios.php");
    
    function login(){
        require_once('../VISTA/index.php');
    }

    function inicio(){
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        $usr=new usuarios();
        $validacion=$usr->iniciar_sesion($user,$pass);
        
        session_start();
        $_SESSION['user'] = $user;


        if (isset($_POST["mantener"])) {
            setcookie("user",$user,time()+(86400*30),"/");
        }
        if ($validacion) {
            header("Location: listaamigos.php");
        }else{
            header("Location: listausuarios.php");
        }
    } 
    function usuarios(){
        $amigos = new usuarios();
        $listausuarios=$amigos->mostrarUsuarios();
        require_once("../VISTA/usuarios.php");
    }
    function buscadorUsuarios(){
        require_once("../VISTA/buscadorUsuarios.php");
    }
    function buscador(){
        $usuarios = new usuarios();
        $listausuarios = $usuarios->listarUsuarios($_POST["bucador"]);
        require_once("../VISTA/usuarios.php");
    }
    function insertarUsuario(){
        if (isset($_GET['id'])) {
            $user = new usuarios();
            $id_usu = $_GET['id']; 
            $usu = $user->obtenerUsuario($id_usu); 
        }
        require_once("../VISTA/insertarUsuario.php");
    }
    function insert() {
        $usuarios = new usuarios();
        if (strcmp($_POST["pass"], $_POST["pass2"]) == 0)$usuarios->insertarAmigos($_POST["nombre"],$_POST["pass"]);
    }
    function actualizar(){
        $user = new usuarios();
        if (strcmp($_POST["pass1"], "") == 0) {
            $user->modificarUsuario($_POST["id_usuario"],$_POST["nombre"],$_POST["pass"]);  
        }else{
            $user->modificarUsuario($_POST["id_usuario"],$_POST["nombre"],$_POST["pass1"]);
        }
        header("Location: ../CONTROLADOR/listausuarios.php?action=usuarios");
    }
    
    if(isset($_REQUEST['action'])){
        $action = $_REQUEST['action'];
        $action();
        
    }else{
        login();
    }


?>