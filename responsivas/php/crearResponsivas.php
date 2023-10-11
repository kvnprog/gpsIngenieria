<?php
    // TRAE LOS PRODUCTOS
    $conexionProductos = new conexion;
    $queryProductos = "SELECT p.*,c.nombre  FROM productos p , categoriasproductos c  WHERE c.idcategoriaproducto = p.categoria ";
    $resultados = $conexionProductos->conn->query($queryProductos);
?>

<div class="row" id="crearResponsivas" style="display: none;">

    <!-- TITULO DEL CONTENIDO -->
    <div class="col-12 text-center">
        <h3>Productos</h3>
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
                                    echo "<td class=\"text-center\">
                                            <label class=\"containerCheck\">
                                                <input type=\"checkbox\" value=\"".$columna[0]."\">
                                                <div class=\"checkmark\"></div>
                                            </label>
                                        </td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-success" onclick="modalResponsiva()">Generar responsiva</button>
    </div>

    <div class="col-1"></div>

</div>