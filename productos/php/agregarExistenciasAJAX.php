<?php

include "../../fGenerales/bd/conexion.php";

$id = filter_input(INPUT_GET,"id");
$existenciasNuevas = filter_input(INPUT_GET,"existenciasNuevas");

$bandera = false;

$arrResultados = [];

//agregando las nuevas existencias al producto

$conexionTraerExistencias = new conexion;
$queryTraerExistencias = "SELECT existentes FROM productos WHERE idproducto = ".$id;

$resultados = $conexionTraerExistencias->conn->query($queryTraerExistencias);

// echo json_encode($resultados->fetch_row());
foreach($resultados->fetch_row() as $existencias){

    $nExistencias = $existencias[0] + $existenciasNuevas;

    // echo $nExistencias;

    //haciendo el update con las nuevas existencias
    $conexionExistenciasNuevas = new conexion;
    $queryExistenciasNuevas = "UPDATE productos SET existentes = ".$nExistencias ." WHERE idproducto = ".$id;

    // echo $queryExistenciasNuevas;
    $conexionExistenciasNuevas->conn->query($queryExistenciasNuevas);

    //creando las entradas 

    $conexionEntrada = new conexion;
    $queryEntrada = "INSERT INTO entradassalidas(tipoid,idproducto,cantidad) VALUES (1,".$id.",".$existenciasNuevas.")";
    $conexionEntrada->conn->query($queryEntrada);


    $bandera = true;
}

$arrResultados["bandera"]=$bandera;

echo json_encode($arrResultados);

?>