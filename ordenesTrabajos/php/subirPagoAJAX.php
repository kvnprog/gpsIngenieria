<?php 

include "../../fGenerales/bd/conexion.php";

$id = filter_input(INPUT_POST,"id");
$cantidad = filter_input(INPUT_POST,"cantidad");

$evidencia = $_FILES["evidencia"];

$conexionSubirPago = new conexion;

$query="INSERT INTO pagos(ordenid,cantidad) VALUES (".$id.",'".$cantidad."') ";

$conexionSubirPago->conn->query($query);


move_uploaded_file($_FILES["evidencia"]["tmp_name"],"../../ordenesTrabajos/evidencias/evidencia".$conexionSubirPago->conn->insert_id.".jpg");



$resultado=[];

$resultado["resultado"]=true;

echo json_encode($resultado);








