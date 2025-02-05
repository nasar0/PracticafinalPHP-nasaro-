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
        public function mostrarUsuarios(){
            $sent = "SELECT usuarios.* FROM usuarios";
            $consulta = $this->db->getCon()->prepare($sent);
            $consulta->bind_result($id_usuarios,$nombre_usuario,$contraseña);
            $consulta->execute();
            $consulta->fetch();
            $usuarios=[];
            while ($consulta->fetch()) {
                $usuario = new stdClass();
                $usuario->id_usuarios = $id_usuarios;
                $usuario->nombre_usuario = $nombre_usuario;
                $usuario->contraseña = $contraseña;
                $usuarios[] = $usuario;
            }
            
        
            return $usuarios;
        }

        public function listarUsuarios($string){
            $regex = "%".$string."%";
            $sent = "SELECT usuarios.* FROM usuarios WHERE usuarios.nombre_usuario like ?";
            $consulta = $this->db->getCon()->prepare($sent);
            $consulta->bind_result($id_usuarios,$nombre_usuario,$contraseña);
            $consulta->bind_param("s", $regex);
            $consulta->execute();
            $usuarios=[];
            while ($consulta->fetch()) {
                $usuario = new stdClass();
                $usuario->id_usuarios = $id_usuarios;
                $usuario->nombre_usuario = $nombre_usuario;
                $usuario->contraseña = $contraseña;
                $usuarios[] = $usuario;
            }
            
        
            return $usuarios;
        }
       
        
    }






















?>