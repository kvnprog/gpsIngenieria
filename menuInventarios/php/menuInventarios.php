<?php
    include "../../fGenerales/bd/conexion.php";
    include "../../fGenerales/php/funciones.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php pintarHead('Inventarios') ?>
</head>


<body class=" justify-content-center align-items-center">
    <div class="contenedorCont">
        <!-- //div principal -->
        <div class="col-12">

            <?php pintarEncabezado('',''); ?>
            
            <div class="row">
                <div class="col-1 "></div>
                <div class="col-10  justify-content-center align-items-center ">
                    <div class="row">
                        <!-- CATEGORIA PRODUCTOS -->
                        <div class="col text-center">
                            <div class="btnMenu btn-menu justify-content-center align-items-center" onclick="abrirCategoriaProductos()">
                                <img class="imgConfiguracion" src="../../src/imagenes/category.svg" width="100px">
                                <div class="card-button">Categorias </div>
                            </div>
                            
                        </div>
                        <!-- PRODUCTOS -->
                        <div class="col text-center">
                            <div class="btnMenu btn-menu justify-content-center align-items-center" onclick="abrirProductos()">
                                <img class="imgConfiguracion" src="../../src/imagenes/products.svg" width="100px">
                                <div class="card-button">productos</div>
                            </div>
                        </div>
                        <!-- REPORTES -->
                        <div class="col text-center">
                            <div class="btnMenu btn-menu justify-content-center align-items-center" onclick="abrirReportes()">
                                <img class="imgConfiguracion" src="../../src/imagenes/reports.svg" width="100px">
                                <div class="card-button">Reportes</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- //div de logo y regreso fin -->

        </div>
        <!-- //div principal fin -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
    <?php pintarFooter()?>

</body>

</html>