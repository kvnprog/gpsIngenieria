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
    <script src="../js/funciones.js"></script>
    <script src="../../fGenerales/js/funciones.js"></script>
    <script src="../../fGenerales/js/alerts.js"></script>
    <script src="../../fGenerales/js/jquery.js"></script>


    <title>gpsingenieria
    </title>
</head>

<!-- //BUSCANDO Ordenes de Trabajo -->

<?php

include "formularios.php";
// echo "https://localhost/gpsingenieria/src/imagenes/logo.png";

include "../../fGenerales/bd/conexion.php";
include "../../fGenerales/php/funciones.php";

$conexionOrdenes = new conexion;
$queryOrdenes = "SELECT ot.numfolio,u.nombre ,c.nombre as nombrecliente , c.apellidos  ,ot.totalpago,ot.fecha,ot.ordenid,ot.saldopendiente,ot.factura  
FROM ordentrabajo ot,usuarios u,clientes c 
WHERE ot.idusuario = u.idusuario AND ot.idcliente = c.idcliente";
$resultados = $conexionOrdenes->conn->query($queryOrdenes);


session_name('gpsingenieria');
session_start();

$datos = checarPermisosSeccion($_SESSION['usuarioid']);

//var_dump($resultados);

?>


<body class=" justify-content-center align-items-center">

    <!-- //div principal -->
    <div class="col-12">

        <!-- //div de logo y regreso -->
        <div class="row">
            <div class="col-3 justify-content-center align-items-center" >
                <img class="imgregreso" src="../../src/imagenes/atras.png" onclick="regreso()" />
            </div>
            <div class="col-6  text-center  txtTitulo">
                <span><i class="aTitulo">Ordenes de Trabajo</i><img class="imgIconoUsuarios" src="../../src/imagenes/productosiconogps.png" width="50px"></span>
            </div>
            <div class="col-3 divLogo justify-content-center align-items-center">
                <img class="imgLogo" src="../../src/imagenes/logo.png" />
            </div>

        </div>
        <!-- //div de logo y regreso fin -->

        <!-- //botones del menu de usuarios -->
        <div class="row">

            <div class="col-1"></div>
            <div class="col-10">
                <div class="btn-group " style="width:100%" role="group" aria-label="Basic example">
                    <?php

                    foreach ($datos->fetch_all() as $dato) {

                        if ($dato[1] == 14) {
                            echo "<button type=\"button\" class=\"btn btn-secondary btnUsuarios\" onclick=\"abrirSeccion(1)\">Catalogo</button>";
                        }
                    }


                    ?>


                </div>
            </div>
            <div class="col-1"></div>

        </div>

        <!-- //botones del menu de usuarios fin-->

        <!-- Tabla de datos Usuarios -->
        <div class="row" id="catalogo" style="display: none;">

            <!-- FILTROS -->
            <div class="row text-center">

                <div class="col-1"></div>
                <!-- Empiezo de filtros -->
                <div class="col-10">

                    <div class="row">

                        <div class="form-floating col-2 ">
                            <input type="text" class="form-control" id="filtroNFolio" name="filtroNFolio" placeholder="Escriba el Numero de Parte" onkeyup="filtrarOrdenes()">
                            <label>N.Folio</label>
                        </div>

                        <div class="form-floating col-2 ">
                            <input type="text" class="form-control" id="filtroTrabajador" name="filtroTrabajador" placeholder="Escriba el Numero de Parte" onkeyup="filtrarOrdenes()">
                            <label>Trabajador</label>
                        </div>

                        <div class="form-floating col-2 ">
                            <input type="text" class="form-control" id="filtroCliente" name="filtroCliente" placeholder="Escriba el Numero de Parte" onkeyup="filtrarOrdenes()">
                            <label>Cliente</label>
                        </div>

                        <div class="form-floating col-3 ">
                            <input type="date" class="form-control" id="filtroFechaI" name="filtroFechaI" placeholder="Escriba el Numero de Parte" onchange="filtrarOrdenes()">
                            <label>Fecha Inicial</label>
                        </div>

                        <div class="form-floating col-3 ">
                            <input type="date" class="form-control" id="filtroFechaF" name="filtroFechaF" placeholder="Escriba el Numero de Parte" onchange="filtrarOrdenes()">
                            <label>Fecha Final</label>
                        </div>


                    </div>
                </div>
                <div class="col-1"></div>
            </div>

            <div class="col-12 text-center">
                <h3>Catalogo de Productos</h3>
            </div>
            <div class="col-1"></div>
            <!-- Empiezo de tabla -->
            <div class="col-10">
                <table id="catalogoProductos" class="table table-hover">
                    <thead>
                        <tr>

                            <th class="text-center" scope="col">N.Folio</th>
                            <th class="text-center" scope="col">Trabajador</th>
                            <th class="text-center" scope="col">Cliente</th>
                            <th class="text-center" scope="col">Factura</th>
                            <th class="text-center" scope="col">Pago Total</th>
                            <th class="text-center" scope="col">Deuda</th>
                            <th class="text-center" scope="col">Pagos</th>
                            <th class="text-center" scope="col">Fecha</th>
                            <th class="text-center" scope="col">Orden de Trabajo</th>

                        </tr>


                        <th class="text-center" colspan="6" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--LLENADO LOS DATOS DE LAS TABLAS   -->
                        <?php

                        foreach ($resultados->fetch_all() as $columna) {


                            echo " <tr>
                                   <td class=\"text-center\">" . $columna[0] . "</td>
                                   <td class=\"text-center\">" . $columna[1] . "</td>
                                   <td class=\"text-center\">" . $columna[2] . " " . $columna[3] . "</td>";


                            if ($columna[8] != "") {
                                echo   "<td class=\"text-center\"><div style=\"margin-right: 10px;\">" . $columna[8] . "</div><img src=\"../../src/imagenes/evidenciagps.png\" width=\"30px\" onclick=\"abrirEvidenciaFactura(".$columna[6].")\"></td>";
                            } else {
                                echo   "<td class=\"text-center\"><img src=\"../../src/imagenes/agregargps.png\" onclick=\"abrirModalFacturaAgregar(" . $columna[6] . ")\" width=\"30px\"></td>";
                            }

                            echo  "<td class=\"text-center\">" . $columna[4] . "</td>
                                   <td class=\"text-center\">$columna[7]</td>
                                   <td class=\"text-center\"><img src=\"../../src/imagenes/pagos.png\"   width=\"40px\" onclick=\"abrirPagos(" . $columna[6] . ")\"></td>
                                   <td class=\"text-center\">" . $columna[5] . "</td>
                                   <td class=\"text-center\"><img src=\"../../src/imagenes/pdf.png\" width=\"50\"  onclick=\"checarOrden(" . $columna[6] . ")\"></td>
                                  </tr>";
                        }

                        ?>

                    </tbody>
                </table>
            </div>
            <!-- Empiezo tabla final -->
            <div class="col-1"></div>
        </div>

        <!-- Tabla de datos Usuarios final-->
    </div>
    <!-- //div principal fin -->





    <!-- Modal -->
    <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-center" id="exampleModalLabel" style="font-size: 30px;">Pagos</label>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <?php frmpagos() ?>
                    <?php frmFacturas() ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnNuevoPago" onclick="nuevoPago()">Nuevo pago</button>
                    <button type="button" class="btn btn-secondary" onclick="cerrarPago()">Close</button>
                </div>
            </div>
        </div>
    </div>









    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>