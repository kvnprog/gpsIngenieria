<?php

    $arrRegSeleccionados = filter_input(INPUT_GET,'arrRegSeleccionados');    
            
    $respuesta = array(
        'mensaje' => 'Se borró el archivo correctamente del directorio.',
        'bandera' => $bandera = 1,
        'array' => $arrRegSeleccionados
    );    
       
    header('Content-Type: application/json');
    echo json_encode($respuesta);

?>