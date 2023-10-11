<?php
    include "../../fGenerales/bd/conexion.php";
    include "../../fGenerales/php/funciones.php";

    pantallaCarga('on');
?>

<!DOCTYPE html>

<html lang="en">

    <head>
        <?php pintarHead('Responsivas') ?>
    </head>

    <body class=" justify-content-center align-items-center" onload="document.getElementById('pantallaCarga').style.display='none'">

        <div class="contenedorCont">
            <div class="col-12">

                <!-- PINTA ENCABEZADO -->
                <?php pintarEncabezado('Responsivas', 'responsivas.png'); ?>
                
                <!-- PINTA LOS BOTONES DE LAS SECCIONES -->
                <?php include_once './botonesSecciones.php' ?>
                
                <!-- PINTA EL CATALOGO -->
                <?php include_once './crearResponsivas.php'?>

                <!-- PINTA EL CATALOGO -->
                <?php include_once './catalogoResponsivas.php'?>

                <!-- MODAL -->
                <?php include_once './modales.php'?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        
        <?php pintarFooter() ?>

    </body>

</html>