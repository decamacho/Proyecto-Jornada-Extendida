<?php 
    $mysqli= new mysqli("localhost", "root", "", "jornadaextendida");
    if($mysqli->connect_errno) {
        echo "Fallo la conexion con la base de datos: (". $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
?>