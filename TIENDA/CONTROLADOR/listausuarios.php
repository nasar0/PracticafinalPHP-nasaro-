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
        session_start();
        $user = $_SESSION['user'];
        $amigos = new usuarios();
        $listausuarios=$amigos->mostrarUsuarios();
        require_once("../VISTA/usuarios.php");
    }
    function buscadorUsuarios(){
        require_once("../VISTA/buscadorUsuarios.php");
    }
    function buscador(){
        $usuarios = new usuarios();
        session_start();
        $user = $_SESSION['user'];
        $listausuarios = $usuarios->listarUsuarios($_POST["bucador"]);
        require_once("../VISTA/usuarios.php");
    }


    if(isset($_REQUEST['action'])){
        $action = $_REQUEST['action'];
        $action();
        
    }else{
        login();
    }


?>