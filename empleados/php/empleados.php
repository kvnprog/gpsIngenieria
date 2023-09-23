<?php
    include "../../fGenerales/bd/conexion.php";
    include "../../fGenerales/php/funciones.php";
?>

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

<!-- //BUSCANDO Empleados -->

<?php
    $conexionEmpleados = new conexion;
    $queryEmpleados = "SELECT nombreusuario,nombre,correo,idusuario FROM usuarios WHERE estadoid=1";
    $resultados = $conexionEmpleados->conn->query($queryEmpleados);

    // checando permisos del usuario en la seccion

    session_name('gpsingenieria');
    session_start();

    $datos = checarPermisosSeccion($_SESSION['usuarioid']);
?>

<body class=" justify-content-center align-items-center">

    <div class="col-12">
        <div class="row">
            <div class="col-3 justify-content-center align-items-center">
                <img class="imgregreso" src="../../src/imagenes/atras.png" onclick="regreso()"/>
            </div>
            <div class="col-6  text-center  txtTitulo">
                <span><i class="aTitulo">Empleados</i><img class="imgIconoUsuarios" src="../../src/imagenes/usuarios.png" width="50px"></span>
            </div>
            <div class="col-3 divLogo justify-content-center align-items-center">
                <img class="imgLogo" src="../../src/imagenes/logo.png" />
            </div>
        </div>

        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="btn-group " style="width:100%" role="group" aria-label="Basic example">
                   <?php 
                        foreach($datos->fetch_all() as $dato){
                            if($dato[1]==15){
                                echo "<button type=\"button\" class=\"btn btn-secondary btnUsuarios\" onclick=\"abrirSeccion(1)\">Catalogo</button>";
                            }
                            if($dato[1]==16){
                                echo "<button type=\"button\" class=\"btn btn-secondary btnUsuarios\" onclick=\"abrirSeccion(2)\">Registro</button>";
                            }                              
                        }                                      
                   ?>                    
                </div>
            </div>
            <div class="col-1"></div>
        </div>

        <!-- //botones del menu de Empleados fin-->

        <!-- Tabla de datos Empleados -->
        <div class="row" id="catalogo" style="display: none;">
            <div class="col-12 text-center">
                <h3>Catalogo de Empleados</h3>
            </div>
            <div class="col-1"></div>
            <!-- Empiezo de tabla -->
            <div class="col-10">
                <table id="catalogoEmpleados" class="table table-hover">
                    <thead>
                        <tr>

                            <th class="text-center" scope="col">Nombre</th>
                            <th class="text-center" scope="col">Apellidos</th>
                            <th class="text-center" scope="col">Correo</th>
                            <th class="text-center" scope="col">Telefono celular</th>
                            <th class="text-center" scope="col">Puesto</th>
                            <th class="text-center" colspan="2" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--LLENADO LOS DATOS DE LAS TABLAS   -->
                        <?php
                        //     foreach ($resultados->fetch_all() as $columna) {
                        //         echo " <tr>
                        //             <td class=\"text-center\">" . $columna[1] . "</td>
                        //             <td class=\"text-center\">" . $columna[0] . "</td>
                        //             <td class=\"text-center\">" . $columna[2] . "</td>
                        //             <td class=\"text-center\"><img src=\"../../src/imagenes/editargps.png\" width=\"50px\" onclick=\"abrirModal(" . $columna[3] . ",'" . $columna[1] . "','" . $columna[0] . "','" . $columna[2] . "')\"></td>
                        //             <td class=\"text-center\"><img src=\"../../src/imagenes/eliminargps.png\" width=\"40px\" onclick=\"eliminarUsuario(" . $columna[3] . ")\"></td>
                        //             </tr>";
                        //     }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Empiezo tabla final -->
            <div class="col-1"></div>
        </div>

        <!-- Tabla de datos Empleados final-->
    </div>
    <!-- //div principal fin -->

    <!-- div de registros Empleados-->
    <div class="row" id="registros" style="display: none;">
        <div class="col-12 text-center">
            <h3>Registro de Empleados</h3>
        </div>
        <div class="col-1"></div>
        <div class="col-10">
            <form class="frmRegistroEmpleados" id="frmRegistroEmpleados">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escriba el Nombre">
                    <label>Nombre</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Escriba los Apellidos">
                    <label>Apellidos</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="correo" name="correo" placeholder="Escriba el correo">
                    <label>Correo</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="TelefonoCelular" name="TelefonoCelular" placeholder="Escriba el Telefono celular">
                    <label>Telefono celular</label>
                </div>
                
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="puesto" name="puesto" placeholder="Escriba el Puesto">
                    <label>Puesto</label>
                </div>
                <br>
                <button type="button" class="btn btn-success" onclick="crearEmpleado()">Guardar</button>
            </form>
        </div>
        <div class="col-1"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-center" id="exampleModalLabel" style="font-size: 30px;">Modificar Empleado</label>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frmModificar">
                        <input type="text" id="id" name="id" hidden>
                        <label for="nombre">Nombre :</label><input class="form-control" type="text" id="nombre" name="nombre">
                        <label for="apellidos">Apellidos :</label><input class="form-control" type="text" id="apellidos" name="apellidos">
                        <label for="correo">Correo :</label><input class="form-control" type="text" id="correo" name="correo">
                        <label for="telefonoCelular">Telefono Celular :</label> <input class="form-control" type="text" id="telefonoCelular" name="telefonoCelular">
                        <label for="puesto">Puesto :</label> <input class="form-control" type="text" id="puesto" name="puesto">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="modificarEmpleado()">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>