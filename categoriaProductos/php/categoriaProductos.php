<?php
    include "../../fGenerales/bd/conexion.php";
    include "../../fGenerales/php/funciones.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        pintarHead('Cat. Productos');
    ?>
</head>

<!-- //BUSCANDO Usuarios -->

<?php

$conexionCategorias = new conexion;
$queryCategorias = "SELECT * FROM categoriasproductos ";
$resultados = $conexionCategorias->conn->query($queryCategorias);


//checando permisos del usuario en la seccion

session_name('gpsingenieria');
session_start();

$datos = checarPermisosSeccion($_SESSION['usuarioid']);

//var_dump($resultados);

?>


<body class=" justify-content-center align-items-center">

    <div class="contenedorCont">

        <!-- //div principal -->
        <div class="col-12">

            <?php pintarEncabezado('Categorias Productos','productosiconogps.png'); ?>

            <!-- //botones del menu de usuarios -->
            <div class="row">

                <div class="col-1"></div>
                <div class="col-10">
                    <div class="btn-group " style="width:100%" role="group" aria-label="Basic example">

                    <?php 
                    
                    foreach($datos->fetch_all() as $dato){


                    

                            if($dato[1]==4){
                            echo "<button type=\"button\" class=\"btn btn-secondary btnUsuarios\" onclick=\"abrirSeccion(1)\">Catalogo</button>";
                            }
                            if($dato[1]==5){
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
                    <h3>Catalogo de Categoria Productos</h3>
                </div>
                <div class="col-1"></div>
                <!-- Empiezo de tabla -->
                <div class="col-10">
                    <table id="catalogoCategorias" class="table table-hover">
                        <thead>
                            <tr>

                                <th class="text-center" scope="col">Nombre</th>

                                <th class="text-center" colspan="1" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--LLENADO LOS DATOS DE LAS TABLAS   -->
                            <?php

                            foreach ($resultados->fetch_all() as $columna) {


                                echo " <tr>
                                    <td class=\"text-center\">" . $columna[1] . "</td>
                                    
                                    <td class=\"text-center\"><img src=\"../../src/imagenes/editargps.png\" width=\"50px\" onclick=\"abrirModal(" . $columna[0] . ",'" . $columna[1] . "')\"></td>
                                    
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


        <!-- div de registros -->
        <div class="row" id="registros" style="display: none;">
            <div class="col-12 text-center">
                <h3>Registro de Categoria de Producto</h3>
            </div>
            <div class="col-1"></div>
            <div class="col-10">
                <form class="frmRegistroCategoria" id="frmRegistroCategoria">
                    <div class="form-floating ">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escriba su Nombre">
                        <label>Nombre</label>
                    </div>
                    
                    <br>
                    <button type="button" class="btn btn-success" onclick="crearCategoria()">Guardar</button>
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
                        <label class="modal-title text-center" id="exampleModalLabel" style="font-size: 30px;">Modificar Categoria</label>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frmModificar">
                            <input type="text" id="id" name="id" hidden>
                            <label for="nombre">Nombre :</label><input class="form-control" type="text" id="nombre" name="nombre">

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="modificarCategoria()">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <?php pintarFooter();?>
</body>

</html>