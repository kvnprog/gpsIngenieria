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

    //    $conexionDatos = new conexion;
    //    $queryDatos = "SELECT*FROM productos ";



} else {

    $resultados["resultado"] = false;
}

echo json_encode($resultados);
