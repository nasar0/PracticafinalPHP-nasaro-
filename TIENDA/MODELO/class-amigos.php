<?php
require_once("class-conexion.php"); // Incluye el archivo de conexión a la base de datos
// Definición de la clase amigos

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
        $this->db = new con(); // Instancia de la conexión a la base de datos
        $this->id_amigo = -1;
        $this->id_usuario = -1;
        $this->nombre = "";
        $this->apellido = "";
        $this->fecha = "";
    }

    // Método para listar los amigos de un usuario
    public function listarColegas($nom)
    {
        if (strcmp($nom, "ADMIN") == 0) { 
            // Si el usuario es ADMIN, obtiene todos los amigos con nombre de usuario
            $sent = "SELECT amigos.id_amigo,amigos.id_usuario,amigos.nombre,amigos.apellido,amigos.fecha_nacimiento,usuarios.nombre_usuario 
                    FROM amigos, usuarios 
                    WHERE usuarios.id_usuario=amigos.id_usuario;";
        } else {
            // Si no es ADMIN, filtra por nombre de usuario
            $sent = "SELECT amigos.id_amigo,amigos.id_usuario,amigos.nombre,amigos.apellido,amigos.fecha_nacimiento 
                    FROM amigos, usuarios 
                    WHERE usuarios.id_usuario=amigos.id_usuario AND usuarios.nombre_usuario=? ";
        }

        $consulta = $this->db->getCon()->prepare($sent);

        if (strcmp($nom, "ADMIN") != 0) {
            $consulta->bind_param("s", $nom);
            $consulta->bind_result($id_amigo, $id_usuario, $nombre, $apellido, $fecha);
        } else {
            $consulta->bind_result($id_amigo, $id_usuario, $nombre, $apellido, $fecha, $usuNom);
        }

        $consulta->execute();
        $amigos = []; 
        $usuNom="";
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
        return $this->$nom; // Getter para obtener propiedades privadas
    }

    // Método para listar amigos que coincidan con un nombre parcial
    public function listarAmigosNombre($string, $nom)
    {
        $regex = $string . "%"; // Se usa para la búsqueda con LIKE en SQL
        if (strcmp($nom, "ADMIN") != 0) {
            $sent = "SELECT amigos.id_amigo, amigos.id_usuario, amigos.nombre, amigos.apellido, amigos.fecha_nacimiento 
                    FROM amigos, usuarios 
                    WHERE usuarios.id_usuario = amigos.id_usuario AND amigos.nombre LIKE ? ";
        } else {
            $sent = "SELECT amigos.id_amigo, amigos.id_usuario, amigos.nombre, amigos.apellido, amigos.fecha_nacimiento ,usuarios.nombre_usuario 
                    FROM amigos, usuarios 
                    WHERE usuarios.id_usuario = amigos.id_usuario AND amigos.nombre LIKE ?  ";
        }

        $consulta = $this->db->getCon()->prepare($sent);
        $consulta->bind_param("s", $regex);
        
        if (strcmp($nom, "ADMIN") != 0) {
            $consulta->bind_result($id_amigo, $id_usuario, $nombre, $apellido, $fecha);

        } else {
            
            $consulta->bind_result($id_amigo, $id_usuario, $nombre, $apellido, $fecha, $usuNom);
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

    // Método para obtener el ID de un usuario según su nombre de usuario
    public function obtenerIDuser(String $user)
    {
        $sent = "SELECT id_usuario FROM usuarios WHERE nombre_usuario = ?";
        $consulta = $this->db->getCon()->prepare($sent);
        $consulta->bind_param("s", $user);
        $consulta->bind_result($num);
        $consulta->execute();
        $consulta->fetch();
        return $num;
    }

    // Método para insertar un nuevo amigo en la base de datos
    public function insertarAmigos($nom, $ape, $fec, $user)
    {
        echo $fec;
        $idUsu = 0;
        echo "<br>" . $user . "<br>";

        if (is_string($user)) {
            echo "hola";
            $usu = new amigos();
            $idUsu = $usu->obtenerIDuser($user);
        } else {
            $idUsu = $user;
        }

        echo $idUsu;

        if (time() < strtotime($fec)) {
            // Si la fecha es en el futuro, no hace nada
        } else {
            try {
                $sent = "INSERT INTO amigos (id_usuario, nombre, apellido, fecha_nacimiento) VALUES (?,?,?,?)";
                $consulta = $this->db->getCon()->prepare($sent);
                $consulta->bind_param("isss", $idUsu, $nom, $ape, $fec);

                if ($consulta->execute()) {
                    echo "Amigo insertado correctamente.";
                } else {
                    echo "Error al insertar el amigo.";
                }
            } catch (Exception $e) {
                echo "No se puede insertar: " . $e->getMessage();
            }
        }
    }

    // Método para obtener un amigo según su ID
    public function obtenerAmigo($id_amigo)
    {
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

    // Método para modificar un amigo existente
    public function modificarAmigo($id_amigo, $nombre, $apellido, $fecha_nacimiento, $id_usuario)
    {
        echo $id_amigo;
        try {
            $sent = "UPDATE amigos SET nombre = ?, apellido = ?, fecha_nacimiento = ?, id_usuario=? WHERE id_amigo = ?";
            $consulta = $this->db->getCon()->prepare($sent);
            $consulta->bind_param("sssii", $nombre, $apellido, $fecha_nacimiento, $id_usuario, $id_amigo);

            return $consulta->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Método para seleccionar amigos de un usuario específico
    public function selectPrestamoAmigos($user)
    {
        $sent = "SELECT amigos.id_amigo, amigos.nombre FROM amigos, usuarios WHERE usuarios.id_usuario = amigos.id_usuario AND usuarios.nombre_usuario=?";
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
?>
