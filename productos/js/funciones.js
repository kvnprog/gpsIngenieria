// MUESTRA LA SECCION SELECCIONADA
function abrirSeccion(opcion) {

    pantallaCarga('on');
    
    if (opcion == 1) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'flex';
        document.getElementById("frmRegistroProductos").style.display = 'none';
        document.getElementById("catalogoEntradas").style.display = 'none';
        document.getElementById("uploadDataProducts").style.display = 'none';
        
        pantallaCarga('off');
        actualizaCatalogoProductos();
    }
    if (opcion == 2) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'none';
        document.getElementById("frmRegistroProductos").style.display = 'flex';
        document.getElementById("catalogoEntradas").style.display = 'none';
        document.getElementById("uploadDataProducts").style.display = 'none';

        pantallaCarga('off');
    }
    if (opcion == 3) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'none';
        document.getElementById("frmRegistroProductos").style.display = 'none';
        document.getElementById("catalogoEntradas").style.display = 'flex';
        document.getElementById("uploadDataProducts").style.display = 'none';
        
        pantallaCarga('off');
        actualizaCatalogoProductosEntradas();
    }
    if (opcion == 4) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'none';
        document.getElementById("frmRegistroProductos").style.display = 'none';
        document.getElementById("catalogoEntradas").style.display = 'none';
        document.getElementById("uploadDataProducts").style.display = 'flex';
        
        pantallaCarga('off');
        actualizaCatalogoProductosEntradas();
    }
}

// INSERTA UN PRODUCTO
function crearProducto() {

    pantallaCarga('on');

    const formulario  = document.getElementById('frmRegistroProductos');
    const formData = new FormData(formulario);

    const options = {
        method: "POST",
        body: formData,
    };

    fetch("../../productos/php/crearAJAX.php", options)
    .then(response => response.json())
    .then(data => {

        if (data["resultado"]) {
            alertImage('EXITO', 'Se registró el producto con éxito.', 'success')
            formulario.reset();
            actualizaCatalogoProductos();
            pantallaCarga('off');

        } else {
            alertImage('ERROR', 'Surgió un error en el registro', 'error')
            pantallaCarga('off');
        }
    });
}

// ACTUALIZA LA TABLA DE PRODUCTOS
function actualizaCatalogoProductos() {
    
    pantallaCarga('on');
    
    var tabla = document.getElementById('tablaCatalogoProductos');
    var contenidoTabla = '';
    tabla.innerHTML = contenidoTabla;
    
    const options = { method: "GET" };

    fetch("../../productos/php/traeProductosAJAX.php", options)
    .then(response => response.json())
    .then(data => {

        if (data["resultado"]) {
            
            contenidoTabla = '<thead>'+
                                '<tr>'+
                                    '<th class="text-center">No. de parte</th>'+
                                    '<th class="text-center">Descripción</th>'+
                                    '<th class="text-center">Precio publico</th>'+
                                    '<th class="text-center">Precio venta</th>'+
                                    '<th class="text-center">Categoría</th>'+
                                    '<th class="text-center">Subcategoría</th>'+
                                    '<th></th>'+
                                    '<th></th>'+
                                '</tr>'+
                            '</thead>';

            contenidoTabla += '<tbody>';
            
            for (var i = 0; i < data["noDatos"]; i++) {
            
                var id_producto = data[i]["id_producto"];
                var no_parte = data[i]["no_parte"];
                var descripcion = data[i]["descripcion"];
                var precio_public = data[i]["precio_public"];
                var precio_venta = data[i]["precio_venta"];
                var id_categoria = data[i]["id_categoria"];
                var id_subcategoria = data[i]["id_subcategoria"];
                var nombre_categoria = data[i]["nombre_categoria"];
                var nombre_subcategoria = data[i]["nombre_subcategoria"];

                contenidoTabla += '<tr>';
                    contenidoTabla += '<td class="text-center">'+no_parte+'</td>';
                    contenidoTabla += '<td class="text-center">'+descripcion+'</td>';
                    contenidoTabla += '<td class="text-center">$'+precio_public+'</td>';
                    contenidoTabla += '<td class="text-center">$'+precio_venta+'</td>';
                    contenidoTabla += '<td class="text-center">'+nombre_categoria+'</td>';
                    contenidoTabla += '<td class="text-center">'+nombre_subcategoria+'</td>';
                    contenidoTabla += "<td><div class='cont-btn-tabla'><div class='cont-icono-tbl' onclick='abrirModalEditarProducto()'><i class='fa-solid fa-pen-to-square fa-lg'></i></div></div></td>";
                    contenidoTabla += "<td><div class='cont-btn-tabla'><div class='cont-icono-tbl' onclick='abrirModalRegistrarEntrada("+id_producto+", \""+encodeURIComponent(no_parte)+"\", \""+encodeURIComponent(descripcion)+"\")'><i class='fa-solid fa-plus fa-lg'></i></div></div></td>";
                contenidoTabla += '<tr>';
            }

            contenidoTabla += '</tbody>';
            tabla.innerHTML = contenidoTabla;
            pantallaCarga('off');

        } else {
            alertImage('ERROR', 'Surgió un error en el catalogo productos', 'error')
            pantallaCarga('off');
        }
    });
}

function abrirModalEditarProducto() {
    $("#miModalEditarProducto").modal('show');
    var formulario = document.getElementById("frmModificarProducto");
    // formulario.id.value = productoid;
    // formulario.nParte.value = nParte;
    // formulario.descripcion.value = descripcion;
    // formulario.categoria.value = idcategoria;
    // formulario.maximos.value = maximos;
    // formulario.minimos.value = minimos;
    // formulario.existentes.value = existentes;
    // formulario.comentarios.value = comentarios;
    // formulario.precio.value = precio;
}

// ABRE EL MODAL PARA REGISTRAR ENTRADAS
function abrirModalRegistrarEntrada(idProducto, no_parte, descripcion) {
    // Decodificar los valores de no_parte y descripcion
    no_parte = decodeURIComponent(no_parte);
    descripcion = decodeURIComponent(descripcion);
    
    $("#modalAgregarProducto").modal('show');

    var frmEntradas = document.getElementById('frmRegistrarEntrada');
    var tabla = document.getElementById('tablaEntadas');
    var contenidoTabla = '';

    frmEntradas.id.value = idProducto;
    
    contenidoTabla += '<thead>' +
                        '<tr>' +
                            '<th class="text-center">No. de parte</th>' +
                            '<th class="text-center">Descripción</th>' +
                        '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                        '<tr>' +
                            '<td class="text-center">' + no_parte + '</td>' +
                            '<td class="text-center">' + descripcion + '</td>' +
                        '</tr>' +
                    '</tbody>';

    tabla.innerHTML = contenidoTabla;
}

function uploadDataProducts() {

   // Obtener el formulario
   const form = document.getElementById("frmExcelUpload");
   // Crear un objeto FormData para recopilar los datos del formulario
   const formData = new FormData(form);
   // Realizar la solicitud Fetch
   fetch("../../productos/php/uploadDataProductsAJAX.php", {
       method: "POST",
       body: formData
   })
   .then(response => {
       if (!response.ok) {
           throw new Error("Error en la solicitud");
       }
       return response.json();
   })
   .then(data => {
       console.log("Respuesta del servidor:", data);
       // Aquí puedes hacer algo con la respuesta del servidor, como mostrar un mensaje de éxito
   })
   .catch(error => {
       console.error("Error al procesar la solicitud:", error);
       // Aquí puedes manejar el error, como mostrar un mensaje de error al usuario
   });

}