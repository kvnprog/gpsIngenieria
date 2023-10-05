<?php


    function pintarCatalogo(){

        //checando los datos de las ventas
        $conexionVentas = new conexion;
        $queryVentas = "SELECT v.ventaid,c.nombre as cliente,v.fecha ,v.nombrecompra ,v.total ,v.deuda  
        from ventas v 
        join clientes c on v.clienteid = c.idcliente  
        where v.tipocliente = 1 
        union
        select v.ventaid,ce.empresa  as cliente,v.fecha ,v.nombrecompra ,v.total ,v.deuda  
        from ventas v 
        join clienteexpress ce on v.clienteid = ce.clienteid  
        where v.tipocliente  = 2
        order by ventaid desc";
        $resultados = $conexionVentas->conn->query($queryVentas);

        

       echo
    "
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
                               <th class=\"text-center\" colspan=\"1\" scope=\"col\">Venta</th>
                           </tr>
                       </thead>
                       <tbody>
                           <img class=\"marcaAguaTabla\" src=\"../../src/imagenes/logo.png\">";
    //    <!--LLENADO LOS DATOS DE LAS TABLAS   -->

    foreach($resultados->fetch_all() as $datos){

        echo "<></>";

    }

       


    echo
    "</tbody>
                   </table>
               </div>
           </div>
           <!-- Empiezo tabla final -->
           <div class=\"col-1\"></div>
       </div>";


    }