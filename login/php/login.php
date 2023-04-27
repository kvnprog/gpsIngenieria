<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../src/imagenes/logo.png">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet" />
    <script src="../js/funciones.js"></script>
    <script src="../../fGenerales/js/alerts.js"></script>

    <title>gpsingenieria
    </title>
</head>


<body class="m-0 vh-100 row justify-content-center align-items-center">

     
     <div class="divLogo justify-content-center align-items-center ">
        <img class="imgLogo" src="../../src/imagenes/logo.png"/>
     </div>

    <div class="container  row justify-content-center align-items-center ">

        <form id="frmLogin">

            <div class="row ">

                <div class="col-lg-2  text-center" style="color:white">Usuario</div>
                <div class="col-lg-1"></div>

                
                <div class="col-lg-9 form-group has-feedback">
                
                    <input class="form-control" type="text" name="usuario" placeholder="Escribe su Usuario" />
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-2  text-center  " style="color:white">Password</div>
                <div class="col-lg-1"></div>
                <div class="col-lg-9 "><input class="form-control" type="password" name="password" placeholder="Escriba su Password" /></div>
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