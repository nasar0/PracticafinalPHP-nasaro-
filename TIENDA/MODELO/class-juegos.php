<?php
require_once("class-conexion.php"); // Incluye el archivo de conexión a la base de datos
// Definición de la clase juegos
class juegos
{
    private $db;
    private $id_juego;
    private $id_usuario;
    private $titulo;
    private $plataforma;
    private $anio_lanzamiento;
    private $foto;
    public function __construct()
    {
        $this->db = new con();// Instancia de la conexión a la base de datos
        $this->id_juego = -1;
        $this->id_usuario = -1;
        $this->titulo = "";
        $this->plataforma = "";
        $this->anio_lanzamiento = "";
        $this->foto = "";
    }
    // Getter para obtener propiedades privadas
    public function __get($nom)
    {
        return $this->$nom;
    } 
    // Método para listar los juegos de un usuario
    public function listarJuegos($nom)
    {
        $sent = "SELECT juegos.id_juego,juegos.id_usuario,juegos.titulo,juegos.plataforma,anio_lanzamiento,juegos.foto FROM usuarios,juegos WHERE usuarios.id_usuario=juegos.id_usuario and usuarios.nombre_usuario=?";
        $consulta = $this->db->getCon()->prepare($sent);
        $consulta->bind_param("s", $nom);
        $consulta->bind_result($id_juego, $id_usuario, $titulo, $plataforma, $anio_lanzamiento, $foto);
        $consulta->execute();
        $juegos = [];

        while ($consulta->fetch()) {
            $juego = new juegos();
            $juego->id_juego = $id_juego;
            $juego->id_usuario = $id_usuario;
            $juego->titulo = $titulo;
            $juego->plataforma = $plataforma;
            $juego->anio_lanzamiento = $anio_lanzamiento;
            $juego->foto = $foto;
            $juegos[] = $juego;
        }

        $consulta->close();
        return $juegos;
    }
    //Método para obtener el juego de un usuario
    public function obtenerJuego($id_juego,$id_usuario) {
       $sent = "SELECT juegos.id_juego,juegos.id_usuario,juegos.titulo,juegos.plataforma,anio_lanzamiento,juegos.foto FROM usuarios,juegos WHERE usuarios.id_usuario=juegos.id_usuario and juegos.id_juego=? and usuarios.id_usuario=?";
        $consulta = $this->db->getCon()->prepare($sent);
        $consulta->bind_param("ii",$id_juego,$id_usuario);
        $consulta->bind_result($id_juego, $id_usuario, $titulo, $plataforma,$anio_lanzamiento,$foto);
        $consulta->execute();
        $consulta->fetch();
    
        $juegos = new juegos();
        $juegos->id_juego = $id_juego;
        $juegos->id_usuario = $id_usuario;
        $juegos->titulo = $titulo;
        $juegos->plataforma = $plataforma;
        $juegos->anio_lanzamiento=$anio_lanzamiento;
        $juegos->foto = $foto;
        return $juegos;
    }
    //Método para modificar/actualizar un juego 
    public function modificarJuego($id_juego, $titulo, $plataforma, $anio_lanzamiento,$foto) {
        try {
            $sent = "UPDATE juegos SET titulo = ?, plataforma = ? ,anio_lanzamiento=? ";
            if($foto!=null)$sent.=",foto=? ";
            $sent.="WHERE id_juego = ?";
            $consulta = $this->db->getCon()->prepare($sent);

            if($foto!=null) $consulta->bind_param("ssssi", $titulo, $plataforma, $anio_lanzamiento,$foto,$id_juego);
            else $consulta->bind_param("sssi", $titulo, $plataforma, $anio_lanzamiento,$id_juego);
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
    // Método para listar juegos que coincidan con un nombre parcial
    public function listarJuegosNombre($string,$nom){
        $regex = $string."%";
        $sent= "SELECT j.id_juego,j.id_usuario,j.titulo,j.plataforma,j.anio_lanzamiento,j.foto FROM juegos j, usuarios WHERE usuarios.id_usuario = j.id_usuario AND j.titulo LIKE ? and usuarios.nombre_usuario=?";
        $consulta = $this->db->getCon()->prepare($sent);
        $consulta->bind_param("ss",$regex, $nom);
        $consulta->bind_result($id_juego, $id_usuario, $titulo, $plataforma,$anio_lanzamiento,$foto);
        $consulta->execute();
        $juegos = [];

        while ($consulta->fetch()) {
            $juego = new juegos();
            $juego->id_juego = $id_juego;
            $juego->id_usuario = $id_usuario;
            $juego->titulo = $titulo;
            $juego->plataforma = $plataforma;
            $juego->anio_lanzamiento = $anio_lanzamiento;
            $juego->foto = $foto;
            $juegos[] = $juego;
        }

        $consulta->close();
        return $juegos;
    }
    // Método para obtener el nombre de la foto del juego
    public function obtenerfoto($id){
        $sent= " SELECT foto FROM juegos WHERE id_juego = ?";
        $consulta = $this->db->getCon()->prepare($sent);
        $consulta->bind_param("i",$id);
        $consulta->bind_result($foto);
        $consulta->execute();
        $consulta->fetch();
        return $foto;
    }
    // Método para insertar un nuevo juego en la base de datos
    public function insertarJuegos($user,$tit,$pla,$ani,$fot){
        require_once('class-amigos.php');
        $usu=new amigos();
        $usue=$usu->obtenerIDuser($user);
        
        try {
            $sent = "INSERT INTO juegos (id_usuario,titulo,plataforma,anio_lanzamiento,foto) VALUES (?,?,?,?,?)";
            $consulta = $this->db->getCon()->prepare($sent);
    
            $consulta->bind_param("issss",$usue,$tit,$pla,$ani,$fot);
    
            if ($consulta->execute()) {
                echo "Juego insertado correctamente.";
            } else {
                echo "Error al insertar el amigo.";
            }
        } catch (Exception $e) {
            echo "No se puede insertar: " . $e->getMessage();
        }
        
    }
    //metodo para obtener para los prestamos un juego que no este prestado(no supe si iba en prestamos o aqui pues preferi dejarlo aqui)
    public function selectPrestamoJuegos($user){
        $sent ="SELECT juegos.id_juego, juegos.titulo
FROM juegos
JOIN usuarios ON juegos.id_usuario = usuarios.id_usuario
LEFT JOIN (
    SELECT id_juego, MAX(id_prestamo) AS ultimo_prestamo
    FROM prestamos
    GROUP BY id_juego
) AS ultimo_prestamo ON juegos.id_juego = ultimo_prestamo.id_juego
LEFT JOIN prestamos ON prestamos.id_prestamo = ultimo_prestamo.ultimo_prestamo
WHERE usuarios.nombre_usuario = ?
AND (prestamos.devuelto = 0 OR prestamos.devuelto IS NULL);
";
        $consulta = $this->db->getCon()->prepare($sent);

        $consulta->bind_param("s", $user);

        $consulta->bind_result($id_juego, $titulo);

        $consulta->execute();

        $amigos = []; 

        while ($consulta->fetch()) {
            $amigos[$id_juego] = $titulo;  
        }

        $consulta->close();

        return $amigos;  
    }
}
?>
