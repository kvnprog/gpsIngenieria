<?php
    include "../../fGenerales/bd/conexion.php";
    include "../../fGenerales/php/funciones.php";

    pantallaCarga('on');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php pintarHead('Servicios') ?>
</head>

<!-- //BUSCANDO Productos -->

<?php

$conexionServicios = new conexion;
$queryServicios = "SELECT * FROM servicios";
$resultados = $conexionServicios->conn->query($queryServicios);

session_name('gpsingenieria');
session_start();

$datos = checarPermisosSeccion($_SESSION['usuarioid']);

?>


<body class=" justify-content-center align-items-center" onload="document.getElementById('pantallaCarga').style.display='none'">
    <div class="contenedorCont">
        <!-- //div principal -->
        <div class="col-12">

            <!-- //div de logo y regreso -->
            <?php pintarEncabezado('Servicios','productosiconogps.png')?>
            
            <div class="row">

                <div class="col-1"></div>
                <div class="col-10">
                    <div class="btn-group " style="width:100%" role="group" aria-label="Basic example">

                    <?php 
                    
                    foreach($datos->fetch_all() as $dato){

                            if($dato[1]==12){
                            echo "<button type=\"button\" class=\"btn btn-secondary btnUsuarios\" onclick=\"abrirSeccion(1)\">Catalogo</button>";
                            }
                            if($dato[1]==13){
                                echo "<button type=\"button\" class=\"btn btn-secondary btnUsuarios\" onclick=\"abrirSeccion(2)\">Registro</button>";
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

            
                <div class="col-12 text-center">
                    <h3>Catalogo de Servicios</h3>
                </div>
                <div class="col-1"></div>
                <!-- Empiezo de tabla -->
                <div class="col-10">
                    <div class="table-responsive">
                        <table id="catalogoServicios" class="table table-hover">
                            <thead>
                                <tr>

                                    <th class="text-center" scope="col">Nombre</th>
                                    <th class="text-center" scope="col">Descripcion</th>
                                    <th class="text-center" scope="col">Precio</th>
                                    <th class="text-center" colspan="2" scope="col"></th>
                                </tr>


                                <th class="text-center" colspan="6" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <img class="marcaAguaTabla" src="../../src/imagenes/logo.png">
                                <!--LLENADO LOS DATOS DE LAS TABLAS   -->
                                <?php

                                foreach ($resultados->fetch_all() as $columna) {


                                    echo " <tr>
                                        <td class=\"text-center\">" . $columna[1] . "</td>
                                        <td class=\"text-center\">" . $columna[2] . "</td>
                                        <td class=\"text-center\">" . $columna[3] . "</td>
                                        <td class=\"text-center\"><img src=\"../../src/imagenes/editargps.png\" width=\"50px\" onclick=\"abrirModal(" . $columna[0] . ",'" . $columna[1] . "','" . $columna[2] . "','" . $columna[3] . "')\"></td>
                                        
                                        </tr>";
                                }

                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Empiezo tabla final -->
                <div class="col-1"></div>
            </div>

            <!-- Tabla de datos Usuarios final-->
        </div>
        <!-- //div principal fin -->


        <!-- div de registros -->
        <div class="row" id="registros" style="display: none;">
            <div class="col-12 text-center">
                <h3>Registro de Productos</h3>
            </div>
            <div class="col-1"></div>
            <div class="col-10">
                <form class="frmRegistroServicio" id="frmRegistroServicio">


        
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escriba el Numero de Parte" >
                        <label>Nombre</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Escriba el Numero de Parte" ></textarea>
                        <label>Descripcion</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="precio" name="precio" placeholder="Escriba el Numero de Parte">
                        <label>precio</label>
                    </div>


                    <button type="button" class="btn btn-success" onclick="crearNuevoElemento()">Guardar</button>
                </form>
            </div>
            <div class="col-1"></div>
        </div>
        <!-- div de registros -->







        <!-- Modal -->
        <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <label class="modal-title text-center" id="exampleModalLabel" style="font-size: 30px;">Modificar Servicio</label>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frmModificar">
                            <input type="text" id="id" name="id" hidden>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escriba el Numero de Parte">
                                <label>Nombre</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Escriba una Descripcion"></textarea>
                                <label>Descripcion</label>
                            </div>
                        

                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="precio" name="precio" placeholder="Coloque el Maximo">
                                <label>Precio</label>
                            </div>

                
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="modificarUsuario()">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <?php pintarFooter()?>
    
</body>

</html>