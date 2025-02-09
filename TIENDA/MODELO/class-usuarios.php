<?php
    // Se requiere la clase de conexión a la base de datos
    require_once("class-conexion.php");

    // Definición de la clase usuarios
    class usuarios {
        private $db; // Variable para la conexión a la base de datos
        private $id_usuario;
        private $nombre_usuario;
        private $contrasena;

        // Constructor de la clase, inicializa la conexión y las variables de usuario
        public function __construct() {
            $this->db = new con();  // Se crea una nueva instancia de conexión
            $this->id_usuario = -1;
            $this->nombre_usuario = "";
            $this->contrasena = "";
        }

        // Método para iniciar sesión verificando usuario y contraseña en la base de datos
        public function iniciar_sesion($user, $cont) {
            $num = 0;
            $sent = "SELECT COUNT(*) FROM usuarios WHERE nombre_usuario = ? AND contrasena = ?";
            $consulta = $this->db->getCon()->prepare($sent);
            $consulta->bind_param("ss", $user, $cont);
            $consulta->bind_result($num);
            $consulta->execute();
            $consulta->fetch(); 
            $inicio = ($num == 1) ? true : false; // Si encuentra 1 coincidencia, inicia sesión
            $consulta->close(); 
            return $inicio;
        }

        // Método para listar amigos (pero tiene una consulta idéntica a iniciar_sesion, posible error)
        public function listaramigos($user) {
            $num = 0;
            $sent = "SELECT COUNT(*) FROM usuarios WHERE nombre_usuario = ? AND contrasena = ?";
            $consulta = $this->db->getCon()->prepare($sent);
            $consulta->bind_param("ss", $user, $cont); // La variable $cont no está definida, esto generaría un error
            $consulta->bind_result($num);
            $consulta->execute();
            $consulta->fetch();
            $inicio = ($num == 1) ? true : false;
            $consulta->close(); 
            return $inicio;
        }

        // Método para obtener todos los usuarios de la base de datos
        public function mostrarUsuarios() {
            $sent = "SELECT usuarios.* FROM usuarios";
            $consulta = $this->db->getCon()->prepare($sent);
            $consulta->bind_result($id_usuarios, $nombre_usuario, $contraseña);
            $consulta->execute();
            $consulta->fetch();
            $usuarios = [];

            // Se recorren los resultados y se almacenan en un array de objetos
            while ($consulta->fetch()) {
                $usuario = new stdClass();
                $usuario->id_usuarios = $id_usuarios;
                $usuario->nombre_usuario = $nombre_usuario;
                $usuario->contraseña = $contraseña;
                $usuarios[] = $usuario;
            }
            return $usuarios;
        }

        // Método para listar usuarios que coincidan con una búsqueda
        public function listarUsuarios($string) {
            $regex = "%".$string."%"; // Se define el patrón para la búsqueda
            $sent = "SELECT usuarios.* FROM usuarios WHERE usuarios.nombre_usuario like ?";
            $consulta = $this->db->getCon()->prepare($sent);
            $consulta->bind_result($id_usuarios, $nombre_usuario, $contraseña);
            $consulta->bind_param("s", $regex);
            $consulta->execute();
            $usuarios = [];

            // Se almacenan los resultados en un array de objetos
            while ($consulta->fetch()) {
                $usuario = new stdClass();
                $usuario->id_usuarios = $id_usuarios;
                $usuario->nombre_usuario = $nombre_usuario;
                $usuario->contraseña = $contraseña;
                $usuarios[] = $usuario;
            }
            return $usuarios;
        }

        // Método para insertar un nuevo usuario en la base de datos
        public function insertarAmigos($nom, $pas) {
            try {
                $sent = "INSERT INTO usuarios (usuarios.nombre_usuario, usuarios.contrasena) VALUES (?, ?);";
                $consulta = $this->db->getCon()->prepare($sent);
                $consulta->bind_param("ss", $nom, $pas);
                $consulta->execute();
            } catch (Exception $e) {
                echo "No se puede insertar: " . $e->getMessage();
            }
        }

        // Método para obtener un usuario específico por su ID
        public function obtenerUsuario($id_amigo) {
            $sent = "SELECT usuarios.* FROM usuarios WHERE usuarios.id_usuario = ?";
            $consulta = $this->db->getCon()->prepare($sent);
            $consulta->bind_result($id_usuarios, $nombre_usuario, $contraseña);
            $consulta->bind_param("i", $id_amigo);
            $consulta->execute();

            // Se almacena el resultado en un objeto
            while ($consulta->fetch()) {
                $usuario = new stdClass();
                $usuario->id_usuarios = $id_usuarios;
                $usuario->nombre_usuario = $nombre_usuario;
                $usuario->contraseña = $contraseña;
            }
            return $usuario;
        }

        // Método para modificar un usuario existente en la base de datos
        public function modificarUsuario($id_amigo, $nombre, $contrasena) {
            try {
                $sent = "UPDATE usuarios SET nombre_usuario = ?, contrasena = ? WHERE id_usuario = ?";
                $consulta = $this->db->getCon()->prepare($sent);
                $consulta->bind_param("ssi", $nombre, $contrasena, $id_amigo);

                // Se ejecuta la consulta y se retorna true si fue exitosa, false si falló
                if ($consulta->execute()) {
                    return true; 
                } else {
                    return false; 
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        } 
    }
?>






















?>