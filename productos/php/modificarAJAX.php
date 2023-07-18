<?php

include "../../fGenerales/bd/conexion.php";
//DECALRANDO LA VARIABLES QUE LLEGARAN POR POST

$id = filter_input(INPUT_POST, "id");
$nParte = filter_input(INPUT_POST, "nParte");
$descripcion = filter_input(INPUT_POST, "descripcion");
$categoria = filter_input(INPUT_POST, "categoria");
$maximos = filter_input(INPUT_POST, "maximos");
$minimos = filter_input(INPUT_POST, "minimos");
$existentes = filter_input(INPUT_POST, "existentes");
$comentarios = filter_input(INPUT_POST, "comentarios");
$precio = filter_input(INPUT_POST, "precio");

$resultado = [];

//PONIENDO LOS CAMBIOS 

$conexionModificar = new conexion;
$queryModificar = "UPDATE productos SET nparte='".$nParte."',descripcion='".$descripcion."',categoria=".$categoria.
                   ",maximos=".$maximos.",minimos=".$minimos.",comentarios='".$comentarios."',precioxunidad='".$precio."'"
                   ." WHERE idproducto = ".$id;
                  
if($conexionModificar->conn->query($queryModificar)){

   $resultado["resultado"]=true;

   //TRAYENDO LOS DATOS

    $conexionDatos = new conexion;
    $queryDatos = "SELECT p.*,c.nombre  FROM productos p , categoriasproductos c  WHERE c.idcategoriaproducto = p.categoria ";
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
        $resultado[$i]["precio"] = $datos[8];
        
        
    }

}else{
    $resultado["resultado"]=false; 
}

echo json_encode($resultado);