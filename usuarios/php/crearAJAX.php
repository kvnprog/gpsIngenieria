<?php

include "../../fGenerales/bd/conexion.php";

$nombre = filter_input(INPUT_POST, "nombre");
$login = filter_input(INPUT_POST, "login");
$correo = filter_input(INPUT_POST, "correo");
$password = filter_input(INPUT_POST, "password");

// $nombre = filter_input(INPUT_GET, "nombre");
// $login = filter_input(INPUT_GET, "login");
// $correo = filter_input(INPUT_GET, "correo");
// $password = filter_input(INPUT_GET, "password");


$resultados = [];
$resultados[0]["resultado"] = 0; //HUBO UN ERROR
 
if ($nombre != "" && $login != "" && $correo != "" && $password != "") {

    $conexionChecaUsuario = new conexion;
    $queryChecarUsuario = "SELECT idusuario FROM usuarios WHERE nombreusuario = '" . $login . "' or nombre = '" . $nombre . "' and estadoid = 1 ";
    $usuarios = $conexionChecaUsuario->conn->query($queryChecarUsuario);
    //echo $usuarios->num_rows."<br>";
    if ($usuarios->num_rows > 0) {

        $resultados[0]["resultado"] = 1; //ERROR USUARIO REPETIDO

    } else {

        $conexionCrearUsuario = new conexion;
        $queryCrearUsuario = "INSERT INTO  usuarios(nombreusuario,passwordusuario,correo,nombre,estadoid) VALUES ('" . $login . "',md5('" . $password . "'),'" . $correo . "','" . $nombre . "',1)";
        if ($conexionChecaUsuario->conn->query($queryCrearUsuario)) {
            $resultados[0]["resultado"] = 2; //SE CREO EL USUARIO

            //TRAYENDO LOS DATOS 
            $conexionUsuarios = new conexion;
            $queryUsuarios = "SELECT*FROM usuarios WHERE estadoid=1";
            $datos = $conexionUsuarios->conn->query($queryUsuarios);

            $resultados[0]["noDatos"] = $datos->num_rows;

            foreach ($datos->fetch_all() as $key => $usuario) {

                $resultados[$key]["idusuario"] = $usuario[0];
                $resultados[$key]["nombreusuario"] = $usuario[1];
                $resultados[$key]["passwordusuario"] = $usuario[2];
                $resultados[$key]["correo"] = $usuario[3];
                $resultados[$key]["nombre"] = $usuario[4];
            }
        }
    }
}

echo json_encode($resultados);
