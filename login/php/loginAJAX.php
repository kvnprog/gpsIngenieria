<?php

include "../../fGenerales/bd/conexion.php";

$usuario = filter_input(INPUT_POST,"usuario");
$password = filter_input(INPUT_POST,"password");

$conexion = new conexion;

$query = "SELECT*FROM usuarios WHERE nombreusuario = ? and passwordusuario = md5(?) ";

$queryPreparada = $conexion->conn->prepare($query);

$queryPreparada->bind_param('ss',$usuario,$password);


 $queryPreparada->execute();

 $resultados = $queryPreparada->get_result();



$arrRespuesta = [];

 if($resultados->num_rows>0){

//     foreach($resultados->fetch_all() as $row){

//        $arrRespuesta[0] = $row[1]; 

   $arrRespuesta[0] = true;
 
}else{
   $arrRespuesta[0] = false;
}


// }



echo json_encode($arrRespuesta);