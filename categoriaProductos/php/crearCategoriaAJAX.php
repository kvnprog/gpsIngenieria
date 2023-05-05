<?php

include "../../fGenerales/bd/conexion.php";

$nombre = filter_input(INPUT_GET, "nombre");

$conexionCrearCategoria = new conexion;
$queryCrearCategoria = "INSERT INTO categoriasproductos(nombre) VALUES ('" . $nombre . "')";

$resultado = [];

if ($conexionCrearCategoria->conn->query($queryCrearCategoria)) {

    $resultado["resultado"] = true;
} else {

    $resultado["resultado"] = false;
}

echo json_encode($resultado);