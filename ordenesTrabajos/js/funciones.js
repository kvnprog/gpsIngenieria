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
        
    

        cadenaProductos = cadenaProductos + " <tr> " +
            "<td class=\"text-center\">" + numfolio + "</td> " +
            "<td class=\"text-center\">" + trabajador + "</td> " +
            "<td class=\"text-center\">" + cliente + "</td> " +
            "<td class=\"text-center\">" + total + "</td> " +
            "<td class=\"text-center\"></td> " +
            "<td class=\"text-center\">" + fecha + "</td> " +
            "<td class=\"text-center\"><img src=\"../../src/imagenes/pdf.png\" width=\"50\"  onclick=\"checarOrden("+id+")\"></td>" +
            "</tr>"


    }

    cadenaProductos = cadenaProductos + "</tbody>";

    catalogoProductos.innerHTML = catalogoProductos.innerHTML + cadenaProductos;

}

function checarOrden(ordenid){

    window.open("../../ordenesTrabajos/php/formatoOrdenTrabajo.php", "_self");


}