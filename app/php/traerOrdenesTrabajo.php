<?php

include "../../fGenerales/php/funciones.php";
include "../../fGenerales/bd/conexion.php";

//TRAYENDO LOS DATOS 

$fechaI = filter_input(INPUT_GET, "fechaI");

$fechaF = filter_input(INPUT_GET, "fechaF");

$cliente = filter_input(INPUT_GET, "cliente");

$trabajador = filter_input(INPUT_GET, "trabajador");

$nFolio = filter_input(INPUT_GET, "nFolio");

//CHECANDO QUE ARGUMENTOS SE VAN A MANDAR

$cadenaCliente = "";

if ($cliente != "") {

    $cadenaCliente = " AND c.nombre like '%" . $cliente . "%' ";
}

$cadenaTrabajador = "";

if ($trabajador != "") {

    $cadenaTrabajador = " AND u.nombreusuario like '%" . $trabajador . "%' ";
}

$cadenaOrden = "";

if ($fechaI != "" && $fechaF != "") {

    $cadenaOrden = " AND o.fecha::DATE BETWEEN '".$fechaI."' AND '".$fechaF."' ";

}

if($nFolio!=""){

    $cadenaOrden = " AND o.numfolio = ".$nFolio;

}

//HACIENDO LA QUERY PARA TRAER LOS RESULTADOS

$conexionOrden = new conexion;

$queryOrden = "SELECT o.ordenid,o.numfolio,u.nombreusuario,c.nombre,o.totalpago  
FROM ordentrabajo o  
JOIN usuarios u ON o.idusuario = u.idusuario " . $cadenaTrabajador .
    " JOIN clientes c ON c.idcliente = o.idcliente " . $cadenaCliente .
    " WHERE o.banderaautorizadar = 1 " .$cadenaOrden;

$resultado = $conexionOrden->conn->query($queryOrden);

//MANDANDO LOS DATOS EN UN JSON

$arrResultados = [];

$arrResultados["noDatos"] = $resultado->num_rows;

foreach($resultado->fetch_all() as $index=>$orden){

    $arrResultados[$index]["idorden"] = $orden[0];
    $arrResultados[$index]["numFolio"] = $orden[1];
    $arrResultados[$index]["nombreEmpleado"] = $orden[2];
    $arrResultados[$index]["nombreCliente"] = $orden[3];
    $arrResultados[$index]["TotalPago"] = $orden[4];

}

echo json_encode($arrResultados);

