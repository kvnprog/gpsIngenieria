<?php 

include "../../fGenerales/bd/conexion.php";

$nombre = filter_input(INPUT_POST,"nombre");
$login = filter_input(INPUT_POST,"login");
$correo = filter_input(INPUT_POST,"correo");
$password = filter_input(INPUT_POST,"password");

if($nombre != "" || $login != "" || $correo != "" || $password != ""  ){

}

$conexionChecaUsuario = new conexion;