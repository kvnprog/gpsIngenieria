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

    $nExistencias = intval($existencias) + $existenciasNuevas;
    // echo $existencias."<br>";
    // echo $existenciasNuevas."<br>";
    // echo $nExistencias."<br>";

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

    $conexionDatos = new conexion;
    $queryDatos = "SELECT p.*,c.nombre  FROM productos p , categoriasproductos c  WHERE c.idcategoriaproducto = p.categoria ";
    $datos = $conexionDatos->conn->query($queryDatos);

    $arrResultados["noDatos"] = $datos->num_rows;




    foreach ($datos->fetch_all() as $i => $datos) {

        $arrResultados[$i]["id"] = $datos[0];
        $arrResultados[$i]["nParte"] = $datos[1];
        $arrResultados[$i]["descripcion"] = $datos[2];
        $arrResultados[$i]["idcategoria"] = $datos[3];
        $arrResultados[$i]["categoria"] = $datos[9];
        $arrResultados[$i]["maximos"] = $datos[4];
        $arrResultados[$i]["minimos"] = $datos[5];
        $arrResultados[$i]["existentes"] = $datos[6];
        $arrResultados[$i]["comentarios"] = $datos[7];
        $arrResultados[$i]["precio"] = $datos[8];
    }

}

$arrResultados["bandera"]=$bandera;

echo json_encode($arrResultados);

?>