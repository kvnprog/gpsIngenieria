<?php

include "../../fGenerales/bd/conexion.php";


$id = filter_input(INPUT_POST, "id");
$nombre = filter_input(INPUT_POST, "nombre");

$resultado = [];

//CHECAR SI LA CATEGORIA YA EXISTE

$conexionChecarCategoria = new conexion;
$queryChecarCategoria  = "SELECT*FROM categoriasproductos WHERE nombre = '".$nombre."' AND idcategoriaproducto <> ".$id;
$checarCategoria = $conexionChecarCategoria->conn->query($queryChecarCategoria);
if($checarCategoria->num_rows > 0){
  
   $resultado["resultado"] = 0; //el usuario esta repetido 

}else{

   //MODIFICA LA CATEGORIA

   $conexionModificar =  new conexion;
   $queryModificar = "UPDATE categoriasproductos SET nombre = '".$nombre."' WHERE idcategoriaproducto = ".$id;
   if($conexionModificar->conn->query($queryModificar)){
    $resultado["resultado"] = 1; //se hiso la modificacion 

    //TRAER CATEGORIAS

    $conexionTraerCategorias = new conexion;
    $queryTraerCategorias = "SELECT*FROM categoriasproductos";

    $datos = $conexionTraerCategorias->conn->query($queryTraerCategorias);

    $resultado["noDatos"] = $datos->num_rows;

    foreach($datos->fetch_all() as $index => $dato){

      $resultado[$index]["id"] = $dato[0];
      $resultado[$index]["nombre"] = $dato[1];

    }


   }else{
    $resultado["resultado"] = 2; //hubo un error en la modificacion 
   }
}

echo json_encode($resultado);