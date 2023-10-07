       <?php //checando los datos de las ventas
        $conexionVentas = new conexion;
        $queryVentas = "SELECT v.ventaid,CONCAT(IFNULL(c.nombre, ''), ' ', IFNULL(c.apellidos, '')) AS nombre_completo  ,u.nombreusuario ,v.fecha ,v.nombrecompra ,v.total ,v.deuda  
        from ventas v 
        join clientes c on v.clienteid = c.idcliente  
        join usuarios u on v.usuarioid = u.idusuario 
        where v.tipocliente = 1 
        union
        select v.ventaid,ce.empresa  as cliente,u.nombreusuario,v.fecha ,v.nombrecompra ,v.total ,v.deuda  
        from ventas v 
        join clienteexpress ce on v.clienteid = ce.clienteid  
        join usuarios u on v.usuarioid = u.idusuario 
        where v.tipocliente  = 2
        order by ventaid desc";
        $resultados = $conexionVentas->conn->query($queryVentas);?>

     

   
    
       <div class="row" id="catalogo" style="display: none;">
           <div class="col-12 text-center">
               <h3>Catalogo de Usuarios</h3>
           </div>
           <div class="col-1"></div>
           <?php include "filtros.php"?>

           <div class="col-1"></div>
           <!-- Empiezo de tabla -->
           <div class="col-10">
               <div class="table-responsive">
                   <table id="catalogoVentas" class="table table-hover">
                       <thead>
                           <tr>
                               <th class="text-center" scope="col">Cliente</th>
                               <th class="text-center" scope="col">Trabajador</th>
                               <th class="text-center" scope="col">fecha</th>
                               <th class="text-center" scope="col">Compra</th>
                               <th class="text-center" scope="col">Total</th>
                               <th class="text-center" scope="col">Deuda</th>
                               <th class="text-center" colspan="1" scope="col">Venta</th>
                           </tr>
                       </thead>
                       <tbody>
                           <img class="marcaAguaTabla" src="../../src/imagenes/logo.png">
        <!--LLENADO LOS DATOS DE LAS TABLAS   -->
<?php
    foreach($resultados->fetch_all() as $datos){

        echo "<tr><td>".$datos[1]."</td><td>".$datos[2]."</td><td>".$datos[3]."</td><td>".$datos[4]."</td><td>".$datos[5]."</td><td>".$datos[6]."</td><td><img src=\"../../src/imagenes/pdf.png\" width=\"50px\" onclick=\"abrirVenta(".$datos[0].")\"></td></tr>";

    }

?>    

       


    
    </tbody>
                   </table>
               </div>
           </div>
           <!-- Empiezo tabla final -->
           <div class="col-1"></div>
       </div>