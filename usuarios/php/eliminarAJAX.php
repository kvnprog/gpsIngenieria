<?php

include "../../fGenerales/bd/conexion.php";

$resultados = [];
$resultados[0]["resultado"] = 0;
$id = filter_input(INPUT_GET,"id");

$conexionEliminar = new conexion;

$queryEliminar = "UPDATE usuarios SET estadoid = 2 WHERE idusuario =".$id;

if($conexionEliminar->conn->query($queryEliminar)){

    $resultados[0]["resultado"] = 1;//salio bien

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

echo json_encode($resultados);