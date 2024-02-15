<?php
include "../../fGenerales/bd/conexion.php";
include "../../fGenerales/php/funciones.php";

pantallaCarga('on');
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


<body class=" justify-content-center align-items-center" onload="document.getElementById('pantallaCarga').style.display='none'">

    <!-- NAVBAR -->
    <?php pintarNavBar(); ?>

    <div class="contenedorCont">
        <!-- //div principal -->
        <div class="col-12">
        
            <?php pintarEncabezado('Usuarios', '<i class="fa-solid fa-users fa-2xl"></i>', '') ?>

            <div class="row" style="display: flex; justify-content: center; align-items: center; text-align: center;">
                <div class="col-12">
                    <?php
                        foreach ($datos->fetch_all() as $dato) {
                            if ($dato[1] == 1) {
                                echo '<button class="btn-apartado-secciones" onclick="abrirSeccion(1)">
                                        <span class="button_lg">
                                            <span class="button_sl"></span>
                                            <span class="button_text">Catálogo</span>
                                        </span>
                                    </button>';
                            }
                            if ($dato[1] == 2) {
                                echo '<button class="btn-apartado-secciones" onclick="abrirSeccion(2)">
                                        <span class="button_lg">
                                            <span class="button_sl"></span>
                                            <span class="button_text">Registro</span>
                                        </span>
                                    </button>';
                            }
                            if ($dato[1] == 3) {
                                echo '<button class="btn-apartado-secciones" onclick="abrirSeccion(3)">
                                        <span class="button_lg">
                                            <span class="button_sl"></span>
                                            <span class="button_text">Permisos de areas</span>
                                        </span>
                                    </button>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>

        <!-- CATALOGO USUARIOS -->
        <div class="row" id="catalogo" style="display: none;">
            <div class="col-12 text-center">
                <label class="text-subtitle">Catálogo de Usuarios</label>
            </div>
            
            <div class="col-sm-12">
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
        </div>

        <!-- REGISTRO -->
        <div class="row" id="registros" style="display: none;">
            <div class="col-12 text-center">
                <label class="text-subtitle">Registro de Usuarios</label>
            </div>
            
            <div class="col-sm-12">
                <form class="frmRegistroUsuario " id="frmRegistroUsuario">

                    <div class="inputContainer">
                        <input id="nombre" name="nombre" class="inputField" required="" type="text" placeholder="Escriba el nombre">
                        <label class='usernameLabel' for='nombre'>Nombre</label>
                        <i class="userIcon fa-solid fa-text-width"></i>
                    </div>

                    <div class="inputContainer">
                        <input id="login" name="login" class="inputField" required="" type="text" placeholder="Escriba nombre de login">
                        <label class='usernameLabel' for='login'>Login</label>
                        <i class="userIcon fa-solid fa-user"></i>
                    </div>

                    <div class="inputContainer">
                        <input id="correo" name="correo" class="inputField" required="" type="text" placeholder="Escriba el correo">
                        <label class='usernameLabel' for='correo'>Correo</label>
                        <i class="userIcon fa-solid fa-envelope"></i>
                    </div>

                    <div class="inputContainer">
                        <input type="password" id="password" name="password" class="inputField" required="" type="text" placeholder="Escriba la contraseña">
                        <label class='usernameLabel' for='password'>Contraseña</label>
                        <i class="userIcon fa-solid fa-lock"></i>
                    </div>

                    <div class="contenedor-boton-gen">
                        <div class="main_div">
                            <button onclick="crearUsuario()">GUARDAR</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <!-- PERMISOS DE USUARIO -->
        <div class="row d-flex justify-content-center" id="permisos" style="display: none;">

            <div class="col-12 text-center">
                <label class="text-subtitle">Permisos de Usuarios</label>
            </div>

            <div class="col-sm-12 col-md-6">

                <?php
                    $cadenaSelect = '<div class="inputContainer">
                                        <select id="selectUsuarios" name="selectUsuarios" class="inputField" required="" type="text" onchange="cargaPermisos(this.value)" placeholder="Usuario">';

                    $conexionUsuarios = new conexion;
                    $queryUsuarios = "SELECT nombreusuario,nombre,correo,idusuario FROM usuarios WHERE estadoid=1";
                    $resultados = $conexionUsuarios->conn->query($queryUsuarios);
                    $cadenaSelect = $cadenaSelect . "<option value=\"0\">Usuarios...</option>";
                    while ($fila = $resultados->fetch_row()) {

                        $cadenaSelect = $cadenaSelect . "<option value=\"" . $fila[3] . "\">" . $fila[1] . "</option>";
                    }
                    $cadenaSelect = $cadenaSelect . "</select>
                                                <label class='usernameLabel' for='selectUsuarios'>Usuario</label>
                                                <i class='fa-solid fa-user userIcon'></i>
                                            </div>";

                    echo $cadenaSelect;
                ?>
            </div>

            <div class="col-12">
                <div style="margin: 20px;">
                    <div class="col-12 justify-content-center d-flex">

                        <div class="col-6">
                            <div id="divSeccionPermiso" class="seccionAreas"></div>
                        </div>

                        <div class="col-6">
                            <div id="divSeccionTipoPermiso" class="seccionAreas"></div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- MODAL -->
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

    <?php pintarFooter(); ?>

</body>

</html>