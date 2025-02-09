<?php
require_once("class-conexion.php"); // Incluye el archivo de conexión a la base de datos
// Definición de la clase prestamos

class prestamos
{
    private $db; // Conexión a la base de datos
    private $id_prestamo;
    private $id_amigo;
    private $id_juego;
    private $fecha;
    private $devuelto;
    private $id_usuario;

    public function __construct()
    {
        $this->db = new con(); // Instancia la conexión
        $this->id_prestamo = -1;
        $this->id_amigo = -1;
        $this->id_juego = -1;
        $this->fecha = "";
        $this->devuelto = -1;
        $this->id_usuario = -1;
    }

    // Método mágico para obtener propiedades privadas
    public function __get($nom)
    {
        return $this->$nom;
    }

    // Método para mostrar los préstamos de un usuario
    public function mostrar($user)
    {
        $sent = "SELECT prestamos.id_prestamo, amigos.nombre, juegos.foto, prestamos.fecha_prestamo, prestamos.devuelto 
                 FROM juegos, amigos, usuarios, prestamos 
                 WHERE amigos.id_amigo = prestamos.id_amigo 
                 AND prestamos.id_juego = juegos.id_juego 
                 AND usuarios.id_usuario = amigos.id_usuario 
                 AND usuarios.nombre_usuario=?";

        $consulta = $this->db->getCon()->prepare($sent);
        $consulta->bind_param("s", $user);
        $consulta->bind_result($id_prestamo, $nombreAmigo, $foto, $fecha, $devuelto);
        $consulta->execute();

        $prestamos = [];

        // Recorre los resultados y los almacena en un array de objetos
        while ($consulta->fetch()) {
            $prestamo = new stdClass();
            $prestamo->id_prestamo = $id_prestamo;
            $prestamo->nombreAmigo = $nombreAmigo;
            $prestamo->foto = $foto;
            $prestamo->fecha_prestamo = date("d/m/Y", strtotime($fecha));
            $prestamo->devuelto = $devuelto;
            $prestamos[] = $prestamo;
        }

        $consulta->close();
        return $prestamos;
    }
    
    // Método para insertar un nuevo préstamo
    public function insert($amigo, $juego, $fecha, $usu)
    {
        require_once('class-amigos.php'); // Incluye la clase amigos
        $u = new amigos();
        $user = $u->obtenerIDuser($usu); // Obtiene el ID del usuario

        try {
            $sent = "INSERT INTO prestamos (id_amigo, id_juego, fecha_prestamo, devuelto, id_usuario) 
                     VALUES (?, ?, ?, ?, ?)";
            $consulta = $this->db->getCon()->prepare($sent);
            $devuelto = 1; // Se marca como prestado (1)
            $consulta->bind_param("iisis", $amigo, $juego, $fecha, $devuelto, $user);
    
            if ($consulta->execute()) {
                echo "Préstamo insertado correctamente.";
            } else {
                echo "Error al insertar el préstamo.";
            }
        } catch (Exception $e) {
            echo "No se puede insertar: " . $e->getMessage();
        }
    }

    // Método para buscar préstamos según un criterio y usuario
    public function buscar($string, $user) 
    {
        $regex = "%" . $string . "%"; // Patrón de búsqueda con LIKE
        $sent = "SELECT prestamos.id_prestamo, amigos.nombre, juegos.foto, prestamos.fecha_prestamo, prestamos.devuelto 
                 FROM prestamos 
                 JOIN usuarios ON prestamos.id_usuario = usuarios.id_usuario 
                 JOIN amigos ON prestamos.id_amigo = amigos.id_amigo 
                 JOIN juegos ON prestamos.id_juego = juegos.id_juego 
                 WHERE (amigos.nombre LIKE ? OR juegos.titulo LIKE ?) 
                 AND usuarios.nombre_usuario=?";

        $consulta = $this->db->getCon()->prepare($sent);
        $consulta->bind_param("ssi", $regex, $regex, $user);
        $consulta->bind_result($id_prestamo, $nombreAmigo, $foto, $fecha, $devuelto);
        $consulta->execute();
        
        $prestamos = [];

        // Recorre los resultados y los almacena en un array de objetos
        while ($consulta->fetch()) {
            $prestamo = new stdClass();
            $prestamo->id_prestamo = $id_prestamo;
            $prestamo->nombreAmigo = $nombreAmigo;
            $prestamo->foto = $foto;
            $prestamo->fecha_prestamo = date("d/m/Y", strtotime($fecha));
            $prestamo->devuelto = $devuelto;
            $prestamos[] = $prestamo;
        }
        
        $consulta->close();
        return $prestamos;
    }

    // Método para marcar un préstamo como devuelto
    public function devolver($id_prestamo)
    {
        $sent = "UPDATE prestamos SET devuelto = 0 WHERE id_prestamo = ?";
        $consulta = $this->db->getCon()->prepare($sent);
        $consulta->bind_param("i", $id_prestamo);
        $consulta->execute();
        $consulta->close();
    }
}
?>
