<?php
require_once("class-conexion.php");
class prestamos
{
    private $db;
    private $id_prestamo;
    private $id_amigo;
    private $id_prestamos;
    private $fecha;
    private $devuelto;

    public function __construct()
    {
        $this->db = new con();
        $this->id_prestamo = -1;
        $this->id_amigo = -1;
        $this->id_prestamos = -1;
        $this->fecha = "";
        $this->devuelto = -1;
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
            $prestamo->fecha_prestamo = $fecha;
            $prestamo->devuelto = $devuelto;
            $prestamos[] = $prestamo;
        }

        $consulta->close();

        return $prestamos;
    }
}
