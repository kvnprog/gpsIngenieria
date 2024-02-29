<?php
    include "../../fGenerales/bd/conexion.php";
    
    if( isset($_GET["arrayEntradas"]) ) {

        $arrayEntradas = $_GET['arrayEntradas'];

        $arrayEntradasPHP = array();
        foreach ($arrayEntradas as $entradaJSON) {
            $entrada = json_decode($entradaJSON, true); // TRUE PARA OBTENER ARRAY ASOCIATIVO
            if ($entrada) {
                $arrayEntradasPHP[] = $entrada;
            }
        }

        $conexionInsertarEntrada = new conexion;
        $resultados = [];

        foreach ($arrayEntradasPHP as $entrada) {
            $id = $entrada['idProd'];
            $numSerie = $entrada['noSerie'];
            $queryInsertarEntrada = "INSERT INTO entradas(id_producto, no_serial, id_estado, fecha_registro) VALUES ($id, '$numSerie', 1, NOW())";
            
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
