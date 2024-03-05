<?php
    include "../../fGenerales/bd/conexion.php";
    
    $resultados = [];
    
    if (isset($_GET['numParte']) && isset($_GET['descripcion']) && isset($_GET['numSerie']) ) {
        
        $cadenaQuery = '';
        if($_GET['numParte'] != ''){
            $cadenaQuery .= " AND p.no_parte LIKE '%" . $_GET['numParte'] . "%'";
        }
        if($_GET['descripcion'] != ''){
            $cadenaQuery .= " AND p.descripcion LIKE '%" . $_GET['descripcion'] . "%'";
        }
        if($_GET['numSerie'] != 0){
            $cadenaQuery .= " AND e.no_serial LIKE '%" . $_GET['numSerie'] . "%'";
        }

        $conexionProductos = new conexion;
        $queryProductos = "SELECT e.id_entrada, e.no_serial, p.no_parte, p.descripcion FROM productos p, entradas e WHERE e.id_producto = p.id_producto AND e.id_estado = 1 " . $cadenaQuery;
        $datos = $conexionProductos->conn->query($queryProductos);

        if ($conexionProductos->conn->query($queryProductos)) {
            
            $resultados["noDatos"] = $datos->num_rows;

            if($datos->num_rows > 0){
                foreach ($datos->fetch_all() as $i => $datos) {
                    $resultados[$i]["id_entrada"] = $datos[0];
                    $resultados[$i]["no_serial"] = $datos[1];
                    $resultados[$i]["no_parte"] = $datos[2];
                    $resultados[$i]["descripcion"] = $datos[3];
                }

                $resultados["resultado"] = 1;
            } else {
                $resultados["resultado"] = 2;
            }
        }
    } else {
        $resultados["resultado"] = 0;
    }

    echo json_encode($resultados);
?>