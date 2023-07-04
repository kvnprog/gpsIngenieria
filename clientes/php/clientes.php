<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../src/imagenes/logo.png">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet" />
    <script src="../js/funciones.js"></script>
    <script src="../../fGenerales/js/funciones.js"></script>
    <script src="../../fGenerales/js/alerts.js"></script>
    <script src="../../fGenerales/js/jquery.js"></script>


    <title>gpsingenieria
    </title>
</head>

<!-- //BUSCANDO Usuarios -->

<?php

include "../../fGenerales/bd/conexion.php";

$conexionClientes = new conexion;
$queryClientes = "SELECT * FROM clientes ";
$resultados = $conexionClientes->conn->query($queryClientes);

//var_dump($resultados);

?>


<body class=" justify-content-center align-items-center">

    <!-- //div principal -->
    <div class="col-12">

        <!-- //div de logo y regreso -->
        <div class="row">
            <div class="col-3 justify-content-center align-items-center" onclick="regreso()">
                <img class="imgregreso" src="../../src/imagenes/atras.png" />
            </div>
            <div class="col-6  text-center  txtTitulo">
                <span><i class="aTitulo">Clientes</i><img class="imgIconoUsuarios" src="../../src/imagenes/usuarios.png" width="50px"></span>
            </div>
            <div class="col-3 divLogo justify-content-center align-items-center">
                <img class="imgLogo" src="../../src/imagenes/logo.png" />
            </div>

        </div>
        <!-- //div de logo y regreso fin -->

        <!-- //botones del menu de usuarios -->
        <div class="row">

            <div class="col-1"></div>
            <div class="col-10">
                <div class="btn-group " style="width:100%" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary btnUsuarios" onclick="abrirSeccion(1)">Catalogo</button>
                    <button type="button" class="btn btn-secondary btnUsuarios" onclick="abrirSeccion(2)">Registro</button>
                    
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









    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>