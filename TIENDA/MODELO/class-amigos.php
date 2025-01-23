<?php
    class amigos{
        private $db;
        private $id_amigo;
        private $id_usuario;
        private $nombre;
        private $apellido;
        private $fecha;
        public function __construct($db = null, $id_amigo = -1, $id_usuario = -1, $nombre = "", $apellido = "", $fecha = "") {
            $this->db = $db; // Si no se pasa, será null (conexión a la base de datos, si es necesario)
            $this->id_amigo = $id_amigo; // Valor por defecto -1 para el id de amigo
            $this->id_usuario = $id_usuario; // Valor por defecto -1 para el id de usuario
            $this->nombre = $nombre; // Valor por defecto cadena vacía para nombre
            $this->apellido = $apellido; // Valor por defecto cadena vacía para apellido
            $this->fecha = $fecha; // Valor por defecto cadena vacía para fecha
        }

    }



?>