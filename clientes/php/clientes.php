<?php 
    include "../../fGenerales/bd/conexion.php";
    include "../../fGenerales/php/funciones.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        pintarHead('Clientes');
    ?>
</head>

<!-- //BUSCANDO Usuarios -->

<?php


$conexionClientes = new conexion;
$queryClientes = "SELECT * FROM clientes ";
$resultados = $conexionClientes->conn->query($queryClientes);

session_name('gpsingenieria');
session_start();

$datos = checarPermisosSeccion($_SESSION['usuarioid']);

?>


<body class=" justify-content-center align-items-center">

    <div class="contenedorCont">
   
        <!-- //div principal -->
        <div class="col-12">

            <?php pintarEncabezado('Clientes','usuarios.png'); ?>

            <!-- //botones del menu de usuarios -->
            <div class="row">

                <div class="col-1"></div>
                <div class="col-10">
                    <div class="btn-group " style="width:100%" role="group" aria-label="Basic example">


                    <?php 
                    
                    foreach($datos->fetch_all() as $dato){

                            if($dato[1]==10){
                            echo "<button type=\"button\" class=\"btn btn-secondary btnUsuarios\" onclick=\"abrirSeccion(1)\">Catalogo</button>";
                            }
                            if($dato[1]==11){
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
                    <h3>Catalogo de Usuarios</h3>
                </div>
                <div class="col-1"></div>
                <!-- Empiezo de tabla -->
                <div class="col-10">
                    <div class="table-responsive">
                        <table id="catalogoClientes" class="table table-hover">
                            <thead>
                                <tr>

                                    <th class="text-center" scope="col">Nombre</th>
                                    <th class="text-center" scope="col">Domicilio</th>
                                    <th class="text-center" scope="col">Estado</th>
                                    <th class="text-center" scope="col">Codigo Postal</th>
                                    <th class="text-center" scope="col">Contacto</th>
                                    <th class="text-center" scope="col">Rfc</th>
                                    <th class="text-center" scope="col">Email</th>
                                    <th class="text-center" colspan="2" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <img class="marcaAguaTabla" src="../../src/imagenes/logo.png">
                                <!--LLENADO LOS DATOS DE LAS TABLAS   -->
                                <?php

                                foreach ($resultados->fetch_all() as $columna) {


                                    echo " <tr>
                                        <td class=\"text-center\">" . $columna[1] . " " .$columna[2]."</td>
                                        <td class=\"text-center\">" . $columna[3] . "</td>
                                        <td class=\"text-center\">" . $columna[4] . "</td>
                                        <td class=\"text-center\">" . $columna[5] . "</td>
                                        <td class=\"text-center\">" . $columna[6] . "</td>
                                        <td class=\"text-center\">" . $columna[7] . "</td>
                                        <td class=\"text-center\">" . $columna[8] . "</td>
                                        <td class=\"text-center\"><img src=\"../../src/imagenes/editargps.png\" width=\"50px\" onclick=\"abrirModal(" . $columna[0] . ",'" . $columna[1] . "','" . $columna[2] . "','" . $columna[3] . "','" . $columna[4] . "','" . $columna[5] . "','" . $columna[6] . "','" . $columna[7] . "','" . $columna[8] . "')\"></td>
                                        
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
                <h3>Registro de Usuarios</h3>
            </div>
            <div class="col-1"></div>
            <div class="col-10">
                <form class="frmRegistroCliente " id="frmRegistroCliente">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Escriba sus Nombres">
                        <label>Nombres</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Escriba sus Apellidos">
                        <label>Apellidos</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="Escriba su  Domicilio">
                        <label>Domicilio</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="estado" name="estado" placeholder="Escriba su Estado">
                        <label>Estado</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" placeholder="Escriba su Codigo Postal">
                        <label>Codigo Postal</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="contacto" name="contacto" placeholder="Escriba su Codigo Postal">
                        <label>Contacto</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="rfc" name="rfc" placeholder="Escriba su RFC">
                        <label>RFC</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="mail" class="form-control" id="email" name="email" placeholder="Escriba su Email">
                        <label>Email</label>
                    </div>




                    <br>
                    <button type="button" class="btn btn-success" onclick="crearCliente()">Guardar</button>
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
                        <label class="modal-title text-center" id="exampleModalLabel" style="font-size: 30px;">Modificar Usuario</label>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frmModificar">
                            <input type="text" id="id" name="id" hidden>
                            <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Escriba sus Nombres">
                        <label>Nombres</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Escriba sus Apellidos">
                        <label>Apellidos</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="Escriba su  Domicilio">
                        <label>Domicilio</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="estado" name="estado" placeholder="Escriba su Estado">
                        <label>Estado</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" placeholder="Escriba su Codigo Postal">
                        <label>Codigo Postal</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="contacto" name="contacto" placeholder="Escriba su Codigo Postal">
                        <label>Contacto</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="rfc" name="rfc" placeholder="Escriba su RFC">
                        <label>RFC</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="mail" class="form-control" id="email" name="email" placeholder="Escriba su Email">
                        <label>Email</label>
                    </div>


                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="modificarCliente()">Guardar</button>
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