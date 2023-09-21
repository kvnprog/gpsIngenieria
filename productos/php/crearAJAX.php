<?php

include "../../fGenerales/bd/conexion.php";

$nParte = filter_input(INPUT_POST, "nParte");
$descripcion = filter_input(INPUT_POST, "descripcion");
$categoria = filter_input(INPUT_POST, "categoria");
$maximos = filter_input(INPUT_POST, "maximos");
$minimos = filter_input(INPUT_POST, "minimos");
$existentes = filter_input(INPUT_POST, "existentes");
$comentarios = filter_input(INPUT_POST, "comentarios");
$precio = filter_input(INPUT_POST, "precio");

$conexionCrearProducto = new conexion;
$queryCrearProducto = "INSERT INTO productos(nparte,descripcion,categoria,maximos,minimos,existentes,comentarios,precioxunidad)". 
"VALUES ('" . $nParte . "','" . $descripcion . "','" . $categoria . "','" . $maximos . "','" . $minimos . "','" . $existentes . "','" . $comentarios . "','" . $precio . "')";


$resultados = [];

if ($conexionCrearProducto->conn->query($queryCrearProducto)) {

    //INSERTANDO LAS ENTRADAS 
    $conexionEntradas = new conexion;
    $queryEntradas = "INSERT INTO entradassalidas(tipoid,idproducto,cantidad) VALUES (1,'".$conexionCrearProducto->conn->insert_id."','".$existentes."')";
    $conexionEntradas->conn->query($queryEntradas);

    $resultados["resultado"] = true;

    $conexionDatos = new conexion;
    $queryDatos = "SELECT p.*,c.nombre  FROM productos p , categoriasproductos c  WHERE c.idcategoriaproducto = p.categoria ";
    $datos = $conexionDatos->conn->query($queryDatos);

    $resultados["noDatos"] = $datos->num_rows;

    foreach ($datos->fetch_all() as $i => $datos) {

        $resultados[$i]["id"] = $datos[0];
        $resultados[$i]["nParte"] = $datos[1];
        $resultados[$i]["descripcion"] = $datos[2];
        $resultados[$i]["idcategoria"] = $datos[3];
        $resultados[$i]["categoria"] = $datos[9];
        $resultados[$i]["maximos"] = $datos[4];
        $resultados[$i]["minimos"] = $datos[5];
        $resultados[$i]["existentes"] = $datos[6];
        $resultados[$i]["comentarios"] = $datos[7];
        $resultados[$i]["precio"] = $datos[8];
    }

    if (isset($_FILES["fotoProducto"])) {
    
        if($_FILES["fotoProducto"]["error"] === 0){

            $nombreTemporal = $_FILES["fotoProducto"]["tmp_name"];
            $nombreArchivo = $_FILES["fotoProducto"]["name"];

            $conSelectProducto = new conexion;
            $querySelectProducto = "SELECT idproducto FROM productos order by idproducto DESC limit 1";
            $resultadoSelectProducto = $conSelectProducto->conn->query($querySelectProducto);

            // $idProducto = $resultadoSelectProducto[0];
            foreach($resultadoSelectProducto->fetch_all() as $res){
                $idProducto = $res[0];
            }

            $url_target = '../imgsProductos/producto_' . $idProducto . '.jpg';

            if (move_uploaded_file($nombreTemporal, $url_target)) {
                // echo "Ha sido cargado con éxito.";
            } else {
                // echo "Ha habido un error al cargar tu archivo.";
            }
            
        }else{
            
        }
    }else{
        
    }

} else {

    $resultados["resultado"] = false;
}

echo json_encode($resultados);
