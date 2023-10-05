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


function crearProducto() {

    pantallaCarga('on');

    const formulario  = document.getElementById('frmRegistroNParte');
    const formData = new FormData(formulario);

    const options = {
        method: "POST",
        body: formData,
    };

    // Petición HTTP
    fetch("../../productos/php/crearAJAX.php", options)
    .then(response => response.json())
    .then(data => {

        // console.log(data);

        if (data["resultado"]) {
            alertImage('EXITO', 'Se creo el producto con existo', 'success')
            actualiza(data);

            pantallaCarga('off');

        } else {
            alertImage('ERROR', 'Surgio un error en el registro', 'error')

            pantallaCarga('off');
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
        "<th class=\"text-center\" scope=\"col\">Agregar</th>" +
        "<th class=\"text-center\" scope=\"col\">Comentarios</th>" +
        "<th class=\"text-center\" scope=\"col\">Precio Por Unidad</th>" +
        "<th class=\"text-center\" scope=\"col\">Foto</th>" +
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
        var precio = data[i]["precio"];
        var img = data[i]["img"];

        cadenaProductos = cadenaProductos + " <tr> " +
            "<td class=\"text-center\">" + nParte + "</td> " +
            "<td class=\"text-center\">" + descripcion + "</td> " +
            "<td class=\"text-center\">" + categoria + "</td> " +
            "<td class=\"text-center\">" + maximos + "</td> " +
            "<td class=\"text-center\">" + minimos + "</td> " +
            "<td class=\"text-center\">" + existentes + "</td> " +
            "<td class=\"text-center\"><img src=\"../../src/imagenes/agregargps.png\" width=\"30px\" id=\"btnNuevasExitencias-"+id+"\" onclick=\"abrirNuevasExistencias("+id+")\"><input type=\"number\" id=\"existenciasNuevas-"+id+"\" style=\" display: none;\"  onkeypress=\"mandarExistencias(event,"+id+")\"></td>"+
            "<td class=\"text-center\">" + comentarios + "</td> " +
            "<td class=\"text-center\">" + precio + "</td> ";         

        cadenaProductos += "<td class=\"text-center\">"+img+"</td>";
        cadenaProductos += "<td class=\"text-center\"><img src=\"../../src/imagenes/editargps.png\" width=\"50px\" onclick=\"abrirModal(" + id + ",'" + nParte + "','" + descripcion + "'," + idcategoria + ",'" + categoria + "'," + maximos + "," + minimos + "," + existentes + ",'" + comentarios + "','"+precio+"')\"></td> " +
            "</tr>";
    }

    cadenaProductos = cadenaProductos + "</tbody>";

    catalogoProductos.innerHTML = catalogoProductos.innerHTML + cadenaProductos;

}

function abrirModal(productoid, nParte, descripcion, idcategoria, categoria, maximos, minimos, existentes, comentarios,precio) {

    var formulario = document.getElementById("frmModificar");
    formulario.id.value = productoid;
    formulario.nParte.value = nParte;
    formulario.descripcion.value = descripcion;
    formulario.categoria.value = idcategoria;
    formulario.maximos.value = maximos;
    formulario.minimos.value = minimos;
    formulario.existentes.value = existentes;
    formulario.comentarios.value = comentarios;
    formulario.precio.value = precio;

    $("#miModal").modal('show');

}



function modificarUsuario() {
    pantallaCarga('on');

    const data = new FormData(document.getElementById('frmModificar'));

    const options = {
        method: "POST",
        body: data

    };

    // Petición HTTP
    fetch("../../productos/php/modificarAJAX.php", options)
        .then(response => response.json())
        .then(data => {
            if (data["resultado"]){
                alertImage('EXITO', 'Se modifico el registro con exito', 'success')
                actualiza(data);

                pantallaCarga('off');
            }else{
                alertImage('ERROR', 'hubo un error', 'error')
                pantallaCarga('off');
            }

        });

}

function filtrarProductos(){
    
    pantallaCarga('on');

    var filtroNParte = document.getElementById("filtroNParte").value;
    var filtroDescripcion = document.getElementById("filtroDescripcion").value;
    var filtroCategoria = document.getElementById("filtroCategoria").value;


    const options = {
        method: "GET"
    };

    // Petición HTTP
    fetch("../../productos/php/filtrarTablaAJAX.php?nParte="+filtroNParte+"&descripcion="+filtroDescripcion+"&categoriaid="+filtroCategoria, options)
    .then(response => response.json())
    .then(data => {

        actualiza(data);
        pantallaCarga('off');
    });
}

function abrirNuevasExistencias(id){

    var btnExistencia = document.getElementById("btnNuevasExitencias-"+id );
    var inputExitencias = document.getElementById("existenciasNuevas-"+id);
    
    if (btnExistencia.src.includes("agregargps")) {
        btnExistencia.src = btnExistencia.src.replace("agregargps","eliminargps");

        inputExitencias.style.display = "inline-block"
    } else {
        inputExitencias.style.display = "none"
        btnExistencia.src = btnExistencia.src.replace("eliminargps","agregargps");
    }

}


function mandarExistencias(event,id){
    document.getElementById('pantallaCarga').style.display='flex';
    if (event.keyCode == 13) {
        console.log('Se presionó la tecla Enter');

        var existenciasNuevas = document.getElementById("existenciasNuevas-"+id);

        if(/^[0-9]+$/.test(existenciasNuevas.value)){

            color="#03B559";
            color2="#B50309";

                swal.fire({
                    title: "Atencion!",
                    text: "Esta Seguro que desea agregar estas existencias?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'SI',
                    confirmButtonColor:color,
                    cancelButtonText: 'NO',
                    cancelButtonColor:color2,
                    allowOutsideClick:false
                    
                }).then((result) => {
                    if (result.isConfirmed) {

                        const options = {
                            method: "GET"
                        };
                        
                         // Petición HTTP
                         fetch("../../productos/php/agregarExistenciasAJAX.php?id="+id+"&existenciasNuevas="+existenciasNuevas.value, options)
                         .then(response => response.json())
                         .then(data => {
                             

                            if(data["bandera"]){

                                alertImage('EXITO', 'Se agregaron las existencias con Exito', 'success')
                                actualiza(data);

                            }else{
                                alertImage('ERROR', 'Hubo un error', 'error') 
                            }
                                 //actualiza(data);
                         });
                    }
                    else{
                        console.log('NO');
                    }
                })  
        }else{
            alertImage('ERROR', 'No se pueden poner letras', 'error');
            document.getElementById('pantallaCarga').style.display='none';
        }
        // Aquí puedes agregar la lógica que quieras realizar al presionar Enter
    }
}


