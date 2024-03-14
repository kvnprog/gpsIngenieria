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
        if($_GET['numSerie'] != ''){
            $cadenaQuery .= " AND i.no_serial LIKE '%" . $_GET['numSerie'] . "%'";
        }

        $conexionProductos = new conexion;
        $queryProductos = "SELECT i.id_inventario, i.id_producto, i.no_serial, p.no_parte, p.descripcion, i.fecha_registro, i.tipo_movimiento FROM productos p, inventario i WHERE i.id_producto = p.id_producto AND (i.tipo_movimiento = 1 or 2) AND i.id_estado = 1 " . $cadenaQuery;
        $datos = $conexionProductos->conn->query($queryProductos);

        if ($conexionProductos->conn->query($queryProductos)) {
            
            $resultados["noDatos"] = $datos->num_rows;

            if($datos->num_rows > 0){
                foreach ($datos->fetch_all() as $i => $datos) {
                    $resultados[$i]["id_inventario"] = $datos[0];
                    $resultados[$i]["id_producto"] = $datos[1];
                    $resultados[$i]["no_serial"] = $datos[2];
                    $resultados[$i]["no_parte"] = $datos[3];
                    $resultados[$i]["descripcion"] = $datos[4];
                    $resultados[$i]["fecha_registro"] = $datos[5];
                    $resultados[$i]["tipo_movimiento"] = $datos[6];
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