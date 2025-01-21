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
        public function iniciar_sesion(){
            
        }

       
        
    }






















?>