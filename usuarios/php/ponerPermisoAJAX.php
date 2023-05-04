<?php 


include "../../fGenerales/bd/conexion.php";

$idseccion = filter_input(INPUT_GET,"idseccion");
$idusuario = filter_input(INPUT_GET,"idusuario");

$conexionChecarPermiso = new conexion;
$queryChecarPermiso = "SELECT*FROM permisossecciones WHERE  idusuario=".$idsuario." and idseccion=".$idseccion;

$checar = $conexionChecarPermiso->conn->query($queryChecarPermiso);

$resultado = [];

if($checar->num_rows>0){

    //ELIMINANDO PERMISO

    $resultado["resultado"] = true;

}else{
    $resultado["resultado"] = false;
}