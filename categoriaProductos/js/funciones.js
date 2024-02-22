// MUESTRA LA SECCION SELECCIONADA
function abrirSeccion(opcion) {
    
    pantallaCarga('on');

    if (opcion == 1) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogoCategorias").style.display = 'flex';
        document.getElementById("registrosCategorias").style.display = 'none';
        document.getElementById("registrosSubcategorias").style.display = 'none';
        document.getElementById("catalogoSubcategoria").style.display = 'none';
        pantallaCarga('off');
    }

    if (opcion == 2) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogoCategorias").style.display = 'none';
        document.getElementById("registrosCategorias").style.display = 'flex';
        document.getElementById("registrosSubcategorias").style.display = 'none';
        document.getElementById("catalogoSubcategoria").style.display = 'none';
        pantallaCarga('off');
    }

    if (opcion == 3) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogoCategorias").style.display = 'none';
        document.getElementById("registrosCategorias").style.display = 'none';
        document.getElementById("registrosSubcategorias").style.display = 'flex';
        document.getElementById("catalogoSubcategoria").style.display = 'none';
        pantallaCarga('off');
    }

    if (opcion == 4) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogoCategorias").style.display = 'none';
        document.getElementById("registrosCategorias").style.display = 'none';
        document.getElementById("registrosSubcategorias").style.display = 'none';
        document.getElementById("catalogoSubcategoria").style.display = 'flex';
        pantallaCarga('off');
    }
}

// CREA LA CATEGORIA
function crearCategoria() {
    
    pantallaCarga('on');

    var formulario = document.getElementById("frmRegistroCategoria");

    var categoria = formulario.categoria.value;

    if(categoria != ''){

        const options = { method: "GET" };

        fetch("../../categoriaProductos/php/crearCategoriaAJAX.php?categoria=" + categoria, options)
        .then(response => response.json())
        .then(data => {

            if (data["resultado"]) {
                actualizaCategoria(data);
                alertImage('ÉXITO', 'Se registró la categoría correctamente.', 'success');
                pantallaCarga('off');
                document.getElementById('frmRegistroCategoria').reset();

            } else {
                alertImage('ERROR', 'Surgió un error en el registro.', 'error');
                pantallaCarga('off');
            }
        })
    } else {
        alertImage('ERROR', 'Llena el campo para poner una categoría.', 'error');
        pantallaCarga('off');
    }
}

// CREAR SUBCATEGORIA
function crearSubCategoria() {
    
    pantallaCarga('on');

    var formulario = document.getElementById("frmRegistroSubcategoria");

    var subCategoria = formulario.subcategoria.value;

    if(subCategoria != ''){
        const options = { method: "GET" };

        fetch("../../categoriaProductos/php/crearSubcategoriaAJAX.php?subcategoria="+subCategoria, options)
        .then(response => response.json())
        .then(data => {

            if (data["resultado"]) {
                actualizaSubcategoria(data);
                alertImage('ÉXITO', 'Se registró la subcategoría correctamente.', 'success');
                document.getElementById('frmRegistroSubcategoria').reset();
                pantallaCarga('off');
            } else {
                alertImage('ERROR', 'Surgió un error en el registro.', 'error');
                pantallaCarga('off');
            }
        })
    } else {
        alertImage('Error', 'Llena el campo vació.', 'error');
        pantallaCarga('off');
    }
}

