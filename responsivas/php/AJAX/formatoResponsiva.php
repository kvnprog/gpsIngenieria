<?php
    header('Content-Type: text/html; charset=utf-8');
    
    include "../../../fGenerales/bd/conexion.php";

    require '../../../vendor/autoload.php';

    // IMPORTA LA CLASE Fpdf DE LA BIBLIOTECA
    use Fpdf\Fpdf as Fpdf;

    // INSTANCIA PDF CREADA
    $pdf = new Fpdf();

    // AGREGA UNA PAGINA AL PDF
    $pdf->AddPage();

    // VARIABLES GLOBALES
    $ancho = 5;
    $añoActual = date("Y");
    $fechaActual = date("d/M/Y");

    // ARRAYS QUE CONTIENEN LOS ID Y LOS VALORES SELECCIONADOS PARA LAS RESPONSIVAS
    $arrayIds = filter_input(INPUT_GET,"arrayId");
    $arrayIds = explode(",", $arrayIds);
    $arrayValores = filter_input(INPUT_GET,"arrayValores");
    $arrayValores = explode(",",$arrayValores);

    $pdf->SetLineWidth(.2); //GROSOR DE LINEA

    $pdf->SetFont('Arial', '', 12); //FUENTE
    $pdf->SetTitle('RESPONSIVA'); //TITULO DEL DOCUMENTO
    $pdf->SetAuthor('GPS INGENIERIA'); //AUTOR
    $pdf->SetCreator('GPSIngeniería © 2023'); //CREADOR

    $pdf->Cell(40, $ancho*3, "", "TLB",0,"C");
    $pdf->Image('../../../src/imagenes/logo.png', 24, 8.5, 17, 0, 'png'); //IMAGEN LOGO

    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(137, 172, 118);

    $pdf->Cell(70, $ancho, "RESPONSIVA", "T",0,"C"); //RESPONSIVA
    $pdf->Cell(25, $ancho, utf8_decode("AÑO"), "TL",0,"C",true);  //AÑO
    $pdf->Cell(30, $ancho, "Responsiva.No", "RTL",0,"C",true); //NUMERO DE RESPONSIVA

    $pdf->SetTextColor(203,50,52); //COLOR ROJO PARA EL TEXTO
    $pdf->Cell(25, $ancho, "N.Folio", "RT",0,"C"); //NUMERO DE FOLIO


    $pdf->SetTextColor(0,0,0); //COLOR NEGRO
    $pdf->SetFont('Arial', '', 7); //FUENTE

    $pdf->Ln(); //SALTO DE LINEA

    $pdf->Cell(40, 30, "", 0); //CELDA VACÍA
    $pdf->Cell(70, $ancho, "Carta Responsiva entregada por GPS INGENIERIA","",0, "C"); //DESCRIPCIÓN RESPONSIVA
    $pdf->Cell(25, $ancho, $añoActual, "TL",0,"C"); //AÑO ACTUAL
    $pdf->Cell(30, $ancho, "#", "RTL",0,"C"); //NUMERO DE RESPONSIVA
    $pdf->Cell(25, $ancho, "", "RTL",0,"C"); //CELDA VACÍA


    $pdf->Ln(); // SALTO DE LINEA

    $pdf->Cell(40, $ancho, "", ""); //CELDA VACÍA
    $pdf->Cell(70, $ancho, "Col. Primero de Mayo CP: 36644 Tel: 462-173-51-96", "B",0,"C"); //DESCRIPCIÓN
    $pdf->Cell(25, $ancho, "Emitida:", "LTB",0,"C"); //EMITIDA 
    $pdf->Cell(30, $ancho, $fechaActual , "BTR",0); //FECHA ACTUAL
    $pdf->Cell(25, $ancho, "", "RB"); //CELDA VACÍA

    $pdf->Ln(20); // SALTO DE LINEA

    $pdf->SetTextColor(0,0,0); //COLOR NEGRO
    $pdf->SetFont('Arial', '', 10); //FUENTE

    $pdf->Cell(50, $ancho, "Fecha: " . $fechaActual, "",0,"L"); //FECHA

    $pdf->Ln(); // SALTO DE LINEA

    $pdf->Cell(50, $ancho, "Irapuato, Guanajuato", "",0,"L"); //LUGAR
    
    $pdf->Ln(10); // SALTO DE LINEA

    $pdf->Cell(190, $ancho, "A quien corresponda.", "",0,"L"); //TEXTO RESPONSIVA
    
    $pdf->Ln(10); // SALTO DE LINEA

    $pdf->Cell(190, $ancho, utf8_decode("Por medio de la presente, hago constar que recibí de la empresa GPS INGENIERIA el producto con las características"), "", 0, "L"); //TEXTO RESPONSIVA
    $pdf->Ln(); // SALTO DE LINEA
    $pdf->Cell(190, $ancho, utf8_decode("que se mencionan a continuación para el uso y desarrollo de actividades relacionadas con mi actividad laborar:"), "", 0, "L"); //TEXTO RESPONSIVA

    $pdf->Ln(10); // SALTO DE LINEA

    $pdf->SetFont('Arial', 'B', 10); //NEGRITAS

    $pdf->Cell(30, $ancho, utf8_decode("Número de parte"), "BTLR", 0, "C"); //TITULO DE TABLA
    $pdf->Cell(55, $ancho, "Nombre", "BTLR", 0, "C"); //TITULO DE TABLA
    $pdf->Cell(55, $ancho, utf8_decode("Descripción"), "BTLR", 0, "C"); //TITULO DE TABLA
    $pdf->Cell(30, $ancho, "Precio unidad", "BTLR", 0, "C"); //TITULO DE TABLA
    $pdf->Cell(20, $ancho, "Cantidad", "BTLR", 0, "C"); //TITULO DE TABLA

    $pdf->SetFont('Arial', '', 7); //FUENTE

    $pdf->Ln(); // SALTO DE LINEA

    for($puntero = 0 ; $puntero < count($arrayIds) ; $puntero++){

        $conexionResponsiva = new conexion;
        $queryResponsiva = "SELECT p.*,c.nombre  FROM productos p , categoriasproductos c  WHERE c.idcategoriaproducto = p.categoria AND p.idproducto = " . $arrayIds[$puntero];
        $datosResponsiva = $conexionResponsiva->conn->query($queryResponsiva);

        $datosResponsiva = $datosResponsiva->fetch_row();
        $idProducto = $datosResponsiva[0];
        $numParte = $datosResponsiva[1];
        $descripcion = $datosResponsiva[2];
        $categoria = $datosResponsiva[3];
        $maximos = $datosResponsiva[4];
        $minimos = $datosResponsiva[5];
        $existentes = $datosResponsiva[6];
        $comentarios = $datosResponsiva[7];
        $precioXunidad = $datosResponsiva[8];
        $nombre = $datosResponsiva[9];

        $pdf->Cell(30, $ancho, utf8_decode($numParte), "BTLR", 0, "C"); //REGISTRO
        $pdf->Cell(55, $ancho, utf8_decode($nombre), "BTLR", 0, "C"); //REGISTRO
        $pdf->Cell(55, $ancho, utf8_decode($descripcion), "BTLR", 0, "C"); //REGISTRO
        $pdf->Cell(30, $ancho, $precioXunidad, "BTLR", 0, "C"); //REGISTRO
        $pdf->Cell(20, $ancho, $arrayValores[$puntero], "BTLR", 0, "C"); //REGISTRO

        $pdf->Ln(); // SALTO DE LINEA
    }
    
    $pdf->Ln(); // SALTO DE LINEA

    $pdf->Cell(190, $ancho, utf8_decode("Por medio de la presente, hago constar que recibí de la empresa GPS INGENIERIA el producto con las características"), "", 0, "L"); //TEXTO RESPONSIVA

    $pdf->Output();
?>