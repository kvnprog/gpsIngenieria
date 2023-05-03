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

$conexionUsuarios = new conexion;
$queryUsuarios = "SELECT nombreusuario,nombre,correo,idusuario FROM usuarios WHERE estadoid=1";
$resultados = $conexionUsuarios->conn->query($queryUsuarios);

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
                <span><i class="aTitulo">Usuarios</i><img class="imgIconoUsuarios" src="../../src/imagenes/usuarios.png" width="50px"></span>
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
                    <button type="button" class="btn btn-secondary btnUsuarios" onclick="abrirSeccion(3)">Permisos de Areas</button>
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
                <table id="catalogoUsuarios" class="table table-hover">
                    <thead>
                        <tr>

                            <th class="text-center" scope="col">Nombre</th>
                            <th class="text-center" scope="col">Login</th>
                            <th class="text-center" scope="col">Correo</th>
                            <th class="text-center" colspan="2" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--LLENADO LOS DATOS DE LAS TABLAS   -->
                        <?php

                        foreach ($resultados->fetch_all() as $columna) {


                            echo " <tr>
                                   <td class=\"text-center\">" . $columna[1] . "</td>
                                   <td class=\"text-center\">" . $columna[0] . "</td>
                                   <td class=\"text-center\">" . $columna[2] . "</td>
                                   <td class=\"text-center\"><img src=\"../../src/imagenes/editargps.png\" width=\"50px\" onclick=\"abrirModal(" . $columna[3] . ",'" . $columna[1] . "','" . $columna[0] . "','" . $columna[2] . "')\"></td>
                                   <td class=\"text-center\"><img src=\"../../src/imagenes/eliminargps.png\" width=\"40px\" onclick=\"eliminarUsuario(" . $columna[3] . ")\"></td>
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
            <form class="frmRegistroUsuario" id="frmRegistroUsuario">
                <label for="nombre">Nombre :</label><input class="form-control" id="nombre" name="nombre" type="text">
                <label for="login">Login :</label><input class="form-control" id="login" name="login" type="text">
                <label for="correo">Correo :</label><input class="form-control" id="correo" name="correo" type="text">
                <label for="password">Contraseña :</label><input class="form-control" id="password" name="password" type="password">
                <br>
                <button type="button" class="btn btn-success" onclick="crearUsuario()">Guardar</button>
            </form>
        </div>
        <div class="col-1"></div>
    </div>
    <!-- div de registros -->

    <!-- div de permisos -->
    <div class="row" id="permisos" style="display: none;">
        <div class="col-12 text-center">
            <h3>Permisos de Usuarios</h3>
        </div>

        <div class="col-1"></div>
        <div class="col-10">
            <?php
            $cadenaSelect = "<select class=\"form-select \" name=\"selectUsuarios\" id=\"selectUsuarios\" onchange=\"cargaPermisos(this.value)\">";


            $conexionUsuarios = new conexion;
            $queryUsuarios = "SELECT nombreusuario,nombre,correo,idusuario FROM usuarios WHERE estadoid=1";
            $resultados = $conexionUsuarios->conn->query($queryUsuarios);

            while ($fila = $resultados->fetch_row()) {

                $cadenaSelect = $cadenaSelect . "<option value=\"" . $fila[3] . "\">" . $fila[1] . "</option>";
            }
            $cadenaSelect = $cadenaSelect . "</select>";

            echo $cadenaSelect;
            ?>
        </div>


        <div class="col-1"></div>


        <div class="col-1"></div>
        <div class="col-10">
            <div style="margin: 20px;" id="divPermisos">
            <!-- <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                Toggle width collapse
            </button>
            <ul class="list-group collapse collapse-vertical" id="collapseWidthExample">
            <li class="list-group-item">An item</li>
            <li class="list-group-item">A second item</li>
            <li class="list-group-item">A third item</li>
            <li class="list-group-item">A fourth item</li>
            <li class="list-group-item">And a fifth one</li>
            </ul>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample1" aria-expanded="false" aria-controls="collapseWidthExample1">
                Toggle width collapse
            </button>
            <ul class="list-group collapse collapse-vertical" id="collapseWidthExample1">
            <li class="list-group-item">An algo</li>
            <li class="list-group-item">A second item</li>
            <li class="list-group-item">A third item</li>
            <li class="list-group-item">A fourth item</li>
            <li class="list-group-item">And a fifth one</li>
        </ul> -->
        </div>
        </div>
        <div class="col-1"></div>




        <!-- <p>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                Toggle width collapse
            </button>
        </p>
       

        

      


    </div>
    <!-- div de permisos -->






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
                            <label for="nombre">Nombre :</label><input class="form-control" type="text" id="nombre" name="nombre">
                            <label for="login">Login :</label><input class="form-control" type="text" id="login" name="login">
                            <label for="correo">Correo :</label><input class="form-control" type="text" id="correo" name="correo">
                            <label for="password">Contraseña :</label> <input class="form-control" type="password" id="password" name="password">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="modificarUsuario()">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>









        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>