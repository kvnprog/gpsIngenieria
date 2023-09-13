<?php

include "../../fGenerales/bd/conexion.php";

$filtroNFolio = filter_input(INPUT_GET,"filtroNFolio");
$filtroTrabajador = filter_input(INPUT_GET,"filtroTrabajador");
$filtroCliente = filter_input(INPUT_GET,"filtroCliente");
$filtroFechaI = filter_input(INPUT_GET,"filtroFechaI");
$filtroFechaF = filter_input(INPUT_GET,"filtroFechaF");


$cadena = "";

if($filtroNFolio != 0){ 

   $cadena = $cadena .  " AND CAST(ot.numfolio AS CHARACTER) LIKE '%".$filtroNFolio."%'";

}

if($filtroTrabajador != ""){ 

    $cadena = $cadena .  "  AND u.nombre LIKE '%".$filtroTrabajador."%'";
 
 }

 if($filtroCliente != ""){ 

    $cadena = $cadena .  "   AND CONCAT(c.nombre, ' ',c.apellidos) LIKE '%".$filtroCliente."%'";
 
 }

 if($filtroFechaI != ""  && $filtroFechaF != ""){ 

    $cadena = $cadena .  "  AND ot.fecha BETWEEN '".$filtroFechaI."' AND DATE_ADD('".$filtroFechaF."', INTERVAL 1 DAY) ";
 
 }
//TRAYENDO LOS DATOS

$conexionDatos = new conexion;
$queryDatos = "SELECT ot.ordenid,ot.numfolio,c.nombre ,c.apellidos,u.nombre,ot.totalpago,ot.fecha,ot.saldopendiente,ot.factura   FROM ordentrabajo ot,clientes c,usuarios u  WHERE ot.idcliente = c.idcliente and u.idusuario = ot.idusuario  " . $cadena;
//echo $queryDatos;

$datos = $conexionDatos->conn->query($queryDatos);

$resultado["noDatos"] = $datos->num_rows;
$resultado["query"] = $queryDatos;

foreach ($datos->fetch_all() as $i => $dato) {

    $resultado[$i]["id"] = $dato[0];
    $resultado[$i]["numfolio"] = $dato[1];
    $resultado[$i]["cliente"] = $dato[2]." ".$dato[3];
    $resultado[$i]["trabajador"] = $dato[4];
    $resultado[$i]["total"] = $dato[5];
    $resultado[$i]["fecha"] = $dato[6];
    $resultado[$i]["factura"] = $dato[8];
    $resultado[$i]["pagoP"] = $dato[7];
    
    
    
}

echo json_encode($resultado);