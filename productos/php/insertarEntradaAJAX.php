<?php

    include "../../fGenerales/bd/conexion.php";

    $id = filter_input(INPUT_POST, "id");
    $numSerie = filter_input(INPUT_POST, "numSerie");

    $conexionInsertarEntrada = new conexion;
    $queryInsertarEntrada = "INSERT INTO entradas(id_producto, no_serial, id_estado)". 
                            "VALUES (".$id.", '".$numSerie."', 1)";

    $resultados = [];

    if ($conexionInsertarEntrada->conn->query($queryInsertarEntrada)) {
        $resultados["resultado"] = true;
    } else {
        $resultados["resultado"] = false;
    }

    echo json_encode($resultados);
?>