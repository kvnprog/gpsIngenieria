<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../src/imagenes/logo.png">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet" />
    <link href="../../fGenerales/css/style.css" rel="stylesheet" />
    <script src="../js/funciones.js"></script>
    <script src="../../fGenerales/js/funciones.js"></script>
    <script src="../../fGenerales/js/alerts.js"></script>
    

    <title>gpsingenieria
    </title>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>