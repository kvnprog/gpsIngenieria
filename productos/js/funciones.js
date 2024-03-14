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

    const formulario  = document.getElementById('frmRegistroProductos');
    const formData = new FormData(formulario);
    
    if(formData.get('nParte') !='' && formData.get('descripcion') !='' && formData.get('precioPublico') !='' && formData.get('precioVenta') && formData.get('categoria') !=0 && formData.get('subcategoria') !=0){
        
        pantallaCarga('on');

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
    } else {
        alertImage('ERROR', 'Llena todos los campos', 'error')
    }
}

// ACTUALIZA LA TABLA DE PRODUCTOS
function actualizaCatalogoProductos() {
    
    pantallaCarga('on');
    
    var tabla = document.getElementById('tablaCatalogoProductos');
    var contenidoTabla = '';
    tabla.innerHTML = contenidoTabla;
    
    var frmFiltros = document.getElementById('frmFiltosCatalogoProd');
    var numParte = frmFiltros.filtroNParte.value;
    var descripcion = frmFiltros.filtroDescripcion.value;
    var categoria = frmFiltros.filtroCategoria.value;
    var subcategoria = frmFiltros.filtroSubcategoria.value;

    const options = { method: "GET" };
    var ruta = "../../productos/php/traeProductosAJAX.php?numParte="+numParte+"&descripcion="+descripcion+"&categoria="+categoria+"&subcategoria="+subcategoria;
    
    fetch(ruta, options)
    .then(response => response.json())
    .then(data => {
        pantallaCarga('off');
        if (data["resultado"] == 1) {
            
            contenidoTabla = '<thead class="sticky-top">'+
                        '<tr>'+
                            '<th colspan="8"><div class="cont-btn-tabla"><div data-toggle="tooltip" data-placement="top" title="Exportar a excel" style="background:#00a85a" class="cont-icono-tbl" onclick=\'exportarTablaExcel("tablaCatalogoProductos", "Catalogo productos", "Productos")\'><i class="fa-solid fa-file-excel fa-xl"></i></div></div></th>'+
                        '</tr>'+
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
                    contenidoTabla += "<td><div class='cont-btn-tabla'><div data-toggle='tooltip' data-placement='top' title='Editar registro' class='cont-icono-tbl' onclick='abrirModalEditarProducto("+id_producto+", \""+encodeURIComponent(no_parte)+"\", \""+encodeURIComponent(descripcion)+"\", "+precio_public+", "+precio_venta+")'><i class='fa-solid fa-pen-to-square fa-lg'></i></div></div></td>";
                    contenidoTabla += "<td><div class='cont-btn-tabla'><div data-toggle='tooltip' data-placement='top' title='Agregar registro' class='cont-icono-tbl' onclick='abrirModalRegistrarEntrada("+id_producto+", \""+encodeURIComponent(no_parte)+"\", \""+encodeURIComponent(descripcion)+"\")'><i class='fa-solid fa-plus fa-lg'></i></div></div></td>";
                contenidoTabla += '</tr>';
            }

            contenidoTabla += '</tbody>';
            tabla.innerHTML = contenidoTabla;
        } 

        if(data["resultado"] == 0) {
            alertImage('ERROR', 'Surgió un error en el catalogo productos', 'error')
        }
    });
}

// ABRE EL MODAL PARA EDITAR EL PRODUCTO
function abrirModalEditarProducto(id_producto, no_parte, descripcion, precio_public, precio_venta) {
    
    // Decodificar los valores de no_parte y descripcion
    no_parte = decodeURIComponent(no_parte);
    descripcion = decodeURIComponent(descripcion);
    
    $("#miModalEditarProducto").modal('show');
    var formulario = document.getElementById("frmModificarProducto");
    formulario.id.value = id_producto;
    formulario.nParte.value = no_parte;
    formulario.descripcion.value = descripcion;
    formulario.precioPublico.value = precio_public;
    formulario.precioVenta.value = precio_venta;
}

