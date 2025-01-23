<?php
    require_once("class-conexion.php");
    class usuarios{
        private $db;
        private $id_usuario;
        private $nombre_usuario;
        private $contrasena;

        public function __construct() {
            $this->db =new con(); 
            $this->id_usuario = -1;
            $this->nombre_usuario = "";
            $this->contrasena = "";
        }
        public function iniciar_sesion($user,$cont){
            $num=0;
            $sent= "SELECT COUNT(*) FROM usuarios WHERE nombre_usuario = ? AND contrasena = ?";
            $consulta = $this->db->getCon()->prepare($sent);
            $consulta->bind_param("ss",$user,$cont);
            $consulta->bind_result($num);
            $consulta->execute();
            $consulta->fetch();
            $inicio = ($num == 1)? true : false;
            $consulta->close(); 
            return $inicio;
        }
        public function listaramigos($user){
            $num=0;
            $sent= "SELECT COUNT(*) FROM usuarios WHERE nombre_usuario = ? AND contrasena = ?";
            $consulta = $this->db->getCon()->prepare($sent);
            $consulta->bind_param("ss",$user,$cont);
            $consulta->bind_result($num);
            $consulta->execute();
            $consulta->fetch();
            $inicio = ($num == 1)? true : false;
            $consulta->close(); 
            return $inicio;
        }
       
        
    }






















?>