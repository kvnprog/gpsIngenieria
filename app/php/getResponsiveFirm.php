<?php

include "../../fGenerales/bd/conexion.php";
include "../../fGenerales/php/funciones.php";

$dateEnd = filter_input(INPUT_GET,"dateEnd");
$dateStart = filter_input(INPUT_GET,"dateStart");

$arguments = "";

if($dateStart =! "" && $dateEnd != "") {
  $arguments = " AND fechacreacion BETWEEN '".$dateStart."' AND '".$dateEnd."' ";
}

$conn = new conexion;
$query = "SELECT r.*,c.nombre FROM responsivas r,usuarios c WHERE r.estadoid = 1 AND r.usuarioid = c.idusuario ".$argumetos;
$result = $conn->conn->query($query);

$arrResult = [];

if ($result->num_rows > 0) {

    foreach($result->fetch_all() as $index => $data){
      $arrData = [];
      $arrData["idresponsiva"] = $data[0];
      $arrData["usuario"] = $data[5];
      $arrData["fecha"] = $data[2];
      $arrResult[] = $arrData;
    }

    $arrResult["error"] = 0;//TODO SALIO BIEN
} else {

    $arrResult["error"] = 1;//NOSE ENCONTRARON DATOS
}

echo json_encode($arrResult);

