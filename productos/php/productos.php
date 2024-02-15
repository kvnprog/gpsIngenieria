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
    // TRAE LOS PRODUCTOS
        $conexionProductos = new conexion;
        $queryProductos = "SELECT p.*,c.nombre  FROM productos p , categoriasproductos c  WHERE c.idcategoriaproducto = p.categoria ";
        $resultados = $conexionProductos->conn->query($queryProductos);

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

                                if($dato[1]==6){                                        
                                    echo '<button class="btn-apartado-secciones" onclick="abrirSeccion(1)">
                                            <span class="button_lg">
                                                <span class="button_sl"></span>
                                                <span class="button_text">Catálogo</span>
                                            </span>
                                        </button>';
                                }
                                if($dato[1]==7){
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

                <div class="row" id="catalogo" style="display: none;">

                    <!-- FILTROS PARA BUSCAR PRODUCTOS -->
                    <div class="row">

                        <div class="col-12">
                            <div class="row">

                                <!-- FILTRO POR NUMERO DE PARTE -->
                                <div class="inputContainer">
                                    <input id="filtroNParte" name="filtroNParte" class="inputField" required="" type="text" placeholder="Escriba el número de parte" onkeyup="filtrarProductos()">
                                    <label class='usernameLabel' for='filtroNParte'>Número de parte</label>
                                    <i class="userIcon fa-solid fa-hashtag"></i>
                                </div>

                                <!-- FILTRO POR DESCRIPCIÓN -->
                                <div class="inputContainer">
                                    <input id="filtroDescripcion" name="filtroDescripcion" class="inputField" required="" type="text" placeholder="Escriba descripción" onkeyup="filtrarProductos()">
                                    <label class='usernameLabel' for='filtroDescripcion'>Descripción</label>
                                    <i class="userIcon fa-solid fa-align-left"></i>
                                </div>


                                <!-- FILTRO POR CATEGORÍA -->
                                <div class="inputContainer">
                                    <select id="filtroCategoria" name="filtroCategoria" class="inputField" required="" type="text" placeholder="Categoría" onchange="filtrarProductos()">
                                        <option value=0 selected>Categorías...</option>
                                        <?php
                                            $conexionCategorias = new conexion;
                                            $queryCategorias = "SELECT*FROM categoriasproductos";
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
                    <div class="col-12 text-center">
                        <label class="text-subtitle">Catálogo de productos</label>
                    </div>

                    <div class="col-sm-12">
                        <!-- TABLA DONDE APARECEN LOS PRODUCTOS -->
                        <div class="table-responsive">
                            <table id="catalogoProductos" class="table table-hover">
                                <!-- TITULOS DE LAS COLUMNAS -->
                                <thead>
                                    <tr class="sticky-top">
                                        <th class="text-center" scope="col">Numero de Parte</th>
                                        <th class="text-center" scope="col">Descripcion</th>
                                        <th class="text-center" scope="col">Categoria</th>
                                        <th class="text-center" scope="col">Maximos</th>
                                        <th class="text-center" scope="col">Minimos</th>
                                        <th class="text-center" scope="col">Existentes</th>
                                        <th class="text-center" scope="col">Agregar</th>
                                        <th class="text-center" scope="col">Comentarios</th>
                                        <th class="text-center" scope="col">Precio Por Unidad</th>
                                        <th class="text-center" scope="col">Foto</th>
                                        <th class="text-center" colspan="2" scope="col"></th>
                                    </tr>
                                </thead>
                                <!-- CONTENIDO DE LA TABLA -->
                                <tbody>
                                    <img class="marcaAguaTabla" src="../../src/imagenes/logo.png">
                                    <?php
                                        foreach ($resultados->fetch_all() as $columna) {
                                            echo " <tr>
                                                        <td class=\"text-center\">" . $columna[1] . "</td>
                                                        <td class=\"text-center\">" . $columna[2] . "</td>
                                                        <td class=\"text-center\">" . $columna[8] . "</td>
                                                        <td class=\"text-center\">" . $columna[4] . "</td>
                                                        <td class=\"text-center\">" . $columna[5] . "</td>
                                                        <td class=\"text-center\">" . $columna[6] . "</td>
                                                        <td class=\"text-center\"><img src=\"../../src/imagenes/agregargps.png\" width=\"30px\" id=\"btnNuevasExitencias-".$columna[0]."\" onclick=\"abrirNuevasExistencias(".$columna[0].")\"><input type=\"number\" id=\"existenciasNuevas-".$columna[0]."\" style=\" display: none;\"  onkeypress=\"mandarExistencias(event,".$columna[0].")\"></td>
                                                        <td class=\"text-center\">" . $columna[7] . "</td>
                                                        <td class=\"text-center\">" . $columna[8] . "</td>";
                                            
                                                        $imagenPath = "/gpsIngenieria/productos/imgsProductos/producto_" . $columna[0] . ".jpg";
                                                        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $imagenPath)) {
                                                            echo "<td class=\"text-center\"><img src=\"$imagenPath\" style=\"width:120px; height:80px;\"/></td>";
                                                        } else {
                                                            echo "<td class=\"text-center\"><img src=\"/gpsIngenieria/productos/imgsProductos/sinImagen.png\" style=\"width:120px; height:80px;\"/></td>";
                                                        }
                                            echo "      <td class=\"text-center\"><img src=\"../../src/imagenes/editargps.png\" width=\"50px\" onclick=\"abrirModal(" . $columna[0] . ",'" . $columna[1] . "','" . $columna[2] . "'," . $columna[3] . ",'" . $columna[8] . "'," . $columna[4] . "," . $columna[5] . "," . $columna[6] . ",'" . $columna[7] . "','" . $columna[8] . "')\"></td>
                                                </tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN DE REGISTRO DE PRODUCTOS -->
            <div class="row" id="registros" style="display: none;">
                <div class="col-12 text-center">
                    <label class="text-subtitle">Registro de productos</label>
                </div>

                <div class="col-sm-12">
                    <!-- FORMULARIO DE REGISTRO DE PRODUCTOS-->
                    <form class="frmRegistroNParte" id="frmRegistroNParte" method="POST" enctype="multipart/form-data">

                        <div class="inputContainer">
                            <input id="nParte" name="nParte" class="inputField" required="" type="text" placeholder="Escriba el número de parte">
                            <label class='usernameLabel' for='nParte'>Número de parte</label>
                            <i class="userIcon fa-solid fa-hashtag"></i>
                        </div>
                        
                        <div class="inputContainer">
                            <textarea type="text" id="descripcion" name="descripcion" class="inputField" required="" placeholder="Escriba descripción"></textarea>
                            <label class='usernameLabel' for='descripcion'>Descripción</label>
                            <i class="userIcon fa-solid fa-align-left"></i>
                        </div>

                        <div class="inputContainer">
                            <select type="text" id="categoría" name="categoria" class="inputField" required="" placeholder="Escriba categoría">
                                <option value=0 selected>Categorías...</option>
                                <?php
                                    $conexionCategorias = new conexion;
                                    $queryCategorias = "SELECT*FROM categoriasproductos";
                                    $categorias = $conexionCategorias->conn->query($queryCategorias);

                                    foreach ($categorias->fetch_all() as $index => $categoria) {
                                        print_r("<option value=\"" . $categoria[0] . "\" >" . $categoria[1] . "</option>");
                                    }
                                ?>
                            </select>
                            <label class='usernameLabel' for='categoria'>Categorías</label>
                            <i class="userIcon fa-solid fa-align-left"></i>
                        </div>

                        <div class="inputContainer">
                            <input type="number" id="maximos" name="maximos" class="inputField" required="" placeholder="Escriba el máximo">
                            <label class='usernameLabel' for='maximos'>Máximo</label>
                            <i class="userIcon fa-solid fa-plus"></i>
                        </div>
  
                        <div class="inputContainer">
                            <input type="number" id="minimos" name="minimos" class="inputField" required="" placeholder="Escriba el mínimo">
                            <label class='usernameLabel' for='minimos'>Mínimos</label>
                            <i class="userIcon fa-solid fa-minus"></i>
                        </div>

                        <div class="inputContainer">
                            <input type="number" id="existentes" name="existentes" class="inputField" required="" placeholder="Escriba los existentes">
                            <label class='usernameLabel' for='existentes'>Existentes</label>
                            <i class="userIcon fa-solid fa-check"></i>
                        </div>

                        <div class="inputContainer">
                            <textarea type="text" id="comentarios" name="comentarios" class="inputField" required="" placeholder="Escriba los comentarios"></textarea>
                            <label class='usernameLabel' for='comentarios'>Comentarios</label>
                            <i class="userIcon fa-regular fa-comments"></i>
                        </div>

                        <div class="inputContainer">
                            <input type="number" id="precio" name="precio" class="inputField" required="" placeholder="Escriba el precio por unidad">
                            <label class='usernameLabel' for='existentes'>Precio por unidad</label>
                            <i class="userIcon fa-solid fa-dollar-sign"></i>
                        </div>

                        <div class="inputContainer">
                            <input type="file" accept="image/*" id="fotoProducto" name="fotoProducto" class="inputField" required="" placeholder="Seleccione la imagen">
                            <label class='usernameLabel' for='existentes'>Imagen de producto</label>
                            <i class="userIcon fa-solid fa-dollar-sign"></i>
                        </div>

                        <div class="contenedor-boton-gen">
                            <div class="main_div">
                                <button onclick="crearProducto()">GUARDAR</button>
                            </div>
                        </div>

                    </form>
                </div>
            
                <div class="col-1"></div>
            </div>

            <!-- MODAL -->
            <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        
                    <!-- TITULO DEL MODAL -->
                        <div class="modal-header">
                            <label class="modal-title text-center" id="exampleModalLabel" style="font-size: 30px;">Modificar Producto</label>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- CONTENIDO DEL MODAL -->
                        <div class="modal-body">
                            <form id="frmModificar" >

                                <input type="text" id="id" name="id" hidden>
                                
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nParte" name="nParte" placeholder="Escriba el Numero de Parte">
                                    <label>Número de Parte</label>
                                </div>
                                
                                <div class="form-floating mb-3">
                                    <textarea type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Escriba una Descripcion"></textarea>
                                    <label>Descripcion</label>
                                </div>
                                
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="categoria" name="categoria" aria-label="Floating label select example">
                                        <option value=0 selected>Categorias....</option>
                                        <?php

                                        $conexionCategorias = new conexion;
                                        $queryCategorias = "SELECT*FROM categoriasproductos";
                                        $categorias = $conexionCategorias->conn->query($queryCategorias);

                                        foreach ($categorias->fetch_all() as $index => $categoria) {

                                            print_r("<option value=\"" . $categoria[0] . "\" >" . $categoria[1] . "</option>");
                                        }

                                        ?>

                                    </select>
                                    <label for="floatingSelect">Categoria</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="maximos" name="maximos" placeholder="Coloque el Maximo">
                                    <label>Maximos</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="minimos" name="minimos" placeholder="Coloque el Minimo">
                                    <label>Minimos</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="existentes" name="existentes" placeholder="Coloque los Existentes" readonly>
                                    <label>Existentes</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <textarea type="text" class="form-control" id="comentarios" name="comentarios" placeholder="Coloque los Comentarios"></textarea>
                                    <label>Comentarios</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="precio" name="precio" placeholder="Coloque los Comentarios">
                                    <label>Precio por Unidad</label>
                                </div>
                            </form>
                        </div>
                        
                        <!-- BOTONES DEL MODAL -->
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