<?php
    include "../../fGenerales/bd/conexion.php";
    include "../../fGenerales/php/funciones.php";

    pantallaCarga('on');
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


<body class="justify-content-center align-items-center" onload="document.getElementById('pantallaCarga').style.display='none'">

    <!-- NAVBAR -->
    <?php pintarNavBar(); ?>

    <div class="contenedorCont">

        <div class="col-12">

            <?php pintarEncabezado('Categorias Productos','<i class="fa-regular fa-object-ungroup fa-2xl"></i>', ''); ?>

            <div class="row" style="display: flex; justify-content: center; align-items: center; text-align: center;">

                <div class="col-12">
                    <?php     
                        foreach($datos->fetch_all() as $dato){
                            if($dato[1]==4){
                                echo '<button class="btn-apartado-secciones" onclick="abrirSeccion(1)">
                                        <span class="button_lg">
                                            <span class="button_sl"></span>
                                            <span class="button_text">Catálogo</span>
                                        </span>
                                    </button>';
                            }
                            if($dato[1]==5){
                                echo '<button class="btn-apartado-secciones" onclick="abrirSeccion(2)">
                                        <span class="button_lg">
                                            <span class="button_sl"></span>
                                            <span class="button_text">Registro</span>
                                        </span>
                                    </button>';
                            }
                        }
                    ?>
                </div>

            </div>

            <!-- CATALOGO PRODUCTOS -->
            <div class="row" id="catalogo" style="display: none;">
                <div class="col-12 text-center">
                    <label class="text-subtitle">Catálogo de categorías productos</label>
                </div>

                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table id="catalogoCategorias" class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">Nombre</th>
                                    <th class="text-center" colspan="1" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <img class="marcaAguaTabla" src="../../src/imagenes/logo.png">
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
                </div>
            </div>
        </div>


        <!-- REGISTRO -->
        <div class="row" id="registros" style="display: none;">
            <div class="col-12 text-center">
                <label class="text-subtitle">Registro de categoría de productos</label>
            </div>

            <div class="col-sm-12">
                <form class="frmRegistroCategoria" id="frmRegistroCategoria">

                    <div class="inputContainer">
                        <input id="nombre" name="nombre" class="inputField" required="" type="text" placeholder="Escriba el nombre">
                        <label class='usernameLabel' for='nombre'>Nombre</label>
                        <i class="userIcon fa-solid fa-text-width"></i>
                    </div>
                    
                    <div class="contenedor-boton-gen">
                        <div class="main_div">
                            <button onclick="crearCategoria()">GUARDAR</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <!-- MODAL -->
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