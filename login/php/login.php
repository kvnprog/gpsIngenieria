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
    <script src="../../fGenerales/js/alerts.js"></script>

    <title>gpsingenieria
    </title>
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