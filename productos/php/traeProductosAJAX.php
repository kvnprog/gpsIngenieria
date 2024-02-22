<?php
    include "../../fGenerales/bd/conexion.php";
    
    $conexionProductos = new conexion;
    $queryProductos = "SELECT p.*,c.nombre, s.nombre  FROM productos p , categoria c, subcategoria s WHERE c.id_categoria = p.id_categoria AND p.id_subcategoria = s.id_subcategoria AND p.id_estado=1";
    $datos = $conexionProductos->conn->query($queryProductos);

    $resultados = [];
    
    if ($conexionProductos->conn->query($queryProductos)) {
        
        $resultados["noDatos"] = $datos->num_rows;

        if($datos->num_rows > 0){
            foreach ($datos->fetch_all() as $i => $datos) {
                $resultados[$i]["id_producto"] = $datos[0];
                $resultados[$i]["no_parte"] = $datos[1];
                $resultados[$i]["descripcion"] = $datos[2];
                $resultados[$i]["precio_public"] = $datos[3];
                $resultados[$i]["precio_venta"] = $datos[4];
                $resultados[$i]["id_categoria"] = $datos[5];
                $resultados[$i]["id_subcategoria"] = $datos[6];
                $resultados[$i]["id_estado"] = $datos[7];
                $resultados[$i]["nombre_categoria"] = $datos[8];
                $resultados[$i]["nombre_subcategoria"] = $datos[9];
            }

            $resultados["resultado"] = true;
        } else {
            $resultados["resultado"] = false;
        }
    }
    echo json_encode($resultados);
?>