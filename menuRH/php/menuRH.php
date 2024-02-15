<?php
    include "../../fGenerales/bd/conexion.php";
    include "../../fGenerales/php/funciones.php";

    pantallaCarga('on');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php pintarHead('RH') ?>
</head>

<body class=" justify-content-center align-items-center" onload="document.getElementById('pantallaCarga').style.display='none'">
   
    <!-- NAVBAR -->
    <?php pintarNavBar(); ?>

    <div class="contenedorCont">
        <!-- //div principal -->
        <div class="col-12">
            
            <?php pintarEncabezado('Recursos humanos','<i class="fa-solid fa-users-gear fa-2xl"></i>', ''); ?>
            
            <div class="row" style="display: flex; justify-content: center; align-items: center; text-align: center;">

                <div class="col-12">
                    <button class="btn-apartado-secciones" onclick="abrirEmpleados(1)">
                        <span class="button_lg">
                            <span class="button_sl"></span>
                            <span class="button_text">Empleados</span>
                        </span>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <?php pintarFooter()?>
    
</body>

</html>