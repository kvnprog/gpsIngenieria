<?php

    include "../../fGenerales/bd/conexion.php";
   
    include "catalogo.php";
    include "modal.php";

function body(){

//checando permisos del usuario en la seccion

session_name('gpsingenieria');
session_start();

$datos = checarPermisosSeccion($_SESSION['usuarioid']);

echo "<body class=\" justify-content-center align-items-center\">";
echo    "<div class=\"contenedorCont\">";
        //div principal
echo        "<div class=\"col-12\">";
            
            pintarEncabezado('Ventas','sales.svg');
            
echo           "<div class=\"row\">";

echo                "<div class=\"col-1\"></div>";
                    "<div class=\"col-10\">";
echo                    "<div class=\"btn-group \" style=\"width:100%\" role=\"group\" aria-label=\"Basic example\">";
                          echo "<button type=\"button\" class=\"btn btn-secondary btnUsuarios\" onclick=\"abrirSeccion(1)\">Catalogo</button>";
echo                    "</div>";
echo                "</div>";
echo                        "<div class=\"col-1\"></div>";
echo            "</div>";
           //botones del menu de usuarios fin
             pintarCatalogo();
            //Tabla de datos Usuarios final
        echo "</div>";
        //div principal fin 
        //PINTAR MODAL
        pintarModal();
   echo "<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4\" crossorigin=\"anonymous\"></script>";   

   pintarFooter();

echo "</body>";

}

?>