<?php

include "../../fGenerales/php/funciones.php";

$usuario = filter_input(INPUT_POST,"usuario");
$password = filter_input(INPUT_POST,"password");

$arrRespuesta = [];

if(checarLogin($usuario,$password)){
   $arrRespuesta[0]["accesso"] = true;
}else{
   $arrRespuesta[0]["accesso"] = false;
}


echo json_encode($arrRespuesta);