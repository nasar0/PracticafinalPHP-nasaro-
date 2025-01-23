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
        $sent = "SELECT amigos.id_amigo,amigos.id_usuario,amigos.nombre,amigos.apellido,amigos.fecha_nacimiento from amigos , usuarios where usuarios.id_usuario=amigos.id_usuario and usuarios.nombre_usuario=? ";
        $consulta = $this->db->getCon()->prepare($sent);
        $consulta->bind_param("s", $nom);
        $consulta->bind_result($id_amigo, $id_usuario, $nombre, $apellido, $fecha);
        $consulta->execute();
        $amigos = []; 

        while ($consulta->fetch()) {
            $amigo = new amigos(); 
            $amigo->id_amigo = $id_amigo; 
            $amigo->id_usuario = $id_usuario;
            $amigo->nombre = $nombre;
            $amigo->apellido = $apellido;
            $amigo->fecha = $fecha;

            $amigos[] = $amigo; 
        }

        $consulta->close();
        return $amigos;
    }
}
