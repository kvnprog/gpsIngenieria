function abrirSeccion(opcion) {

    if (opcion == 1) {


        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'flex';
        document.getElementById("registros").style.display = 'none';

    }

    if (opcion == 2) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'none';
        document.getElementById("registros").style.display = 'flex';



    }



}


function crearProducto() {

    const data = new FormData(document.getElementById('frmRegistroNParte'));

    const options = {
        method: "POST",
        body: data

    };

    // Petición HTTP
    fetch("../../productos/php/crearAJAX.php", options)
        .then(response => response.json())
        .then(data => {

            console.log(data["query"]);
            if (data["resultado"]) {
                alertImage('EXITO', 'Se creo el producto con existo', 'success')
                actualiza(data);
            } else {
                alertImage('ERROR', 'Surgio un error en el registro', 'error')
            }


        });

}

function actualiza(data) {

    var catalogoProductos = document.getElementById("catalogoProductos");

    catalogoProductos.innerHTML = "<thead>" +
        "<tr>" +
        "<th class=\"text-center\" scope=\"col\">Numero de Parte</th>" +
        "<th class=\"text-center\" scope=\"col\">Descripcion</th>" +
        "<th class=\"text-center\" scope=\"col\">Categoria</th>" +
        "<th class=\"text-center\" scope=\"col\">Maximos</th>" +
        "<th class=\"text-center\" scope=\"col\">Minimos</th>" +
        "<th class=\"text-center\" scope=\"col\">Existentes</th>" +
        "<th class=\"text-center\" scope=\"col\">Comentarios</th>" +
        "<th class=\"text-center\" colspan=\"2\" scope=\"col\"></th>" +
        "</tr>" +
        "</thead>";

    var cadenaProductos = "<tbody>";

    for (var i = 0; i < data["noDatos"]; i++) {

        var id = data[i]["id"];
        var nParte = data[i]["nParte"];
        var descripcion = data[i]["descripcion"];
        var idcategoria = data[i]["idcategoria"];
        var categoria = data[i]["categoria"];
        var maximos = data[i]["maximos"];
        var minimos = data[i]["minimos"];
        var existentes = data[i]["existentes"];
        var comentarios = data[i]["comentarios"];

        cadenaProductos = cadenaProductos + " <tr> " +
            "<td class=\"text-center\">" + nParte + "</td> " +
            "<td class=\"text-center\">" + descripcion + "</td> " +
            "<td class=\"text-center\">" + categoria + "</td> " +
            "<td class=\"text-center\">" + maximos + "</td> " +
            "<td class=\"text-center\">" + minimos + "</td> " +
            "<td class=\"text-center\">" + existentes + "</td> " +
            "<td class=\"text-center\">" + comentarios + "</td> " +
            "<td class=\"text-center\"><img src=\"../../src/imagenes/editargps.png\" width=\"50px\" onclick=\"abrirModal(" + id + ",'" + nParte + "','" + descripcion + "'," + idcategoria + ",'" + categoria + "'," + maximos + "," + minimos + "," + existentes + ",'" + comentarios + "')\"></td> " +

            "</tr>"


    }

    cadenaProductos = cadenaProductos + "</tbody>";

    catalogoProductos.innerHTML =  catalogoProductos.innerHTML  + cadenaProductos;

}