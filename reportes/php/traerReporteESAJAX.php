<?php

include "../../fGenerales/bd/conexion.php";

//traer la variables del post

$filtroTipo = filter_input(INPUT_POST,"filtroTipo");
$filtroMovimiento = filter_input(INPUT_POST,"filtroMovimiento");
$filtroProducto = filter_input(INPUT_POST,"filtroProducto");

//checando si trane datos
$parametros = "";

if($filtroTipo!=0){

    if($filtroTipo==1){
        $parametros=$parametros." WHERE  e.ventaid = 1 ";
    }

    if($filtroTipo==2){
        $parametros=$parametros." WHERE  e.ordenid = 1 ";
    }

    if($filtroTipo==3){
        $parametros=$parametros." WHERE  (e.ventaid is null  or e.ordenid is null) ";
    }


 

}

if($filtroMovimiento!=0){

    if($parametros==""){

        $parametros=$parametros." WHERE  e.tipoid= ".$filtroMovimiento;

    }else{

        $parametros=$parametros." AND  e.tipoid = ".$filtroMovimiento;

    }
  

}


if($filtroProducto!=""){

    //buscando aque producto corresponde y sacando el id 

    if($parametros==""){

        $parametros=$parametros." WHERE  e.idproducto IN (SELECT idproducto FROM  productos WHERE nparte like '%".$filtroProducto."%' OR descripcion like '%".$filtroProducto."%') ";

    }else{

        $parametros=$parametros." AND e.idproducto IN (SELECT idproducto FROM  productos WHERE nparte like '%".$filtroProducto."%' OR descripcion like '%".$filtroProducto."%') ";

    }
  

}

$arrResultados = [];

//haciendo la consulta de las entradas y salidas 

$conexionENReporte = new conexion;
$queryENReporte = "select p.nparte ,p.descripcion ,e.cantidad,e.ventaid ,e.ordenid  from entradassalidas e 
join productos p on p.idproducto = e.idproducto ".$parametros;
$resutadosENReporte = $conexionENReporte->conn->query($queryENReporte);

$arrResultados["noDatos"] = $resutadosENReporte->num_rows;
$arrResultados["query"] = $queryENReporte;

var_dump($resutadosENReporte->fetch_row());

if($resutadosENReporte->num_rows>0){

  foreach($resutadosENReporte->fetch_row() as $index => $datos){

    $arrResultados[$index]["nparte"] = $datos[0];
    $arrResultados[$index]["descripcion"] = $datos[1];
    $arrResultados[$index]["cantidad"] = $datos[2];
    $arrResultados[$index]["ventaid"] = $datos[3];
    $arrResultados[$index]["ordenid"] = $datos[4];
    

  }

}

echo json_encode($arrResultados);