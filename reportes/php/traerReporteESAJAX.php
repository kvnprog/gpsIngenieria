<?php

include "../../fGenerales/bd/conexion.php";

//traer la variables del post

$filtroTipo = filter_input(INPUT_POST, "filtroTipo");
$filtroMovimiento = filter_input(INPUT_POST, "filtroMovimiento");
$filtroProducto = filter_input(INPUT_POST, "filtroProducto");

//checando si trane datos
$parametros = "";

if ($filtroTipo != 0) {

    if ($filtroTipo == 1) {
        $parametros = $parametros . " WHERE  e.ventaid is not null 1  and  e.ordenid is null";
    }

    if ($filtroTipo == 2) {
        $parametros = $parametros . " WHERE  e.ordenid is not null and e.ventaid is null ";
    }

    if ($filtroTipo == 3) {
        $parametros = $parametros . " WHERE  (e.ventaid is null  and e.ordenid is null) ";
    }
}

if ($filtroMovimiento != 0) {

    if ($parametros == "") {

        $parametros = $parametros . " WHERE  e.tipoid= " . $filtroMovimiento;
    } else {

        $parametros = $parametros . " AND  e.tipoid = " . $filtroMovimiento;
    }
}


if ($filtroProducto != "") {

    //buscando aque producto corresponde y sacando el id 

    if ($parametros == "") {

        $parametros = $parametros . " WHERE  e.idproducto IN (SELECT idproducto FROM  productos WHERE nparte like '%" . $filtroProducto . "%' OR descripcion like '%" . $filtroProducto . "%') ";
    } else {

        $parametros = $parametros . " AND e.idproducto IN (SELECT idproducto FROM  productos WHERE nparte like '%" . $filtroProducto . "%' OR descripcion like '%" . $filtroProducto . "%') ";
    }
}

$arrResultados = [];

//haciendo la consulta de las entradas y salidas 

$conexionENReporte = new conexion;
$queryENReporte = "select p.nparte ,p.descripcion ,e.cantidad,e.ventaid ,e.ordenid,e.tipoid  from entradassalidas e 
join productos p on p.idproducto = e.idproducto " . $parametros;
$resutadosENReporte = $conexionENReporte->conn->query($queryENReporte);
//echo $queryENReporte."<br>";

$arrResultados["query"] = $queryENReporte;


$arrResultados["noDatos"] = 0;
if ($resutadosENReporte) {

    if ($resutadosENReporte->num_rows > 0) {

        $arrResultados["noDatos"] = $resutadosENReporte->num_rows;


        foreach ($resutadosENReporte->fetch_all() as $index => $datos) {


            $arrResultados[$index]["nparte"] = $datos[0];
            $arrResultados[$index]["descripcion"] = $datos[1];
            $arrResultados[$index]["cantidad"] = $datos[2];

            if (isset($datos[3])) {
                $arrResultados[$index]["ventaid"] = $datos[3];
            } else {
                $arrResultados[$index]["ventaid"] = 0;
            }


            if (isset($datos[4])) {
                $arrResultados[$index]["ordenid"] = $datos[4];
            } else {
                $arrResultados[$index]["ordenid"] = 0;
            }
            
            if($datos[5]==1){
                $arrResultados[$index]["tipo"] = "Entrada";
            }else{
                $arrResultados[$index]["tipo"] = "Salida";
            }

        }
    }
}

echo json_encode($arrResultados);
