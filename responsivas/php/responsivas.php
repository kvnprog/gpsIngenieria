<?php
    include "../../fGenerales/bd/conexion.php";
    include "../../fGenerales/php/funciones.php";

    pantallaCarga('on');
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

    <body class=" justify-content-center align-items-center" onload="document.getElementById('pantallaCarga').style.display='none'">
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
                                        <th class="text-center" scope="col">Existentes</th>
                                        <th class="text-center" scope="col">Precio Por Unidad</th>
                                        <th class="text-center" scope="col">Foto</th>
                                        <th class="text-center" colspan="2" scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <!-- CONTENIDO DE LA TABLA -->
                                <tbody>
                                    <img class="marcaAguaTabla" src="../../src/imagenes/logo.png">
                                    <?php
                                        foreach ($resultados->fetch_all() as $columna) {
                                            echo " <tr>
                                                        <td class=\"text-center\">" . $columna[1] . "</td>
                                                        <td class=\"text-center\">" . $columna[6] . "</td>
                                                        <td class=\"text-center\">" . $columna[8] . "</td>";
                                            
                                                        $imagenPath = "/gpsIngenieria/productos/imgsProductos/producto_" . $columna[0] . ".jpg";
                                                        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $imagenPath)) {
                                                            echo "<td class=\"text-center\"><img src=\"$imagenPath\" style=\"width:120px; height:80px;\"/></td>";
                                                        } else {
                                                            echo "<td class=\"text-center\"><img src=\"/gpsIngenieria/productos/imgsProductos/sinImagen.png\" style=\"width:120px; height:80px;\"/></td>";
                                                        }
                                            
                                            echo "      <td class=\"text-center\"><img src=\"../../src/imagenes/pdf.png\" width=\"50px\" onclick=\"modalResponsiva('".$columna[0]."','".$columna[1]."','".$columna[2]."','".$columna[3]."','".$columna[4]."','".$columna[5]."','".$columna[6]."','".$columna[7]."','".$columna[8]."','".$columna[9]."')\" title=\"Generar responsiva\"></td>
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

        <!-- Modal -->
        <div class="modal fade" id="modalResponsiva" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <label class="modal-title text-center" id="exampleModalLabel" style="font-size: 30px;">Datos de responsiva</label>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frmModalResponsiva">
                            <input type="text" id="idProductoHid" style="display: none">
                            <input type="text" id="existenciasHid" style="display: none">
                            <label for="cantidadProd">Cantidad producto:</label><input class="form-control" type="number" min="1" id="cantidadProd" name="cantidadProd">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="generarResponsiva()">Generar responsiva</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

        <?php pintarFooter()?>

    </body>
</html>