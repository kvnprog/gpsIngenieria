<?php 

// Cargar la biblioteca PHPExcel
require '../../vendor/autoload.php';

// Verificar si se ha enviado un archivo a través de la solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == UPLOAD_ERR_OK) {
    // Obtener la ruta temporal del archivo cargado
    $archivoTemp = $_FILES["archivo"]["tmp_name"];

    // Crear un objeto PHPExcel para manejar el archivo
    $excel = PHPExcel_IOFactory::load($archivoTemp);

    // Seleccionar la hoja activa
    $hoja = $excel->getActiveSheet();

    // Obtener el número total de filas y columnas
    $totalFilas = $hoja->getHighestRow();
    $totalColumnas = PHPExcel_Cell::columnIndexFromString($hoja->getHighestColumn());

    // Recorrer las celdas y mostrar su contenido
    for ($fila = 1; $fila <= $totalFilas; $fila++) {
        for ($columna = 0; $columna < $totalColumnas; $columna++) {
            $valorCelda = $hoja->getCellByColumnAndRow($columna, $fila)->getValue();
            echo "Celda " . PHPExcel_Cell::stringFromColumnIndex($columna) . "$fila: $valorCelda" . PHP_EOL;
        }
    }
} else {
    echo "No se ha enviado ningún archivo o se produjo un error al cargar el archivo.";
}