<?php
    include "../../fGenerales/bd/conexion.php";
    include "../../fGenerales/php/funciones.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php pintarHead('Login');
    ?>
</head>

<body class="m-0 vh-100 row justify-content-center align-items-center">





    <div class="divLogo justify-content-center align-items-center ">
        <img class="imgLogo" src="../../src/imagenes/logo.png" />
    </div>

    <div class="container  row justify-content-center align-items-center ">

        <form id="frmLogin">

            <div class="row ">

                <div class="col-lg-2  text-center" style="color:white">Usuario</div>
                <div class="col-lg-1"></div>


                <div class="col-lg-9 form-group has-feedback">
                    <div class="input-group mb-3">

                        <div class="form-floating ">
                            <input type="text" class="form-control" name="usuario" placeholder="Escriba su Usuario">
                            <label>Escriba su Usuario</label>
                        </div>
                        <div class="input-group-text" style="background-color: #198754;border-color: #198754;">

                        <svg style="width: 20px;fill: #FFFFFF;" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>

                        </div>
                    </div>


                </div>
            </div>
            <div class="row ">
                <div class="col-lg-2  text-center  " style="color:white">Password</div>
                <div class="col-lg-1"></div>
                <div class="col-lg-9 ">
                    <div class="input-group mb-3">
                        <div class="form-floating ">
                            <input type="password" class="form-control" name="password" placeholder="Escriba su Password">
                            <label>Escriba su Contraseña</label>
                        </div>
                        <div class="input-group-text" style="background-color: #198754;border-color: #198754;">

                        <svg   style="width: 20px;fill: #FFFFFF;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M336 352c97.2 0 176-78.8 176-176S433.2 0 336 0S160 78.8 160 176c0 18.7 2.9 36.8 8.3 53.7L7 391c-4.5 4.5-7 10.6-7 17v80c0 13.3 10.7 24 24 24h80c13.3 0 24-10.7 24-24V448h40c13.3 0 24-10.7 24-24V384h40c6.4 0 12.5-2.5 17-7l33.3-33.3c16.9 5.4 35 8.3 53.7 8.3zM376 96a40 40 0 1 1 0 80 40 40 0 1 1 0-80z"/></svg>

                        </div>
                    </div>

                </div>
            </div>
            <div class="row ">
                <div class="col text-center"><button type="button" class="btn btn-success" onclick="validarEntrada()">Entrar</button>
                </div>
            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>


<!-- 
<div class="container d-flex justify-content-center align-items-center">
           <div class="divLogo justify-content-center align-items-center ">
                <img class="imgLogo" src="../../src/imagenes/logo.png" />
            </div>
        <div class="screen">
            <div class="screen__content">
                <form class="login">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input" placeholder="Usuario">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" placeholder="Contraseña">
                    </div>
	
                    <div class="contenedor-boton-gen">
                        <div class="main_div">
                            <button onclick="crearEmpleado()" style="font-size: 13px;">Iniciar sesión</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>		
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>		
        </div>
    </div> -->