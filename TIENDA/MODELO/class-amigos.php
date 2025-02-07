<?php
require_once("class-conexion.php");
class amigos
{
    private $db;
    private $id_amigo;
    private $id_usuario;
    private $nombre;
    private $apellido;
    private $fecha;
    public function __construct()
    {
        $this->db = new con();
        $this->id_amigo = -1;
        $this->id_usuario = -1;
        $this->nombre = "";
        $this->apellido = "";
        $this->fecha = "";
    }
    public function listarColegas($nom)
    {
        if (strcmp($nom, "ADMIN") == 0) {
            $sent = "SELECT amigos.id_amigo,amigos.id_usuario,amigos.nombre,amigos.apellido,amigos.fecha_nacimiento,usuarios.nombre_usuario from amigos , usuarios where usuarios.id_usuario=amigos.id_usuario;";
        } else {
            $sent = "SELECT amigos.id_amigo,amigos.id_usuario,amigos.nombre,amigos.apellido,amigos.fecha_nacimiento from amigos , usuarios where usuarios.id_usuario=amigos.id_usuario and usuarios.nombre_usuario=? ";
        }
        $consulta = $this->db->getCon()->prepare($sent);
        if (strcmp($nom, "ADMIN") != 0) {
            $consulta->bind_param("s", $nom);
            $consulta->bind_result($id_amigo, $id_usuario, $nombre, $apellido, $fecha);
        }else{
            $consulta->bind_result($id_amigo, $id_usuario, $nombre, $apellido, $fecha,$usuNom);
        }
        $consulta->execute();
        $amigos = []; 

        while ($consulta->fetch()) {
            $amigo = new stdClass();
            $amigo->id_amigo = $id_amigo;
            $amigo->id_usuario = $id_usuario;
            $amigo->nombre = $nombre;
            $amigo->apellido = $apellido;
            $timestamp = strtotime($fecha);
            $fecha = date("d/m/Y", $timestamp);
            $amigo->fecha = $fecha;
            if (strcmp($nom, "ADMIN") == 0) $amigo->usuNom = $usuNom;
            $amigos[] = $amigo;
        }

        $consulta->close();
        return $amigos;
    }

    public function __get($nom)
    {
        return $this->$nom;
    }

    public function listarAmigosNombre($string,$nom){
        $sent="";
        $regex = $string."%";
        if (strcmp($nom, "ADMIN") == 0) {
            $sent= "SELECT amigos.id_amigo, amigos.id_usuario, amigos.nombre, amigos.apellido, amigos.fecha_nacimiento FROM amigos, usuarios WHERE usuarios.id_usuario = amigos.id_usuario AND amigos.nombre LIKE ? ";
        } else {
            $sent= "SELECT amigos.id_amigo, amigos.id_usuario, amigos.nombre, amigos.apellido, amigos.fecha_nacimiento FROM amigos, usuarios WHERE usuarios.id_usuario = amigos.id_usuario AND amigos.nombre LIKE ?  and usuarios.nombre_usuario=? ";
        }
        $consulta = $this->db->getCon()->prepare($sent);
        if (strcmp($nom, "ADMIN") == 0) {
            $consulta->bind_param("s",$regex);
        }else{
            $consulta->bind_param("ss",$regex, $nom);
        }
        $consulta->bind_result($id_amigo, $id_usuario, $nombre, $apellido, $fecha);
        $consulta->execute();
        $amigos = [];
        while ($consulta->fetch()) {
            $amigo = new amigos();
            $amigo->id_amigo = $id_amigo;
            $amigo->id_usuario = $id_usuario;
            $amigo->nombre = $nombre;
            $amigo->apellido = $apellido;
            $timestamp = strtotime($fecha);
            $fecha = date("d/m/Y", $timestamp);
            $amigo->fecha = $fecha;
            $amigos[] = $amigo;
        }

        $consulta->close();
        return $amigos;
    }
    public function obtenerIDuser(String $user){
        $sent = "SELECT id_usuario FROM usuarios WHERE nombre_usuario = ?";
        $consulta = $this->db->getCon()->prepare($sent);
        $consulta->bind_param("s",$user);
        $consulta->bind_result($num);
        $consulta->execute();
        $consulta->fetch();

        return $num;
    }

    public function insertarAmigos($nom, $ape, $fec,$user) {
        echo $fec;
        $idUsu=0;
        echo "<br>".$user."<br>";
        if (is_string($user)) {
            echo "hola";
            $usu=new amigos();
            $idUsu=$usu->obtenerIDuser($user);
        }else{
            $idUsu=$user;
        }
        echo $idUsu;
        if (time()<strtotime($fec)) {
            // header("Location: ../CONTROLADOR/listaamigos.php");
        }else{
            try {
                $sent = "INSERT INTO amigos (id_usuario,nombre,apellido,fecha_nacimiento) VALUES (?,?,?,?)";
                $consulta = $this->db->getCon()->prepare($sent);
        
                $consulta->bind_param("isss",$idUsu,$nom,$ape,$fec);
        
                if ($consulta->execute()) {
                    echo "Amigo insertado correctamente.";
                    // header("Location: ../CONTROLADOR/listaamigos.php");
                } else {
                    echo "Error al insertar el amigo.";
                    // header("Location: ../CONTROLADOR/listaamigos.php");
                }
            } catch (Exception $e) {
                echo "No se puede insertar: " . $e->getMessage();
            }
        }
        

    }
    public function obtenerAmigo($id_amigo) {
        $sent = "SELECT id_amigo, nombre, apellido, fecha_nacimiento FROM amigos WHERE id_amigo = ?";
        $consulta = $this->db->getCon()->prepare($sent);
        $consulta->bind_param("i", $id_amigo);
        $consulta->bind_result($id_amigo, $nombre, $apellido, $fecha_nacimiento);
        $consulta->execute();
        $consulta->fetch();
    
        $amigo = new amigos();
        $amigo->id_amigo = $id_amigo;
        $amigo->nombre = $nombre;
        $amigo->apellido = $apellido;
        $amigo->fecha = date("d/m/Y", strtotime($fecha_nacimiento));
    
        return $amigo;
    }
    public function modificarAmigo($id_amigo, $nombre, $apellido, $fecha_nacimiento) {
        echo $id_amigo;
        try {
            $sent = "UPDATE amigos SET nombre = ?, apellido = ?, fecha_nacimiento = ? WHERE id_amigo = ?";
            $consulta = $this->db->getCon()->prepare($sent);
    
            $consulta->bind_param("sssi", $nombre, $apellido, $fecha_nacimiento, $id_amigo);
    
            if ($consulta->execute()) {
                return true; 
            } else {
                return false; 
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
        // header("Location: ../VISTA/amigos.php");

    } 
    public function selectPrestamoAmigos($user){
        $sent ="SELECT amigos.id_amigo ,amigos.nombre FROM amigos , usuarios WHERE usuarios.id_usuario = amigos.id_usuario and usuarios.nombre_usuario=?";
        $consulta = $this->db->getCon()->prepare($sent);

        $consulta->bind_param("s", $user);

        $consulta->bind_result($id_amigo, $nombre);

        $consulta->execute();

        $amigos = []; 

        while ($consulta->fetch()) {
            $amigos[$id_amigo] = $nombre;  
        }

        $consulta->close();

        return $amigos;  

    }
    
    
   

}


