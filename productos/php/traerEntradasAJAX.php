<?php
    include "../../fGenerales/bd/conexion.php";
    
    $resultados = [];
    
    if (isset($_GET['numParte']) && isset($_GET['descripcion']) && isset($_GET['numSerie']) && isset($_GET['detallado']) ) {
        
        $cadenaQuery = '';
        if($_GET['numParte'] != ''){
            $cadenaQuery .= " AND p.no_parte LIKE '%" . $_GET['numParte'] . "%'";
        }
        if($_GET['descripcion'] != ''){
            $cadenaQuery .= " AND p.descripcion LIKE '%" . $_GET['descripcion'] . "%'";
        }
        if($_GET['numSerie'] != ''){
            $cadenaQuery .= " AND e.no_serial LIKE '%" . $_GET['numSerie'] . "%'";
        }

        $conexionProductos = new conexion;

        $detallado = $_GET['detallado'];
        
        if($detallado == 'true'){

            $resultados["detallado"] = 1; //CATALOGO DETALLADO

            $queryProductos = "SELECT e.id_entrada, e.no_serial, p.no_parte, p.descripcion, e.num_entrada, e.fecha_registro FROM productos p, entradas e WHERE e.id_producto = p.id_producto AND e.id_estado = 1 " . $cadenaQuery;
            $datos = $conexionProductos->conn->query($queryProductos);

            if ($conexionProductos->conn->query($queryProductos)) {
                
                $resultados["noDatos"] = $datos->num_rows;

                if($datos->num_rows > 0){
                    foreach ($datos->fetch_all() as $i => $datos) {
                        $resultados[$i]["id_entrada"] = $datos[0];
                        $resultados[$i]["no_serial"] = $datos[1];
                        $resultados[$i]["no_parte"] = $datos[2];
                        $resultados[$i]["descripcion"] = $datos[3];
                        $resultados[$i]["num_entrada"] = $datos[4];
                        $resultados[$i]["fecha_registro"] = $datos[5];
                    }

                    $resultados["resultado"] = 1;
                } else {
                    $resultados["resultado"] = 2;
                }
            }
        } else { 
            $resultados["detallado"] = 0; //CATALOGO GENERAL

            $queryProductos = "SELECT e.num_entrada, e.fecha_registro FROM productos p, entradas e WHERE e.id_producto = p.id_producto AND e.id_estado = 1 " . $cadenaQuery . " GROUP BY e.num_entrada, e.fecha_registro";
            $datos = $conexionProductos->conn->query($queryProductos);

            if ($conexionProductos->conn->query($queryProductos)) {
                
                $resultados["noDatos"] = $datos->num_rows;

                if($datos->num_rows > 0){
                    foreach ($datos->fetch_all() as $i => $datos) {
                        $resultados[$i]["num_entrada"] = $datos[0];
                        $resultados[$i]["fecha_registro"] = $datos[1];
                    }

                    $resultados["resultado"] = 1;
                } else {
                    $resultados["resultado"] = 2;
                }
            }
        }

    } else {
        $resultados["resultado"] = 0;
    }

    echo json_encode($resultados);
?>