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
        }
    }

    if(isset($_REQUEST['action'])){
        $action = $_REQUEST['action'];
        $action();
        
    }else{
        login();
    }


?>