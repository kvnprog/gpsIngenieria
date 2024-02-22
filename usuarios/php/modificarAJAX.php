<?php

    include "../../fGenerales/bd/conexion.php";

    $id = filter_input(INPUT_POST, "id");
    $nombre = filter_input(INPUT_POST, "nombre");
    $login = filter_input(INPUT_POST, "login");
    $correo = filter_input(INPUT_POST, "correo");
    $password = filter_input(INPUT_POST, "password");

    $resultados = [];

    $resultados[0]["resultado"] = 0; //algo salio mal
    if ($nombre == "" || $login == "" || $correo == "") {

        $resultados[0]["resultado"] = 1; // los datos estan mal

    } else {

        //CREAR EL MODIFICAR 
        $conexionModificar = new conexion;
        if ($password != "") {
            $queryModificar = "UPDATE usuarios SET usuario = '" . $login . "' , PASSWORD = SHA2('" . $password . "', 256)  , correo = '" . $correo . "' , nombre = '" . $nombre . "' WHERE id_usuario = " . $id . " AND id_estado = 1";
        } else {
            $queryModificar = "UPDATE usuarios SET usuario = '" . $login . "'  , correo = '" . $correo . "' , nombre = '" . $nombre . "' WHERE id_usuario = " . $id . " AND id_estado = 1";
        }

        if ($conexionModificar->conn->query($queryModificar)) {

            $resultados[0]["resultado"] = 2; // salio bien la modificacion

            //TRAYENDO LOS DATOS 
            $conexionUsuarios = new conexion;
            $queryUsuarios = "SELECT *FROM usuarios WHERE id_estado = 1";
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

    echo json_encode($resultados);
?>