// ABRE EL MODAL PARA REGISTRAR ENTRADAS
function abrirModalRegistrarEntrada(idProducto, no_parte, descripcion) {
    // Decodificar los valores de no_parte y descripcion
    no_parte = decodeURIComponent(no_parte);
    descripcion = decodeURIComponent(descripcion);

    Swal.fire({
        title: 'Número de entradas que se harán con ese producto',
        input: 'number',
        inputPlaceholder: 'Ingresa cantidad aquí',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
        preConfirm: (number) => {
          // Aquí puedes hacer algo con el valor ingresado por el usuario
          return new Promise((resolve) => {
            setTimeout(() => {
                if (number > 0 && number < 21) {
                    resolve();
                } else {
                    resolve(Swal.showValidationMessage('El mínimo para registrar es 1 y máximo 20'));
                }
            }, 200);
          });
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {

        var numProductos = result.value;
        
        if(numProductos > 0){

            var sectionCatalogo = document.getElementById('section_catalogo');
            var sectionEntradas = document.getElementById('section_entradas');
            
            var tabla = document.getElementById('tablaEntradas');

            sectionCatalogo.classList.add('col-md-6');
            sectionEntradas.removeAttribute('hidden');

            var tablaTieneFilas = tabla.rows.length > 0;

            for(var i = 0; i < numProductos; i++) {
                var newRow = tabla.insertRow();

                // Agregar filas solo si la tabla no tiene filas aún
                if (!tablaTieneFilas) {
                    // Agregar encabezado si es la primera fila
                    var headerRow = tabla.createTHead().insertRow();
                    headerRow.classList.add('sticky-top');
                    headerRow.innerHTML = '<th>No. de parte</th><th>Descripción</th><th></th><th></th>';
                    tablaTieneFilas = true;
                }

                var cell1 = newRow.insertCell(0);
                cell1.textContent = no_parte;

                var cell2 = newRow.insertCell(1);
                cell2.textContent = descripcion;

                var cell3 = newRow.insertCell(2);
                cell3.innerHTML = '<div class="inputContainer" style="margin-top:35px">'+
                                        '<input name="'+idProducto+'" class="inputField" required="" type="text" placeholder="Escriba el número de serie">'+
                                        '<label class="usernameLabel" for="noSerie">No. serie</label>'+
                                        '<i class="userIcon fa-solid fa-barcode"></i>'+
                                    '</div>';

                var cell4 = newRow.insertCell(3);
                cell4.innerHTML = "<label class='containerCheck contenedorMargen'>" + 
                                        "<input type='checkbox' id='' onclick='colocaNA(this)'>NA" +
                                        "<div class='checkmark'></div>" +
                                    "</label>";
            }
        }
    });
}

// COLOCA NA AL CAMPO QUE SE DESEA QUEDAR VACIÓ
function colocaNA(checkbox){
    // OBTIENE EL ROW DEL CHECKBOX EN LA TABLA
    var row = checkbox.closest("tr");

    // ENCUENTRA EL INPUT EN ESE ROW DEL CHECKBOX
    var input = row.querySelector("input[type='text']");

    if (checkbox.checked) {
        if (input) {
            input.disabled = true;
            input.value = 'NA';
        }
    } else {
        if (input) {
            input.disabled = false;
            input.value = '';
        }
    }
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

// INSERTA UNA ENTRADA DE PRODUCTO
function insertarEntradaProd(){

    var tablaEntradas = document.getElementById('tablaEntradas');
    
    // OBTIENE TODAS LAS FILAS MENOS EL ENCABEZADO
    var filas = tablaEntradas.querySelectorAll('tr');
    
    var indiceColumna = 2; // COLUMNA DE LOS INPUTS
    
    var hayInputsVacios = false;
    
    filas.forEach(function(fila) {

        var input = fila.cells[indiceColumna].querySelector('input');

        if (input && input.value.trim() === '') {
            hayInputsVacios = true;
            input.focus(); // ENFOCA AL INPUT VACIÓ
        }
    });
    
    if (hayInputsVacios) {
        alertImage('ERROR', 'Aún hay campos vacíos, complétalos', 'error');
    } else {
        var inputs = document.querySelectorAll('table input.inputField');

        var arrayEntradas = [];

        inputs.forEach(function(input) {
            var noSerie = input.value;
            var idProd = input.name;
            var entrada = { noSerie: noSerie, idProd: idProd };

            arrayEntradas.push(entrada);
        });

        pantallaCarga('on');

        // Serializar el array como parámetro GET
        var queryString = arrayEntradas.map(function(entrada) {
            return encodeURIComponent('arrayEntradas[]') + '=' + encodeURIComponent(JSON.stringify(entrada));
        }).join('&');

        fetch("../../productos/php/insertarEntradaAJAX.php?" + queryString, { method: "GET" })
        .then(response => response.json())
        .then(data => {

            if (data["resultado"]) {
                alertImage('EXITO', 'Se registraron las entadas con éxito.', 'success')
                pantallaCarga('off');
            } else {
                alertImage('ERROR', 'Surgió un error en los registros', 'error')
                pantallaCarga('off');
            }

            var sectionCatalogo = document.getElementById('section_catalogo');
            var sectionEntradas = document.getElementById('section_entradas');

            sectionCatalogo.classList.remove('col-md-6');
            sectionEntradas.setAttribute('hidden', 'true');
            var tabla = document.getElementById('tablaEntradas');
            tabla.innerHTML = '';
        });
    }
}

// MODIFICA EL PRODUCTO
function modificarProducto(){

    const formulario  = document.getElementById('frmModificarProducto');
    const formData = new FormData(formulario);

    if(formData.get('nParte') !='' && formData.get('descripcion') !='' && formData.get('precioPublico') !='' && formData.get('precioVenta') !=''){

        pantallaCarga('on');

        const options = {
            method: "POST",
            body: formData,
        };

        fetch("../../productos/php/modificarProductoAJAX.php", options)
        .then(response => response.json())
        .then(data => {

            if (data["resultado"]) {
                $("#miModalEditarProducto").modal('hide');
                alertImage('EXITO', 'Se modificó el producto con éxito.', 'success')
                formulario.reset();
                actualizaCatalogoProductos();
                pantallaCarga('off');

            } else {
                alertImage('ERROR', 'Surgió un error en la modificación', 'error')
                pantallaCarga('off');
            }
        });
    } else {
        alertImage('ERROR', 'Todos los campos deben estar llenos', 'error')
    }
}


function actualizaCatalogoProductosEntradas(){
    var tabla = document.getElementById('tablaCatalogoProductosEntradas');
    var contTabla = '';
    tabla.innerHTML = contTabla;

    var frmFiltros = document.getElementById('frmFiltosCatalogoProdEntradas');
    var numParte = frmFiltros.filtroNParte.value;
    var descripcion = frmFiltros.filtroDescripcion.value;
    var numSerie = frmFiltros.filtroNoSerie.value;
    var checkDetallado = document.getElementById('checkCatalogoEntradasDetallado').checked;

    pantallaCarga('on');
    
    fetch("../../productos/php/traerEntradasAJAX.php?numParte="+numParte+"&descripcion="+descripcion+"&numSerie="+numSerie+"&detallado="+checkDetallado, { method: "GET" })
    .then(response => response.json())
    .then(data => {
        pantallaCarga('off');

        if(data["detallado"] == 1){ 
            document.getElementById('frmFiltosCatalogoProdEntradas').style.display = "block";
            if (data["resultado"] == 1) {
                
                contenidoTabla = '<thead class="sticky-top">'+
                                    '<tr>'+
                                        '<th colspan="5"><div class="cont-btn-tabla"><div data-toggle="tooltip" data-placement="top" title="Exportar a excel" style="background:#00a85a" class="cont-icono-tbl" onclick=\'exportarTablaExcel("tablaCatalogoProductosEntradas", "Catalogo entradas", "Entradas")\'><i class="fa-solid fa-file-excel fa-xl"></i></div></div></th>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<th class="text-center">No. de parte</th>'+
                                        '<th class="text-center">No. serial</th>'+
                                        '<th class="text-center">Descripción</th>'+
                                        '<th class="text-center">Número de entrada</th>'+
                                        '<th class="text-center">Fecha y hora</th>'+
                                    '</tr>'+
                                '</thead>';

                contenidoTabla += '<tbody>';
                
                for (var i = 0; i < data["noDatos"]; i++) {
                
                    var id_entrada = data[i]["id_entrada"];
                    var no_serial = data[i]["no_serial"];
                    var no_parte = data[i]["no_parte"];
                    var descripcion = data[i]["descripcion"];
                    var num_entrada = data[i]["num_entrada"];
                    var fecha_registro = data[i]["fecha_registro"];

                    contenidoTabla += '<tr>';
                        contenidoTabla += '<td class="text-center">'+no_parte+'</td>';
                        contenidoTabla += '<td class="text-center">'+no_serial+'</td>';
                        contenidoTabla += '<td class="text-center">'+descripcion+'</td>';
                        contenidoTabla += '<td class="text-center">Entrada '+num_entrada+'</td>';
                        contenidoTabla += '<td class="text-center">'+fecha_registro+'</td>';
                    contenidoTabla += '</tr>';
                }

                contenidoTabla += '</tbody>';
                tabla.innerHTML = contenidoTabla;
            } 

            if(data["resultado"] == 0) {
                // alertImage('ERROR', 'Surgió un error en el catalogo entradas', 'error')
            }
        } else {
            document.getElementById('frmFiltosCatalogoProdEntradas').style.display = "none";

            if (data["resultado"] == 1) {
                
                contenidoTabla = '<thead class="sticky-top">'+
                                    '<tr>'+
                                        '<th colspan="5"><div class="cont-btn-tabla"><div data-toggle="tooltip" data-placement="top" title="Exportar a excel" style="background:#00a85a" class="cont-icono-tbl" onclick=\'exportarTablaExcel("tablaCatalogoProductosEntradas", "Catalogo entradas", "Entradas")\'><i class="fa-solid fa-file-excel fa-xl"></i></div></div></th>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<th class="text-center">Número de entrada</th>'+
                                        '<th class="text-center">Fecha y hora</th>'+
                                    '</tr>'+
                                '</thead>';

                contenidoTabla += '<tbody>';
                
                for (var i = 0; i < data["noDatos"]; i++) {
                
                    var num_entrada = data[i]["num_entrada"];
                    var fecha_registro = data[i]["fecha_registro"];

                    contenidoTabla += '<tr>';
                        contenidoTabla += '<td class="text-center">Entrada '+num_entrada+'</td>';
                        contenidoTabla += '<td class="text-center">'+fecha_registro+'</td>';
                    contenidoTabla += '</tr>';
                }

                contenidoTabla += '</tbody>';
                tabla.innerHTML = contenidoTabla;
            } 

            if(data["resultado"] == 0) {
                // alertImage('ERROR', 'Surgió un error en el catalogo entradas', 'error')
            }
        }
    });
}

