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

function crearCategoria() {

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

                alertImage('EXITO', 'Se registro la categoria correctamente', 'success')
            } else {
                alertImage('ERROR', 'Surgio un error en el registro', 'error')
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


    const data = new FormData(document.getElementById('frmModificar'));


    const options = {
        method: "POST",
        body: data

    };

    fetch("../../categoriaProductos/php/modificarCategoriaAJAX.php", options)
        .then(response => response.json())
        .then(data => {

            if (data["resultado"] == 0) {
                alertImage('ERROR', 'La categoria ya se encuentra ', 'error')
            }
            if (data["resultado"] == 1) {


                actualizar(data);

                alertImage('EXITO', 'Se modifico exitosamente la categoria ', 'success')
            }
            if (data["resultado"] == 2) {
                alertImage('ERROR', 'Error en la modificacion', 'error')
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