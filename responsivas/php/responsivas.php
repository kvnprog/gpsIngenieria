<?php
    include "../../fGenerales/bd/conexion.php";
    include "../../fGenerales/php/funciones.php";
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <?php pintarHead('Responsivas') ?>
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
                
                <?php pintarEncabezado('Responsivas','responsivas.png'); ?>

                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <div class="btn-group " style="width:100%" role="group" aria-label="Basic example">
                        
                        <!-- MUESTRA LOS BOTONES A LOS QUE EL USUARIO TIENE PERMISO -->
                            <?php 
                                foreach($datos->fetch_all() as $dato){

                                    if($dato[1]==17){
                                        echo "<button type=\"button\" class=\"btn btn-secondary btnUsuarios\" onclick=\"abrirSeccion(1)\">Catalogo</button>";
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
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

        <?php pintarFooter()?>

    </body>
</html>