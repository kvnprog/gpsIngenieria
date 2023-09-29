<?php
    include "../../fGenerales/bd/conexion.php";
    include "../../fGenerales/php/funciones.php";
?>

<!DOCTYPE html>
<?php //pantallaCarga()?>
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

    <body class=" justify-content-center align-items-center">
        <div class="contenedorCont">
            <div class="col-12">

                <?php pintarEncabezado('Productos','productosiconogps.png')?>

                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <div class="btn-group " style="width:100%" role="group" aria-label="Basic example">
                        
                        <!-- MUESTRA LOS BOTONES A LOS QUE EL USUARIO TIENE PERMISO -->
                            <?php 
                                foreach($datos->fetch_all() as $dato){

                                    if($dato[1]==6){
                                    echo "<button type=\"button\" class=\"btn btn-secondary btnUsuarios\" onclick=\"abrirSeccion(1)\">Catalogo</button>";
                                    }
                                    if($dato[1]==7){
                                        echo "<button type=\"button\" class=\"btn btn-secondary btnUsuarios\" onclick=\"abrirSeccion(2)\">Registro</button>";
                                    }
                                }
                            ?>

                        </div>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row" id="catalogo" style="display: none;">

                    <!-- FILTROS PARA BUSCAR PRODUCTOS -->
                    <div class="row text-center">

                        <div class="col-1"></div>

                        <div class="col-10">
                            <div class="row">

                                <!-- FILTRO POR NUMERO DE PARTE -->
                                <div class="form-floating col-4 ">
                                    <input type="text" class="form-control" id="filtroNParte" name="filtroNParte" placeholder="Escriba el Numero de Parte" onkeyup="filtrarProductos()">
                                    <label>Numero de Parte</label>
                                </div>

                                <!-- FILTRO POR DESCRIPCIÓN -->
                                <div class="form-floating col-4 ">
                                    <input type="text" class="form-control" id="filtroDescripcion" name="filtroDescripcion" placeholder="Escriba el Numero de Parte" onkeyup="filtrarProductos()">
                                    <label>Descripcion</label>
                                </div>

                                <!-- FILTRO POR CATEGORÍA -->
                                <div class="form-floating mb-3 col-4">
                                    <select class="form-select" id="filtroCategoria" name="filtroCategoria" aria-label="Floating label select example" onchange="filtrarProductos()">
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
                            </div>
                        </div>

                        <div class="col-1"></div>
                    
                    </div>

                    <!-- TITULO DEL CONTENIDO -->
                    <div class="col-12 text-center">
                        <h3>Catalogo de Productos</h3>
                    </div>

                    <div class="col-1"></div>
                    
                    <div class="col-10">
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

                    <div class="col-1"></div>

                </div>
            </div>

            <!-- SECCIÓN DE REGISTRO DE PRODUCTOS -->
            <div class="row" id="registros" style="display: none;">

            <!-- TITULO DEL CONTENIDO -->
                <div class="col-12 text-center">
                    <h3>Registro de Productos</h3>
                </div>

                <div class="col-1"></div>
                
                <div class="col-10">
                    <!-- FORMULARIO DE REGISTRO DE PRODUCTOS-->
                    <form class="frmRegistroNParte" id="frmRegistroNParte" method="POST" enctype="multipart/form-data">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nParte" name="nParte" placeholder="Escriba el Numero de Parte">
                            <label>Numero de Parte</label>
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
                            <input type="number" class="form-control" id="existentes" name="existentes" placeholder="Coloque los Existentes">
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

                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" style="line-height: 3.5; padding-top: 0;" accept="image/*" id="fotoProducto" name="fotoProducto" placeholder="Coloque la foto">
                        </div>

                        <button type="button" class="btn btn-success" onclick="crearProducto()">Guardar</button>
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