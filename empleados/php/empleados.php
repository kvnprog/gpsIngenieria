<?php
    include "../../fGenerales/bd/conexion.php";
    include "../../fGenerales/php/funciones.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php pintarHead('Empleados') ?>
</head>

<!-- CONSULTA PARA TRAER LOS EMPLEADOS -->
<?php
    $conexionEmpleados = new conexion;
    $queryEmpleados = "SELECT idEmpleado,nombre,apellidos,correo,telefono,puesto FROM empleados WHERE status=1";
    $resultados = $conexionEmpleados->conn->query($queryEmpleados);

    // CHECA LOS PERMISOS DEL USUARIO PARA ESTAS SECCIONES

    session_name('gpsingenieria');
    session_start();

    $datos = checarPermisosSeccion($_SESSION['usuarioid']);
?>

<body class=" justify-content-center align-items-center">
    <section>
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

            <!-- TABLA DONDE SE VEN LOS EMPLEADOS -->
            <div class="row" id="catalogo" style="display: none;">
                
                <div class="col-12 text-center">
                    <h3>Catalogo de Empleados</h3>
                </div>
                <div class="col-1"></div>
                <div class="col-10">
                    <div class="table-responsive">
                        <table id="catalogoEmpleados" class="table table-hover">
                            <!-- ENCABEZADO DE LA TABLA EMPLEADOS-->
                            <thead>
                                <tr class="sticky-top">
                                    <th class="text-center" scope="col">Nombre</th>
                                    <th class="text-center" scope="col">Correo</th>
                                    <th class="text-center" scope="col">Telefono celular</th>
                                    <th class="text-center" scope="col">Puesto</th>
                                    <th class="text-center" colspan='2' scope="col">Acción</th>
                                </tr>
                            </thead>
                            <!-- CONTENIDO DE LA TABLA EMPLEADOS -->
                            <tbody>
                                <?php
                                    foreach ($resultados->fetch_all() as $columna) {
                                        echo " <tr>
                                            <td class=\"text-center\">" . $columna[1] . " " . $columna[2] . "</td>
                                            <td class=\"text-center\">" . $columna[3] . "</td>
                                            <td class=\"text-center\">" . $columna[4] . "</td>
                                            <td class=\"text-center\">" . $columna[5] . "</td>
                                            <td class=\"text-center\"><img src=\"../../src/imagenes/editargps.png\" width=\"50px\" onclick=\"abrirModal(" . $columna[0] . ",'" . $columna[1] . "','" . $columna[2] . "','" . $columna[3] . "','" . $columna[4] . "','" . $columna[5] . "')\"></td>
                                            <td class=\"text-center\"><img src=\"../../src/imagenes/eliminargps.png\" width=\"40px\" onclick=\"eliminarUsuario(" . $columna[0] . ")\"></td>
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
    </section>

    <section>
        <!-- FORMULARIO PARA REGISTRAR EMPLEADO -->
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
    </section>

    <section>
        <!-- MODAL PARA EDITAR LOS EMPLEADOS -->
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