<?php
    include "../../fGenerales/bd/conexion.php";
    include "../../fGenerales/php/funciones.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php pintarHead('Usuarios') ?>
</head>

<!-- //BUSCANDO Usuarios -->

<?php

$conexionUsuarios = new conexion;
$queryUsuarios = "SELECT nombreusuario,nombre,correo,idusuario FROM usuarios WHERE estadoid=1";
$resultados = $conexionUsuarios->conn->query($queryUsuarios);

//checando permisos del usuario en la seccion

session_name('gpsingenieria');
session_start();

$datos = checarPermisosSeccion($_SESSION['usuarioid']);
?>


<body class=" justify-content-center align-items-center">
    <div class="contenedorCont">
        <!-- //div principal -->
        <div class="col-12">
            
            <?php pintarEncabezado('Usuarios','usuarios.png')?>
            
            <div class="row">

                <div class="col-1"></div>
                <div class="col-10">
                    <div class="btn-group " style="width:100%" role="group" aria-label="Basic example">

                    <?php 
                    
                    foreach($datos->fetch_all() as $dato){
                        

                    

                            if($dato[1]==1){
                            echo "<button type=\"button\" class=\"btn btn-secondary btnUsuarios\" onclick=\"abrirSeccion(1)\">Catalogo</button>";
                            }
                            if($dato[1]==2){
                                echo "<button type=\"button\" class=\"btn btn-secondary btnUsuarios\" onclick=\"abrirSeccion(2)\">Registro</button>";
                            }
                            if($dato[1]==3){
                                echo "<button type=\"button\" class=\"btn btn-secondary btnUsuarios\" onclick=\"abrirSeccion(3)\">Permisos de Areas</button>";
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
                                <img class="marcaAguaTabla" src="../../src/imagenes/logo.png">
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
                <form class="frmRegistroUsuario " id="frmRegistroUsuario">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escriba su Nombre">
                        <label>Nombre</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="login" name="login" placeholder="Escriba su Nombre de login">
                        <label>Login</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="correo" name="correo" placeholder="Escriba su  correo">
                        <label>Correo</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Escriba su Contraseña">
                        <label>Contraseña</label>
                    </div>




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
                $cadenaSelect = $cadenaSelect . "<option value=\"0\">Usuarios...</option>";
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

                </div>
            </div>
            <div class="col-1"></div>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>    

    <?php pintarFooter();?>

</body>

</html>