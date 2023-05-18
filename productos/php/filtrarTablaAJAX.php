<?php

include "../../fGenerales/bd/conexion.php";

$nParte = filter_input(INPUT_GET,"nParte");
$descripcion = filter_input(INPUT_GET,"descripcion");
$categoriaid = filter_input(INPUT_GET,"categoriaid");


$cadena = "";

if($nParte != ""){ 

   $cadena = $cadena .  " AND p.nparte like '%".$nParte."%'";

}

if($descripcion != ""){ 

    $cadena = $cadena .  "  AND p.descripcion like '%".$descripcion."%'";
 
 }

 if($categoriaid != 0){ 

    $cadena = $cadena .  "  AND p.categoria = " .$categoriaid;
 
 }

//TRAYENDO LOS DATOS

$conexionDatos = new conexion;
$queryDatos = "SELECT p.*,c.nombre  FROM productos p , categoriasproductos c  WHERE c.idcategoriaproducto = p.categoria " . $cadena;
$datos = $conexionDatos->conn->query($queryDatos);

$resultado["noDatos"] = $datos->num_rows;

foreach ($datos->fetch_all() as $i => $datos) {

    $resultado[$i]["id"] = $datos[0];
    $resultado[$i]["nParte"] = $datos[1];
    $resultado[$i]["descripcion"] = $datos[2];
    $resultado[$i]["idcategoria"] = $datos[3];
    $resultado[$i]["categoria"] = $datos[8];
    $resultado[$i]["maximos"] = $datos[4];
    $resultado[$i]["minimos"] = $datos[5];
    $resultado[$i]["existentes"] = $datos[6];
    $resultado[$i]["comentarios"] = $datos[7];
    
    
}

echo json_encode($resultado);