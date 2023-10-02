<?php
    include "../../fGenerales/bd/conexion.php";
    include "../../fGenerales/php/funciones.php";

    pantallaCarga('on');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php pintarHead('Ventas') ?>
</head>

<body class=" justify-content-center align-items-center" onload="document.getElementById('pantallaCarga').style.display='none'">
    <div class="contenedorCont">
        <!-- //div principal -->
        <div class="col-12">

            <?php pintarEncabezado('',''); ?>
            
            <div class="row">
                <div class="col-1 "></div>
                <div class="col-10  justify-content-center align-items-center ">
                    <div class="row">
                        <div class="col text-center ">
                            <div class="btnMenu btn-menu justify-content-center align-items-center" onclick="abrirClientes()">
                                <img class="imgConfiguracion" src="../../src/imagenes/clients.svg" width="100px">
                                <div class="card-button">Clientes</div>
                            </div>
                            
                        </div>
                        <div class="col text-center">
                        <div class=" btnMenu btn-menu justify-content-center align-items-center" onclick="abrirServicios()">
                                <img class="imgConfiguracion" src="../../src/imagenes/services.svg" width="100px">
                                <div class="card-button">Servicios</div>
                            </div>
                        </div>
                        <div class="col text-center">
                        <div class=" btnMenu btn-menu justify-content-center align-items-center" onclick="abrirVentas()">
                                <img class="imgConfiguracion" src="../../src/imagenes/sales2.svg" width="100px">
                                <div class="card-button">Ventas</div>
                            </div>
                        </div>
                        <div class="col text-center">
                        <div class=" btnMenu btn-menu justify-content-center align-items-center" onclick="abrirOT()" >
                                <img class="imgConfiguracion" src="../../src/imagenes/workorders.svg" width="100px">
                                <div class="card-button">Ordenes de Trabajo</div>
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