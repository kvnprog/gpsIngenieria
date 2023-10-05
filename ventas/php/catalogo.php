<?php


    function pintarCatalogo(){

        //checando los datos de las ventas
        $conexionUsuarios = new conexion;
        $queryUsuarios = "SELECT * FROM ventas ";
        $resultados = $conexionUsuarios->conn->query($queryUsuarios);

        

       echo "
       <div class=\"row\" id=\"catalogo\" style=\"display: none;\">
           <div class=\"col-12 text-center\">
               <h3>Catalogo de Usuarios</h3>
           </div>
           <div class=\"col-1\"></div>
           <!-- Empiezo de tabla -->
           <div class=\"col-10\">
               <div class=\"table-responsive\">
                   <table id=\"catalogoUsuarios\" class=\"table table-hover\">
                       <thead>
                           <tr>
                               <th class=\"text-center\" scope=\"col\">Cliente</th>
                               <th class=\"text-center\" scope=\"col\">Trabajador</th>
                               <th class=\"text-center\" scope=\"col\">fecha</th>
                               <th class=\"text-center\" scope=\"col\">Compra</th>
                               <th class=\"text-center\" scope=\"col\">Total</th>
                               <th class=\"text-center\" scope=\"col\">Deuda</th>
                               <th class=\"text-center\" colspan=\"1\" scope=\"col\"></th>
                           </tr>
                       </thead>
                       <tbody>
                           <img class=\"marcaAguaTabla\" src=\"../../src/imagenes/logo.png\">
                           <!--LLENADO LOS DATOS DE LAS TABLAS   -->
                         

                       </tbody>
                   </table>
               </div>
           </div>
           <!-- Empiezo tabla final -->
           <div class=\"col-1\"></div>
       </div>
       
       ";


    }