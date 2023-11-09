<?php

include "../../fGenerales/bd/conexion.php";

$idusuario = filter_input(INPUT_GET, "idusuario");

//checando las areas 

$conexionAreas = new conexion;
$queryAreas = "SELECT*FROM areas";
$areas = $conexionAreas->conn->query($queryAreas);

$datos = [];
$datos["noDatosAreas"][0]["noDatos"] = $areas->num_rows;
foreach ($areas->fetch_all() as $key => $area) {

    $datos["areas"][$key]["id"] = $area[0];
    $datos["areas"][$key]["nombre"] = $area[1];
}



//checar permisos 
$conexionPermisos = new conexion;
$queryPermisos = "select s.idseccion ,s.idarea , s.nombre, p.idusuario   from seccionesareas s  
                  left join   permisossecciones p  on  p.idseccion = s.idseccion and p.idusuario =" . $idusuario
    . " order by s.idseccion asc";
$permisos = $conexionPermisos->conn->query($queryPermisos);

$datos["noDatosSeccion"][0]["noDatos"] = $permisos->num_rows;

foreach ($permisos->fetch_all() as $index => $permiso) {

    $datos["secciones"][$index]["idseccion"] = $permiso[0];
    $datos["secciones"][$index]["idarea"] = $permiso[1];
    $datos["secciones"][$index]["nombre"] = $permiso[2];
    $datos["secciones"][$index]["idusuario"] = $permiso[3];
    if ($permiso[3] != null) {
        $datos["secciones"][$index]["permiso"] = true;
    } else {
        $datos["secciones"][$index]["permiso"] = false;
    }
}




echo json_encode($datos);