// ACTUALIZA LA TABLA DE LAS CATEGORIAS
function actualizaCategoria(data) {

    var noDatos = data["noDatos"];
    var catalogoCategorias = document.getElementById("tablaCatalogoCategorias");

    catalogoCategorias.innerHTML = "";
    catalogoCategorias.innerHTML = "<thead><tr><th class=\"text-center\" scope=\"col\">Nombre</th><th class=\"text-center\" colspan=\"1\" scope=\"col\"></th></tr></thead>";

    var cadenaCategorias = "<tbody>";
    for (var i = 0; i < noDatos; i++) {
        var id = data[i]["id"];
        var nombre = data[i]["nombre"];

        cadenaCategorias = cadenaCategorias + " <tr><td class=\"text-center\">" + nombre + "</td><td><div class='cont-btn-tabla'><div class='cont-icono-tbl' onclick=\"abrirModalCategoria(" + id + ",'" + nombre + "')\"><i class='fa-solid fa-pen-to-square fa-lg'></i></div></div></td></tr>";
    }

    cadenaCategorias = cadenaCategorias + "</tbody>"
    catalogoCategorias.innerHTML = catalogoCategorias.innerHTML + cadenaCategorias;
}

// ACTUALIZA LA TABLA DE LA SUBCATEGORIA
function actualizaSubcategoria(data) {

    var noDatos = data["noDatos"];
    var catalogoSubcategorias = document.getElementById("tablaCatalogoSubcategorias");

    catalogoSubcategorias.innerHTML = "";
    catalogoSubcategorias.innerHTML = "<thead><tr><th class=\"text-center\" scope=\"col\">Nombre</th><th class=\"text-center\" colspan=\"1\" scope=\"col\"></th></tr></thead>";

    var cadenaCategorias = "<tbody>";
    for (var i = 0; i < noDatos; i++) {
        var id = data[i]["id"];
        var nombre = data[i]["nombre"];

        cadenaCategorias = cadenaCategorias + " <tr><td class=\"text-center\">" + nombre + "</td><td><div class='cont-btn-tabla'><div class='cont-icono-tbl' onclick=\"abrirModalSubcategoria(" + id + ",'" + nombre + "')\"><i class='fa-solid fa-pen-to-square fa-lg'></i></div></div></td></tr>";
    }

    cadenaCategorias = cadenaCategorias + "</tbody>"
    catalogoSubcategorias.innerHTML = catalogoSubcategorias.innerHTML + cadenaCategorias;
}

// ABRE MODAL PARA EDITAR
function abrirModalCategoria(id, nombre) {
    var formulario = document.getElementById("frmModificarCategoria");
    formulario.id.value = id;
    formulario.nombre.value = nombre;

    $("#modalModificarCategoria").modal('show');
}

// ABRE MODAL PARA EDITAR
function abrirModalSubcategoria(id, nombre) {
    var formulario = document.getElementById("frmModificarSubcategoria");
    formulario.id.value = id;
    formulario.nombre.value = nombre;

    $("#modalModificarSubcategoria").modal('show');
}

// MODIFICA LA CATEGORIA
function modificarCategoria() {

    pantallaCarga('on');
    
    const data = new FormData(document.getElementById('frmModificarCategoria'));
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
            actualizaCategoria(data);
            alertImage('EXITO', 'Se modificó exitosamente la categoría.', 'success')
            pantallaCarga('off');
            $('#modalModificarCategoria').modal('hide');
        }
        if (data["resultado"] == 2) {
            alertImage('ERROR', 'Error en la modificación.', 'error')
            pantallaCarga('off');
        }


    })

}

// MODIFICA LA SUBCATEGORIA
function modificarSubcategoria() {

    pantallaCarga('on');
    
    const data = new FormData(document.getElementById('frmModificarSubcategoria'));
    const options = {
        method: "POST",
        body: data
    };

    fetch("../../categoriaProductos/php/modificarSubcategoriaAJAX.php", options)
    .then(response => response.json())
    .then(data => {

        if (data["resultado"] == 0) {
            alertImage('ERROR', 'La subcategoría ya se encuentra.', 'error')
            pantallaCarga('off');
        }
        if (data["resultado"] == 1) {
            actualizaSubcategoria(data);
            alertImage('EXITO', 'Se modificó exitosamente la subcategoría.', 'success')
            pantallaCarga('off');
            $('#modalModificarSubcategoria').modal('hide');
        }
        if (data["resultado"] == 2) {
            alertImage('ERROR', 'Error en la modificación.', 'error')
            pantallaCarga('off');
        }
    })
}