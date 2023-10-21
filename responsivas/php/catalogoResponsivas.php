<?php
    // TRAE LOS PRODUCTOS
    $conObtenerResponsivas = new conexion;
    $queryObtenerResponsivas = "SELECT r.idresponsiva, u.nombreusuario, r.fechacreacion, r.banderafirmado, r.estadoid
    FROM responsivas r, usuarios u WHERE u.idusuario = r.usuarioid";
    $resultados = $conObtenerResponsivas->conn->query($queryObtenerResponsivas);
?>

<div class="row" id="catalogoResponsivas" style="display: none;">

    <!-- TITULO DEL CONTENIDO -->
    <div class="col-12 text-center">
        <h3>Catalogo de responsivas</h3>
    </div>

    <div class="col-1"></div>

    <div class="col-10">
        <!-- TABLA DONDE APARECEN LAS RESPONSIVAS -->
        <div class="table-responsive">
            <table id="catalogoProductos" class="table table-hover">
                <!-- TITULOS DE LAS COLUMNAS -->
                <thead>
                    <tr class="sticky-top">
                        <th class="text-center" scope="col">Usuario creador</th>
                        <th class="text-center" scope="col">Fecha de creacion</th>
                        <th class="text-center" scope="col">Firmado</th>
                    </tr>
                </thead>
                <!-- CONTENIDO DE LA TABLA -->
                <tbody>
                    <img class="marcaAguaTabla" src="../../src/imagenes/logo.png">
                    <?php
                        foreach ($resultados->fetch_all() as $responsiva) {
                            echo "  <tr>
                                        <td class=\"text-center\">" . $responsiva[1] . "</td>
                                        <td class=\"text-center\">" . $responsiva[2] . "</td>";
                                        
                                        if($responsiva[3] == 0){
                                            $firmado = 'No';
                                        } else {
                                            $firmado = 'Si';
                                        }

                            echo "      <td class=\"text-center\">" . $firmado . "</td>";
                            echo "  </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-1"></div>

</div>