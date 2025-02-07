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
        $user=0;
        echo "<br>".$_POST['idUser']."<br>";
        if (isset($_POST['idUser'])) {
            $user = $_POST['idUser'];
            $user=intval($user)
        }else{
            session_start();
            $user = $_SESSION['user'];
        }
        echo "<br>".$user."<br>";
        $amigos->insertarAmigos($_POST["nombre"],$_POST["apellido"],$_POST["fecha_nacimiento"],$user);
    }
    function insertarAmigos(){
        require_once("../MODELO/class-usuarios.php");
        if (isset($_GET['id'])) {
            $amigos = new amigos();
            $id_amigo = $_GET['id']; 
            $amigo = $amigos->obtenerAmigo($id_amigo); 
        }
        $usuarios = new usuarios();
        $listausuarios=$usuarios->mostrarUsuarios();
        
        require_once("../VISTA/insertar.php");
    }

    function buscar() {
        $amigos = new amigos();
        session_start();
        $user = $_SESSION['user'];
        $listaAmigos = $amigos->listarAmigosNombre($_POST["bucador"],$user);
        require_once("../VISTA/amigos.php");
    }
    
    function actualizar() {
        $amigos = new amigos();
        $id_amigo = $_POST['id_amigo'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
    
        if ($amigos->modificarAmigo($id_amigo, $nombre, $apellido, $fecha_nacimiento)) {
            echo "Amigo actualizado correctamente.";
        } else {
            echo "Error al actualizar el amigo.";
        }
    
        header("Location: listaamigos.php?action=mostrar");
        exit;
    }
  
    
   
    if (isset($_REQUEST['action'])) {
        $action = $_REQUEST['action'];
        $action();
    } else {
        mostrar();
    }
?>