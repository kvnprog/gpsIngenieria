<?php 

include "../../fGenerales/bd/conexion.php";

$datosOrden = filter_input(INPUT_GET,"datosOrden");


//procesando los datos de la respuesta 

$datosOrden = json_decode($datosOrden); 

var_dump($datosOrden);


$clienteid = $datos[0];
$firmaCliente = $datos[1];
$problemas = $datos[2];
$trabajo = $datos[3];
$firmaEmpleado = $datos[4];
$usuarioid = $datos[5];

//subiendo firmas 






//INSERTANDO LA ORDEN DE TRABAJO

$conexionInsertaOrden = new conexion;

$queryInsertaOrden = "INSERT INTO ordentrabajo(idusuario,trabajoreali)";





// $queryInsertarOrden = "INSERT INTO ordentrabajo";
