<?php 


include "../../fGenerales/bd/conexion.php";

$idseccion = filter_input(INPUT_GET,"idseccion");
$idusuario = filter_input(INPUT_GET,"idusuario");

$conexionChecarPermiso = new conexion;
$queryChecarPermiso = "SELECT*FROM permisossecciones WHERE  idusuario=".$idusuario." and idseccion=".$idseccion;

$checar = $conexionChecarPermiso->conn->query($queryChecarPermiso);

$resultado = [];

if($checar->num_rows>0){

    //ELIMINANDO PERMISO

    $conexionEliminarPermiso = new conexion;
    $queryEliminarPermiso = "DELETE FROM permisossecciones WHERE  idusuario=".$idusuario." and idseccion=".$idseccion;
    $conexionEliminarPermiso->conn->query($queryEliminarPermiso);

    $resultado["resultado"] = true;

}else{

    $conexionAgregarPermisos = new conexion;
    $queryAgregarPermisos = "INSERT INTO permisossecciones VALUES (".$idusuario.",".$idseccion.") ";
    $conexionAgregarPermisos->conn->query($queryAgregarPermisos);

    $resultado["resultado"] = false;
}

echo json_encode($resultado);