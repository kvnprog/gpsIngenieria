<?php
    include "../../fGenerales/bd/conexion.php";
    
    if( isset($_GET["arrayEntradas"]) ) {

        $arrayEntradas = $_GET['arrayEntradas'];
        $numEntrada = '';

        $arrayEntradasPHP = array();
        foreach ($arrayEntradas as $entradaJSON) {
            $entrada = json_decode($entradaJSON, true); // TRUE PARA OBTENER ARRAY ASOCIATIVO
            if ($entrada) {
                $arrayEntradasPHP[] = $entrada;
            }
        }

        $conexionInsertarEntrada = new conexion;
        $resultados = [];

        $conexionNumEntrada = new conexion;
        $queryNumEntrada = "SELECT num_entrada FROM entradas ORDER BY id_entrada DESC LIMIT 1"; //VERIFICA LA ULTIMA ENTRADA
        $datos = $conexionNumEntrada->conn->query($queryNumEntrada);

        if($datos->num_rows > 0){
            foreach ($datos->fetch_all() as $i => $datos) {
                $numEntrada = $datos[0] + 1; //SUMA 1 PARA DARLE SEGUIMIENTO HACIA LA NUEVA ENTRADA
            }
        } else {
            $numEntrada = 1;
        }

        foreach ($arrayEntradasPHP as $entrada) {
            $id = $entrada['idProd'];
            $numSerie = $entrada['noSerie'];
            $queryInsertarEntrada = "INSERT INTO entradas(id_producto, no_serial, id_estado, fecha_registro, num_entrada) VALUES ($id, '$numSerie', 1, NOW(), $numEntrada)";
            
            if ($conexionInsertarEntrada->conn->query($queryInsertarEntrada)) {
                $resultados["resultado"] = true;
            } else {
                $resultados["resultado"] = false;
            }
        }
    } else {
        $resultados["resultado"] = false;
    }
    echo json_encode($resultados);
?>
