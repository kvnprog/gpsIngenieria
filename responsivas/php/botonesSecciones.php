<?php
    // CHECA LOS PERMISOS DEL USUARIO
    session_name('gpsingenieria');
    session_start();
    $datos = checarPermisosSeccion($_SESSION['usuarioid']);
?>
<div class="row">
    
    <div class="col-1"></div>

    <div class="col-10">
        <div class="btn-group " style="width:100%" role="group" aria-label="Basic example">

            <!-- MUESTRA LOS BOTONES A LOS QUE EL USUARIO TIENE PERMISO -->
            <?php
            foreach ($datos->fetch_all() as $dato) {

                if ($dato[1] == 17) {
                    echo "<button type=\"button\" class=\"btn btn-secondary btnUsuarios\" onclick=\"abrirSeccion(1)\">Catalogo</button>";
                }
            }
            ?>

        </div>
    </div>

    <div class="col-1"></div>

</div>