<?php

include "../../fGenerales/bd/conexion.php";

$nParte = filter_input(INPUT_POST, "nParte");
$descripcion = filter_input(INPUT_POST, "descripcion");
$categoria = filter_input(INPUT_POST, "categoria");
$maximos = filter_input(INPUT_POST, "maximos");
$minimos = filter_input(INPUT_POST, "minimos");
$existentes = filter_input(INPUT_POST, "existentes");
$comentarios = filter_input(INPUT_POST, "comentarios");

$conexionCrearProducto = new conexion;
$queryCrearProducto = "INSERT INTO productos(nparte,descripcion,categoria,maximos,minimos,existentes,comentarios) 
VALUES ('" . $nParte . "','" . $descripcion . "'," . $categoria . "," . $maximos . "," . $minimos . "," . $existentes . ",'" . $comentarios . "')";



$resultados = [];
$resultados["query"] = $queryCrearProducto;
if ($conexionCrearProducto->conn->query($queryCrearProducto)) {

    $resultados["resultado"] = true;

    $conexionDatos = new conexion;
    $queryDatos = "SELECT p.*,c.nombre  FROM productos p , categoriasproductos c  WHERE c.idcategoriaproducto = p.categoria ";
    $datos = $conexionDatos->conn->query($queryDatos);

    $resultados["noDatos"] = $datos->num_rows;

    foreach ($datos->fetch_all() as $i => $datos) {

        $resultados[$i]["id"] = $datos[0];
        $resultados[$i]["nParte"] = $datos[1];
        $resultados[$i]["descripcion"] = $datos[2];
        $resultados[$i]["idcategoria"] = $datos[3];
        $resultados[$i]["categoria"] = $datos[8];
        $resultados[$i]["maximos"] = $datos[4];
        $resultados[$i]["minimos"] = $datos[5];
        $resultados[$i]["existentes"] = $datos[6];
        $resultados[$i]["comentarios"] = $datos[7];
        
        
    }
} else {

    $resultados["resultado"] = false;
}

echo json_encode($resultados);
