<?php
    include "../../fGenerales/bd/conexion.php";
    include "../../fGenerales/php/funciones.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php pintarHead('Reportes') ?>
</head>

<!-- //BUSCANDO Productos -->

<?php

$conexionProductos = new conexion;
$queryProductos = "SELECT p.*,c.nombre  FROM productos p , categoriasproductos c  WHERE c.idcategoriaproducto = p.categoria ";
$resultados = $conexionProductos->conn->query($queryProductos);

//checando permisos del usuario en la seccion

session_name('gpsingenieria');
session_start();

$datos = checarPermisosSeccion($_SESSION['usuarioid']);
?>


<body class=" justify-content-center align-items-center">

    <!-- //div principal -->
    <div class="col-12">

        <!-- //div de logo y regreso -->
        <div class="row">
            <div class="col-3 justify-content-center align-items-center">
                <img class="imgregreso" src="../../src/imagenes/atras.png" onclick="regreso()"/>
            </div>
            <div class="col-6  text-center  txtTitulo">
                <span><i class="aTitulo">Reportes</i><img class="imgIconoUsuarios" src="../../src/imagenes/productosiconogps.png" width="50px"></span>
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
                   
                          echo "<button type=\"button\" class=\"btn btn-success btnReporteES\" onclick=\"abrirSeccion(1)\">Reporte ES</button>";
 
                   ?>
                    
                    

                </div>
            </div>
            <div class="col-1"></div>

        </div>

        <!-- //botones del menu de usuarios fin-->

        <!-- Tabla de datos Usuarios -->
        <div class="row" id="reporteES" style="display: none;">

            <!-- FILTROS -->
            <div class="row text-center">

                <div class="col-1"></div>
                <!-- Empiezo de filtros -->
                <div class="col-10">

                    <div class="row">

                    <div class="form-floating mb-3 col-2">
                            <select class="form-select" id="filtroTipo" name="filtroTipo" aria-label="Floating label select example" ">
                               
                                <?php

                                    print_r("<option value=0 >TIPO..</option>");
                                    print_r("<option value=1 >Ventas..</option>");
                                    print_r("<option value=2 >Ordenes..</option>");
                                    print_r("<option value=3 >Otros..</option>");
                                
                                ?>

                            </select>
                            <label for="floatingSelect">Categoria</label>
                        </div>

                        <div class="form-floating mb-3 col-2">
                            <select class="form-select" id="filtroMovimiento" name="filtroMovimiento" aria-label="Floating label select example" onchange="filtrarProductos()">
                               
                                <?php

                                    print_r("<option value=0 >Movimiento...</option>");
                                    print_r("<option value=1 >Entrada</option>");
                                    print_r("<option value=2 >Salida</option>");
                                
                                ?>

                            </select>
                            <label for="floatingSelect">Movimiento</label>
                        </div>

                        <div class="form-floating col-2 ">
                            <input type="text" class="form-control" id="filtroProducto" name="filtroProducto" placeholder="Escriba el Numero de Parte" onkeyup="filtrarProductos()">
                            <label>Producto</label>
                        </div>

                        <div class="form-floating col-2 ">
                            <input type="date" class="form-control" id="filtroFechaInicial" name="filtroFechaInicial" placeholder="Escriba el Numero de Parte" onkeyup="filtrarProductos()">
                            <label>Fecha Inicial</label>
                        </div>

                        <div class="form-floating col-2 ">
                            <input type="date" class="form-control" id="filtroFechaFinal" name="filtroFechaFinal" placeholder="Escriba el Numero de Parte" onkeyup="filtrarProductos()">
                            <label>Fecha Final</label>
                        </div>

                        <div class="form-floating col-2 ">
                        <button type="button" class="btn btn-success btnReporteES" onclick="buscarES()">Buscar</button>
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
                            <th class="text-center" scope="col">N.parte</th>
                            <th class="text-center" scope="col">Descripcion</th>
                            <th class="text-center" scope="col">Tipo</th>
                            <th class="text-center" scope="col">Cantidad</th>   
                            <th class="text-center" scope="col">Fecha</th>
                            <th class="text-center" scope="col">Hora</th>     
                        </tr>
                    </thead>
                    <tbody>
                        <!--LLENADO LOS DATOS DE LAS TABLAS   -->
                    </tbody>
                </table>
            </div>
            <!-- Empiezo tabla final -->
            <div class="col-1"></div>
        </div>

        <!-- Tabla de datos Usuarios final-->
    </div>
    <!-- //div principal fin -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>