<?php
require_once("class-conexion.php");
class prestamos
{
    private $db;
    private $id_prestamo;
    private $id_amigo;
    private $id_juego;
    private $fecha;
    private $devuelto;
    private $id_usuario;

    public function __construct()
    {
        $this->db = new con();
        $this->id_prestamo = -1;
        $this->id_amigo = -1;
        $this->id_juego = -1;
        $this->fecha = "";
        $this->devuelto = -1;
        $this->id_usuario = -1;
    }
    public function __get($nom)
    {
        return $this->$nom;
    }
    public function mostrar($user)
    {
        $sent = "SELECT prestamos.id_prestamo,amigos.nombre,juegos.foto,prestamos.fecha_prestamo,prestamos.devuelto from juegos ,amigos ,usuarios ,prestamos WHERE amigos.id_amigo=prestamos.id_amigo and prestamos.id_juego=juegos.id_juego and usuarios.id_usuario=amigos.id_usuario and usuarios.nombre_usuario=?";

        $consulta = $this->db->getCon()->prepare($sent);

        $consulta->bind_param("s", $user);

        $consulta->bind_result($id_prestamo,$nombreAmigo ,$foto, $fecha, $devuelto);

        $consulta->execute();

        $prestamos = [];

        while ($consulta->fetch()) {
            $prestamo = new stdClass();
            $prestamo->id_prestamo = $id_prestamo;
            $prestamo->nombreAmigo= $nombreAmigo;
            $prestamo->foto = $foto;
            $prestamo->fecha_prestamo = date("d/m/Y", strtotime($fecha));
            $prestamo->devuelto = $devuelto;
            $prestamos[] = $prestamo;
        }

        $consulta->close();

        return $prestamos;
    }
    // public function selectPrestamoAmigos($user){
    //     $sent ="SELECT amigos.id_amigo ,amigos.nombre FROM amigos , usuarios WHERE usuarios.id_usuario = amigos.id_usuario and usuarios.nombre_usuario=?";
    //     $consulta = $this->db->getCon()->prepare($sent);

    //     $consulta->bind_param("s", $user);

    //     $consulta->bind_result($id_amigo, $nombre);

    //     $consulta->execute();

    //     $amigos = []; 

    //     while ($consulta->fetch()) {
    //         $amigos[$id_amigo] = $nombre;  
    //     }

    //     $consulta->close();

    //     return $amigos;  

    // }
    // public function selectPrestamoJuegos($user){
    //     $sent ="SELECT juegos.id_juego, juegos.titulo FROM juegos LEFT JOIN prestamos ON juegos.id_juego = prestamos.id_juego JOIN usuarios ON juegos.id_usuario = usuarios.id_usuario WHERE usuarios.nombre_usuario = ? AND (prestamos.devuelto = 0 OR prestamos.id_juego IS NULL);";
    //     $consulta = $this->db->getCon()->prepare($sent);

    //     $consulta->bind_param("s", $user);

    //     $consulta->bind_result($id_juego, $titulo);

    //     $consulta->execute();

    //     $amigos = []; 

    //     while ($consulta->fetch()) {
    //         $amigos[$id_juego] = $titulo;  
    //     }

    //     $consulta->close();

    //     return $amigos;  
    // }
    public function insert($amigo,$juego,$fecha,$usu){
        require_once('class-amigos.php');
        $u=new amigos();
        $user=$u->obtenerIDuser($usu);
        try {
            $sent = "INSERT INTO prestamos (id_amigo,id_juego,fecha_prestamo,devuelto,id_usuario) VALUES (?,?,?,?,?)";
            $consulta = $this->db->getCon()->prepare($sent);
            $devuelto=1;
            $consulta->bind_param("iisis",$amigo,$juego,$fecha,$devuelto,$user);
    
            if ($consulta->execute()) {
                echo "Prestamo insertado correctamente.";
            } else {
                echo "Error al insertar el Prestamo.";
            }
        } catch (Exception $e) {
            echo "No se puede insertar: " . $e->getMessage();
        }
        header("Location: ../CONTROLADOR/listaprestamos.php");

    }
    public function buscar($string,$user) {
        $regex = "%".$string."%";
        $sent= "SELECT prestamos.id_prestamo,amigos.nombre,juegos.foto,prestamos.fecha_prestamo,prestamos.devuelto FROM prestamos JOIN usuarios ON prestamos.id_usuario = usuarios.id_usuario JOIN amigos ON prestamos.id_amigo = amigos.id_amigo JOIN juegos ON prestamos.id_juego = juegos.id_juego WHERE (amigos.nombre LIKE ? OR juegos.titulo LIKE ? ) and usuarios.nombre_usuario=?";
        $consulta = $this->db->getCon()->prepare($sent);

        $consulta->bind_param("ssi", $regex,$regex,$user);  

        $consulta->bind_result($id_prestamo, $nombreAmigo, $foto, $fecha, $devuelto);
        
        $consulta->execute();
        
        $prestamos = [];

        while ($consulta->fetch()) {
            $prestamo = new stdClass();
            $prestamo->id_prestamo = $id_prestamo;
            $prestamo->nombreAmigo= $nombreAmigo;
            $prestamo->foto = $foto;
            $prestamo->fecha_prestamo = date("d/m/Y", strtotime($fecha));
            $prestamo->devuelto = $devuelto;

            $prestamos[] = $prestamo;  
        }
        
        $consulta->close();
        return $prestamos;
       
    }
    public function devolver($id_prestamo){
        $sent ="UPDATE prestamos SET devuelto = 0 WHERE id_prestamo = ?";
        $consulta = $this->db->getCon()->prepare($sent);
        $consulta->bind_param("i", $id_prestamo);  
        $consulta->execute();
        $consulta->close();
        header("Location: ../CONTROLADOR/listaprestamos.php");
    }
    
}
