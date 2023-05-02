<?php

include "../../fGenerales/bd/conexion.php";

$idusuario = filter_input(INPUT_GET,"idusuario");

//checando los permisos

$conexionPermisos = new conexion;
$queryPermisos = "select*from permisossecciones where idusuario=".$idusuario ;
$resultados = $conexionPermisos->conn->query($queryPermisos);

$datos = [];

$conexionSecciones = new conexion;
$querySecciones = "select*from secciones areas";
$conexionSecciones->conn->query($querySecciones);

foreach($resultados->fetch_all() as $permiso){
  

   

}


