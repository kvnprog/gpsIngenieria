<?php
    include "../../fGenerales/bd/conexion.php";
    include "../../fGenerales/php/funciones.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php pintarHead('RH') ?>
</head>

<body class=" justify-content-center align-items-center">

    <!-- //div principal -->
    <div class="col-12">
        <!-- //div de logo y regreso -->
        <div class="row">
            <div class="col-3 justify-content-center align-items-center">
                <img class="imgregreso" src="../../src/imagenes/atras.png" onclick="regreso()"/>
            </div>
            <div class="col-6 divLogo justify-content-center align-items-center ">
                <img class="imgLogo" src="../../src/imagenes/logo.png" />
            </div>
            <div class="col-3" ></div>

        </div>
        <!-- //div de logo y regreso fin -->

        <!-- //div de logo y regreso -->
        <div class="row">
            <div class="justify-content-center align-items-center ">
                <div class="row">
                    <div class="col text-center">
                        <div class="btnMenu btn-menu justify-content-center align-items-center" onclick="abrirEmpleados()">
                                <img class="imgConfiguracion" src="../../src/imagenes/empleados.svg" width="110px">
                                <div class="card-button">Empleados</div>
                        </div> 
                    </div>                    
                </div>
            </div>

        </div>
        <!-- //div de logo y regreso fin -->

    </div>
    <!-- //div principal fin -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>