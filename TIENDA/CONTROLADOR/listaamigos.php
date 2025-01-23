<?php
require_once("../MODELO/class-amigos.php");

function mostrar()
{
    $amigos = new amigos();
    session_start();
    $user = $_SESSION['user']; // Obtenemos el nombre del usuario actual
    $listaAmigos = $amigos->listarColegas($user); // Obtenemos la lista de amigos

    echo "<table border='1'>
        <tr>
            <th>ID Amigo</th>
            <th>ID Usuario</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Fecha de Nacimiento</th>
        </tr>";

    foreach ($listaAmigos as $amigo) {
        echo "<tr>
            <td>{$amigo->id_amigo}</td>
            <td>{$amigo->id_usuario}</td>
            <td>{$amigo->nombre}</td>
            <td>{$amigo->apellido}</td>
            <td>{$amigo->fecha}</td>
          </tr>";
    }

    echo "</table>";
}


function buscar() {}

if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
    $action();
} else {
    mostrar();
}
