function abrirSeccion(opcion) {
    
    pantallaCarga('on');

    if (opcion == 1) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'flex';
        document.getElementById("registros").style.display = 'none';
        pantallaCarga('off');
    }

    if (opcion == 2) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'none';
        document.getElementById("registros").style.display = 'flex';
        pantallaCarga('off');
    }
}

function crearCategoria() {
    
    pantallaCarga('on');

    var formulario = document.getElementById("frmRegistroCategoria");

    var nombre = formulario.nombre.value;
    const options = {
        method: "GET"

    };

    fetch("../../categoriaProductos/php/crearCategoriaAJAX.php?nombre=" + nombre, options)
        .then(response => response.json())
        .then(data => {

            if (data["resultado"]) {
                actualizar(data);
                alertImage('EXITO', 'Se registró la categoría correctamente.', 'success');
                pantallaCarga('off');
            } else {
                alertImage('ERROR', 'Surgió un error en el registro.', 'error');
                pantallaCarga('off');
            }
        })
}

function abrirModal(usuarioid, nombre) {

    var formulario = document.getElementById("frmModificar");
    formulario.id.value = usuarioid;
    formulario.nombre.value = nombre;

    $("#miModal").modal('show');
}

function modificarCategoria() {

    pantallaCarga('on');
    
    const data = new FormData(document.getElementById('frmModificar'));
    const options = {
        method: "POST",
        body: data
    };

    fetch("../../categoriaProductos/php/modificarCategoriaAJAX.php", options)
        .then(response => response.json())
        .then(data => {

            if (data["resultado"] == 0) {
                alertImage('ERROR', 'La categoría ya se encuentra.', 'error')
                pantallaCarga('off');
            }
            if (data["resultado"] == 1) {
                actualizar(data);
                alertImage('EXITO', 'Se modifico exitosamente la categoría.', 'success')
                pantallaCarga('off');
            }
            if (data["resultado"] == 2) {
                alertImage('ERROR', 'Error en la modificación.', 'error')
                pantallaCarga('off');
            }


        })

}

function actualizar(data) {

    var noDatos = data["noDatos"];
    var catalogoCategorias = document.getElementById("catalogoCategorias");

    catalogoCategorias.innerHTML = "";
    catalogoCategorias.innerHTML = "<thead><tr><th class=\"text-center\" scope=\"col\">Nombre</th><th class=\"text-center\" colspan=\"1\" scope=\"col\"></th></tr></thead>";

    var cadenaCategorias = "<tbody>";
    for (var i = 0; i < noDatos; i++) {

        var id = data[i]["id"];
        var nombre = data[i]["nombre"];

        cadenaCategorias = cadenaCategorias + " <tr><td class=\"text-center\">" + nombre + "</td><td class=\"text-center\"><img src=\"../../src/imagenes/editargps.png\" width=\"50px\" onclick=\"abrirModal(" + id + ",'" + nombre + "')\"></td></tr>";

    }

    cadenaCategorias = cadenaCategorias + "</tbody>"
    catalogoCategorias.innerHTML = catalogoCategorias.innerHTML + cadenaCategorias;

}