<?php

include "../../fGenerales/bd/conexion.php";

$idusuario = filter_input(INPUT_GET, "idusuario");

//checando las areas 

$conexionAreas = new conexion;
$queryAreas ="SELECT*FROM areas";
$areas = $conexionAreas->conn->query($queryAreas);

$datos=[];
$datos["areas"][0]["noDatos"]=$areas->num_rows;
foreach($areas->fetch_all() as $key=>$area){

  $datos["areas"][$key]["id"]=$area[0];
  $datos["areas"][$key]["nombre"]=$area[2];

}




echo json_encode($datos);
