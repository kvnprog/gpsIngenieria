<?php
    include "../../fGenerales/bd/conexion.php";
    include "../../fGenerales/php/funciones.php";
    
    pantallaCarga('on');
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <?php pintarHead('Productos') ?>
    </head>

    <?php
    // CHECA LOS PERMISOS DEL USUARIO
        session_name('gpsingenieria');
        session_start();
        $datos = checarPermisosSeccion($_SESSION['usuarioid']);
    ?>

    <body class="justify-content-center align-items-center" onload="document.getElementById('pantallaCarga').style.display='none'">
        
        <!-- NAVBAR -->
        <?php pintarNavBar(); ?>

        <div class="contenedorCont">

            <div class="col-12">

                <?php pintarEncabezado('Productos','<i class="fa-solid fa-boxes-stacked fa-2xl"></i>','')?>

                <div class="row" style="display: flex; justify-content: center; align-items: center; text-align: center;">

                    <div class="col-12">
                        <?php 
                            foreach($datos->fetch_all() as $dato){

                                if($dato[1]==7){                                        
                                    echo '<button class="btn-apartado-secciones" onclick="abrirSeccion(1)">
                                            <span class="button_lg">
                                                <span class="button_sl"></span>
                                                <span class="button_text">Catálogo productos</span>
                                            </span>
                                        </button>';
                                }
                                if($dato[1]==8){
                                    echo '<button class="btn-apartado-secciones" onclick="abrirSeccion(2)">
                                            <span class="button_lg">
                                                <span class="button_sl"></span>
                                                <span class="button_text">Registrar productos</span>
                                            </span>
                                        </button>';
                                }
                                if($dato[1]==10){
                                    echo '<button class="btn-apartado-secciones" onclick="abrirSeccion(3)">
                                            <span class="button_lg">
                                                <span class="button_sl"></span>
                                                <span class="button_text">Catálogo entradas</span>
                                            </span>
                                        </button>';
                                }

                                
                            }
                            echo '<button class="btn-apartado-secciones" onclick="abrirSeccion(4)">
                            <span class="button_lg">
                                <span class="button_sl"></span>
                                <span class="button_text">Subida Masiva Productos</span>
                            </span>
                           </button>';
                        ?>
                    </div>
                </div>

                <div class="row" id="catalogo" style="display: none;">

                    <div class="card_content">

                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <!-- FILTRO POR NUMERO DE PARTE -->
                                <div class="inputContainer">
                                    <input id="filtroNParte" name="filtroNParte" class="inputField" required="" type="text" placeholder="Escriba el número de parte" onkeyup="filtrarProductos()">
                                    <label class='usernameLabel' for='filtroNParte'>Número de parte</label>
                                    <i class="userIcon fa-solid fa-hashtag"></i>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4">
                                <!-- FILTRO POR DESCRIPCIÓN -->
                                <div class="inputContainer">
                                    <input id="filtroDescripcion" name="filtroDescripcion" class="inputField" required="" type="text" placeholder="Escriba descripción" onkeyup="filtrarProductos()">
                                    <label class='usernameLabel' for='filtroDescripcion'>Descripción</label>
                                    <i class="userIcon fa-solid fa-align-left"></i>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4">
                                <!-- FILTRO POR CATEGORÍA -->
                                <div class="inputContainer">
                                    <select id="filtroCategoria" name="filtroCategoria" class="inputField" required="" type="text" placeholder="Categoría" onchange="filtrarProductos()">
                                        <option value=0 selected>Categorías...</option>
                                        <?php
                                            $conexionCategorias = new conexion;
                                            $queryCategorias = "SELECT * FROM categoria";
                                            $categorias = $conexionCategorias->conn->query($queryCategorias);

                                            foreach ($categorias->fetch_all() as $index => $categoria) {

                                                print_r("<option value=\"" . $categoria[0] . "\" >" . $categoria[1] . "</option>");
                                            }
                                        ?>
                                    </select>
                                    <label class='usernameLabel' for='filtroCategoria'>Categorías</label>
                                    <i class="userIcon fa-regular fa-object-ungroup"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TITULO DEL CONTENIDO -->
                    <div class="card_content">
                        <div class="row">
                            <div class="col-12 text-center">
                                <label class="text-subtitle">Catálogo de productos</label>
                            </div>

                            <div class="col-sm-12">
                                <!-- TABLA DONDE APARECEN LOS PRODUCTOS -->
                                <div class="table-responsive">
                                    <table id="tablaCatalogoProductos" class="table table-hover"></table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12">
                <!-- FORMULARIO DE REGISTRO DE PRODUCTOS-->
                <form class="justify-content-center" id="frmRegistroProductos" method="POST" enctype="multipart/form-data" style="display: none;">
                    
                    <div class="card_content">
                        <div class="row">
                            <div class="col-12 text-center">
                                <label class="text-subtitle">Registro de productos</label>
                            </div>

                            <div class="col-sm-12 col-md-4">
                                <div class="inputContainer">
                                    <input id="nParte" name="nParte" class="inputField" required="" type="text" placeholder="Escriba el número de parte">
                                    <label class='usernameLabel' for='nParte'>Número de parte</label>
                                    <i class="userIcon fa-solid fa-hashtag"></i>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-8">
                                <div class="inputContainer">
                                    <textarea type="text" id="descripcion" name="descripcion" class="inputField" required="" placeholder="Escriba descripción"></textarea>
                                    <label class='usernameLabel' for='descripcion'>Descripción</label>
                                    <i class="userIcon fa-solid fa-align-left"></i>
                                </div>
                            </div>
                
                            <div class="col-sm-12 col-md-3">
                                <div class="inputContainer">
                                    <input type="number" id="precioPublico" name="precioPublico" class="inputField" required="" placeholder="Escriba el precio por unidad">
                                    <label class='usernameLabel' for='precioPublico'>Precio con IVA público</label>
                                    <i class="userIcon fa-solid fa-dollar-sign"></i>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-3">
                                <div class="inputContainer">
                                    <input type="number" id="precioVenta" name="precioVenta" class="inputField" required="" placeholder="Escriba el precio por unidad">
                                    <label class='usernameLabel' for='precioVenta'>Precio venta</label>
                                    <i class="userIcon fa-solid fa-dollar-sign"></i>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-3">
                                <div class="inputContainer">
                                    <select type="text" id="categoria" name="categoria" class="inputField" required="" placeholder="Escriba categoría">
                                        <option value=0 selected>...</option>
                                        <?php
                                            $conexionCategorias = new conexion;
                                            $queryCategorias = "SELECT * FROM categoria";
                                            $categorias = $conexionCategorias->conn->query($queryCategorias);

                                            foreach ($categorias->fetch_all() as $index => $categoria) {
                                                print_r("<option value=\"" . $categoria[0] . "\" >" . $categoria[1] . "</option>");
                                            }
                                        ?>
                                    </select>
                                    <label class='usernameLabel' for='categoria'>Categoría</label>
                                    <i class="userIcon fa-solid fa-align-left"></i>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-3">
                                <div class="inputContainer">
                                    <select type="text" id="subcategoria" name="subcategoria" class="inputField" required="" placeholder="Escriba categoría">
                                        <option value=0 selected>...</option>
                                        <?php
                                            $conexionCategorias = new conexion;
                                            $queryCategorias = "SELECT * FROM subcategoria";
                                            $categorias = $conexionCategorias->conn->query($queryCategorias);

                                            foreach ($categorias->fetch_all() as $index => $categoria) {
                                                print_r("<option value=\"" . $categoria[0] . "\" >" . $categoria[1] . "</option>");
                                            }
                                        ?>
                                    </select>
                                    <label class='usernameLabel' for='subcategoria'>Subcategoría</label>
                                    <i class="userIcon fa-solid fa-align-left"></i>
                                </div>
                            </div>

                            <div class="contenedor-boton-gen">
                                <div class="main_div">
                                    <a onclick="crearProducto()">GUARDAR</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row" id="catalogoEntradas" style="display: none;">
                <div class="card_content">

                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <!-- FILTRO POR NUMERO DE PARTE -->
                            <div class="inputContainer">
                                <input id="filtroNParte" name="filtroNParte" class="inputField" required="" type="text" placeholder="Escriba el número de parte" onkeyup="filtrarProductos()">
                                <label class='usernameLabel' for='filtroNParte'>Número de parte</label>
                                <i class="userIcon fa-solid fa-hashtag"></i>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <!-- FILTRO POR DESCRIPCIÓN -->
                            <div class="inputContainer">
                                <input id="filtroDescripcion" name="filtroDescripcion" class="inputField" required="" type="text" placeholder="Escriba descripción" onkeyup="filtrarProductos()">
                                <label class='usernameLabel' for='filtroDescripcion'>Descripción</label>
                                <i class="userIcon fa-solid fa-align-left"></i>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <!-- FILTRO POR CATEGORÍA -->
                            <div class="inputContainer">
                                <select id="filtroCategoria" name="filtroCategoria" class="inputField" required="" type="text" placeholder="Categoría" onchange="filtrarProductos()">
                                    <option value=0 selected>Categorías...</option>
                                    <?php
                                        $conexionCategorias = new conexion;
                                        $queryCategorias = "SELECT * FROM categoria";
                                        $categorias = $conexionCategorias->conn->query($queryCategorias);

                                        foreach ($categorias->fetch_all() as $index => $categoria) {

                                            print_r("<option value=\"" . $categoria[0] . "\" >" . $categoria[1] . "</option>");
                                        }
                                    ?>
                                </select>
                                <label class='usernameLabel' for='filtroCategoria'>Categorías</label>
                                <i class="userIcon fa-regular fa-object-ungroup"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TITULO DEL CONTENIDO -->
                <div class="card_content">
                    <div class="row">
                        <div class="col-12 text-center">
                            <label class="text-subtitle">Catálogo de entradas</label>
                        </div>

                        <div class="col-sm-12">
                            <!-- TABLA DONDE APARECEN LOS PRODUCTOS -->
                            <div class="table-responsive">
                                <table id="tablaCatalogoProductos" class="table table-hover"></table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <?php include "subidaMasiva.php"?>

            <!-- MODAL MODIFICAR -->
            <div class="modal fade" id="miModalEditarProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            
                            <!-- TITULO DEL MODAL -->
                            <div class="col-12 text-center">
                                <label class="text-subtitle">Modificar producto</label>
                            </div>

                            <form id="frmModificarProducto" class="row justify-content-center">
                                <input type="text" id="id" name="id" hidden>
                                
                                <div class="col-sm-12">
                                    <div class="inputContainer">
                                        <input id="nParte" name="nParte" class="inputField" required="" type="text" placeholder="Escriba el número de parte">
                                        <label class='usernameLabel' for='nParte'>Número de parte</label>
                                        <i class="fa-solid fa-hashtag userIcon"></i>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="inputContainer">
                                        <textarea id="descripcion" name="descripcion" class="inputField" required="" type="text" placeholder="Escriba la descripción"></textarea>
                                        <label class='usernameLabel' for='descripcion'>Descripción</label>
                                        <i class="fa-solid fa-align-left userIcon"></i>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="inputContainer">
                                        <input id="precioPublico" name="precioPublico" class="inputField" required="" type="number" placeholder="Escriba el precio publico">
                                        <label class='usernameLabel' for='precioPublico'>Precio publico</label>
                                        <i class="fa-solid fa-dollar-sign userIcon"></i>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="inputContainer">
                                        <input id="precioVenta" name="precioVenta" class="inputField" required="" type="number" placeholder="Escriba el precio venta">
                                        <label class='usernameLabel' for='precioVenta'>Precio venta</label>
                                        <i class="fa-solid fa-dollar-sign userIcon"></i>
                                    </div>
                                </div>

                                <div class="contenedor-boton-gen">
                                    <div class="main_div">
                                        <a onclick="modificarProducto()">GUARDAR</a>
                                    </div>
                                </div>
                             
                            </form>
                        </div>
                    
                    </div>
                </div>
            </div>

             <!-- MODAL AGREGAR ENTRADA-->
             <div class="modal fade" id="modalAgregarProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            
                            <!-- TITULO DEL MODAL -->
                            <div class="col-12 text-center">
                                <label class="text-subtitle">Registrar entradas</label>
                            </div>

                            <form id="frmRegistrarEntrada" class="row justify-content-center">
                                <input type="text" id="id" name="id" hidden>
                                
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table id="tablaEntadas" class="table table-hover"></table>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="inputContainer">
                                        <input id="numSerie" name="numSerie" class="inputField" required="" type="text" placeholder="Escriba el número de serie">
                                        <label class='usernameLabel' for='numSerie'> Número de serie</label>
                                        <i class="fa-solid fa-barcode userIcon"></i>
                                    </div>
                                </div>

                                <div class="contenedor-boton-gen">
                                    <div class="main_div">
                                        <a onclick="insertarEntradaProd()">GUARDAR</a>
                                    </div>
                                </div>
                            
                            </form>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

        <?php pintarFooter()?>
        
    </body>
</html>