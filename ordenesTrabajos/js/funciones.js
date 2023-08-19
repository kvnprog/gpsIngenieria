function abrirSeccion(opcion) {

    if (opcion == 1) {


        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'flex';
    }

}


function filtrarOrdenes() {

    var filtroNFolio = document.getElementById("filtroNFolio").value;
    var filtroTrabajador = document.getElementById("filtroTrabajador").value;
    var filtroCliente = document.getElementById("filtroCliente").value;
    var filtroFecha = document.getElementById("filtroFecha").value;


    const options = {
        method: "GET"
    };

    // Petición HTTP
    fetch("../../ordenesTrabajos/php/filtrarTablaAJAX.php?filtroNFolio=" + filtroNFolio + "&filtroTrabajador=" + filtroTrabajador + "&filtroCliente=" + filtroCliente+ "&filtroFecha=" + filtroFecha, options)
        .then(response => response.json())
        .then(data => {

            actualiza(data);


        });

}

function actualiza(data) {

    var catalogoProductos = document.getElementById("catalogoProductos");

    catalogoProductos.innerHTML = "<thead>" +
        "<tr>" +
        "<th class=\"text-center\" scope=\"col\">N.Folio</th>" +
        "<th class=\"text-center\" scope=\"col\">Trabajador</th>" +
        "<th class=\"text-center\" scope=\"col\">Cliente</th>" +
        "<th class=\"text-center\" scope=\"col\">Factura</th>" +
        "<th class=\"text-center\" scope=\"col\">Pago Total</th>" +
        "<th class=\"text-center\" scope=\"col\">Pago realizado</th>" +
        "<th class=\"text-center\" scope=\"col\">Fecha</th>" +
        "<th class=\"text-center\" scope=\"col\">Orden de Trabajo</th>" + 
        "</tr>" +
        "</thead>";

    var cadenaProductos = "<tbody>";

    for (var i = 0; i < data["noDatos"]; i++) {

        var id = data[i]["id"];
        var trabajador = data[i]["trabajador"];
        var cliente = data[i]["cliente"];
        var total = data[i]["total"];
        var fecha = data[i]["fecha"];
        var numfolio = data[i]["numfolio"];
        var factura = data[i]["factura"];
        var pagoP = data[i]["pagoP"];
        
    

        cadenaProductos = cadenaProductos + " <tr> " +
            "<td class=\"text-center\">" + numfolio + "</td> " +
            "<td class=\"text-center\">" + trabajador + "</td> " +
            "<td class=\"text-center\">" + cliente + "</td> " +
            "<td class=\"text-center\">" + factura + "</td> " +
            "<td class=\"text-center\">" + total + "</td> " +
            "<td class=\"text-center\">"+ pagoP +"</td> " +
            "<td class=\"text-center\">" + fecha + "</td> " +
            "<td class=\"text-center\"><img src=\"../../src/imagenes/pdf.png\" width=\"50\"  onclick=\"checarOrden("+id+")\"></td>" +
            "</tr>"


    }

    cadenaProductos = cadenaProductos + "</tbody>";

    catalogoProductos.innerHTML = catalogoProductos.innerHTML + cadenaProductos;

}

function checarOrden(ordenid){

    window.open("../../ordenesTrabajos/php/formatoOrdenTrabajo.php?ordenid="+ordenid, "_blank");


}

function abrirPagos(id){

    $("#miModal").modal('show');
    
    var formularioPagos = document.getElementById("frmPagos");

    formularioPagos.id.value = id;

    formularioPagos.style.display = "none";


    const options = {
        method: "GET"
    };

    // Petición HTTP
    fetch("../../ordenesTrabajos/php/traerPagosAJAX.php?id="+id, options)
        .then(response => response.json())
        .then(data => {
           

            var tablaPagos = document.getElementById("tablaPagos");

            var cadena = "<tr><th>Cantidad</th><th>Evidencia</th></tr>";
            if(data["noDatos"]>0){

               for(var i=0; i<data["noDatos"] ; i++){

                cadena = cadena + "<tr><td>"+data[i]["cantidad"]+"</td><td><img src=\"../../src/imagenes/mostrarEvidencia.png\" width=\"30px\" onclick=\"mostrarEvidencia("+data[i]["id"]+")\"></td></tr>";

               }



            }

            tablaPagos.innerHTML = cadena;



        });



         




}

function mostrarEvidencia(id){

    window.open("../evidencias/evidencia"+id+".jpg","_blank");

}

function nuevoPago(){

    // if(estado==1){
       
    var formularioPagos = document.getElementById("frmPagos");

    
    
            var estado = formularioPagos.estado.value;
        if(estado==1){
           
            
            formularioPagos.style.display = "block";
        
            var btnNuevoPago = document.getElementById("btnNuevoPago");
        
            btnNuevoPago.textContent = "Subir"

            formularioPagos.estado.value = 0
        }else{

            formularioPagos.estado.value = 1


            const data = new FormData(document.getElementById('frmPagos'));

    const options = {
        method: "POST",
        body: data

    };

    // Petición HTTP
    fetch("../../ordenesTrabajos/php/subirPagoAJAX.php", options)
        .then(response => response.json())
        .then(data => {
            if (data["resultado"]){
                alertImage('EXITO', 'Se agrego el pago con exito', 'success')
                var formulario = document.getElementById("frmPagos");
                formulario.reset();

                var btnNuevoPago = document.getElementById("btnNuevoPago");
        
                btnNuevoPago.textContent = "Nuevo Pago"
                $("#miModal").modal('hide');
            }else{
                alertImage('ERROR', 'hubo un error', 'error')

            }

        });



         }


}

function cerrarPago(){


    var formulario = document.getElementById("frmPagos");
    formularioPagos.estado.value = 1

   
    formulario.reset();

                var btnNuevoPago = document.getElementById("btnNuevoPago");
        
                btnNuevoPago.textContent = "Nuevo Pago"
                $("#miModal").modal('hide');



}