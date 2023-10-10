function abrirSeccion(opcion) {
    
    pantallaCarga('on');
    
    if (opcion == 1) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'flex';

        pantallaCarga('off');
    }

}

function modalResponsiva(){
    
    const checkboxes = document.querySelectorAll('#catalogoProductos input[type="checkbox"]');
    const registrosSeleccionados = Array.from(checkboxes)
    
    .filter(checkbox => checkbox.checked)
    .map(checkbox => checkbox.value);
    
    if(registrosSeleccionados != "" || registrosSeleccionados.length > 0){

        pantallaCarga('on');

        const options = { method: "GET" };
        const variables = "?arrRegSeleccionados="+JSON.stringify(registrosSeleccionados);
        const url = "../php/AJAX/traeProductosAJAX.php"+variables;

        fetch(url, options)
        .then(response => response.json())
        .then(data => {

            pantallaCarga('off');
            // console.log(data);

            if(data['bandera'] == 0){
                alertImage('Error','Ocurrió un error, inténtalo más tarde.','error');
            }
            if(data['bandera'] == 1){
                
                var tablaProdSel = document.getElementById('tablaProdSel');
                var conTabla = "<tr></tr>";
                
                conTabla = "<thead><tr class='sticky-top text-center'><th>#</th><th>Numero de parte</th><th>Descripción</th><th>Existentes</th><th>Precio por unidad</th><th>Nombre</th><th>Cantidad</th></tr></thead>";

                for(puntero = 0 ; puntero < data['array'].length ; puntero++){
                    var indice = puntero+1;
                    conTabla += "<thead>";
                        conTabla += "<tr class='text-center'>";
                            conTabla += "<td>"+indice+"</td>";
                            conTabla += "<td>"+data['numParte'][puntero]+"</td>";
                            conTabla += "<td>"+data['descripcion'][puntero]+"</td>";
                            conTabla += "<td>"+data['existentes'][puntero]+"</td>";
                            conTabla += "<td>"+data['precioxunidad'][puntero]+"</td>";
                            conTabla += "<td>"+data['nombre'][puntero]+"</td>";
                            conTabla += "<td><div class='form-floating mb-3'><input onkeyup='validarInput(this, "+data['existentes'][puntero]+")' type='number' class='form-control' id='"+data['array'][puntero]+"' name='cantidad' placeholder='Ingrese la cantidad'><label>Cantidad</label></div></td>";
                        conTabla += "</tr>";
                    conTabla += "</thead>";
                }
                
                tablaProdSel.innerHTML = conTabla;

                $("#modalResponsiva").modal('show');   
                
            } 
        });
        
    } else {
        alertImage('Error','Debe seleccionar al menos un producto para generar la responsiva','error');
    }
    
}

function generarResponsiva(){

    var inputs = document.querySelectorAll("#tablaProdSel .form-control");

    var todosValidos = true;
    var valores = new Array;
    var ids = new Array;

    for (var i = 0; i < inputs.length; i++) {

        var valor = inputs[i].value.trim();
        var valorid = inputs[i];
        
        if (valor === "") {
            todosValidos = false;
            break;
        } else {
            valores[i] = valor;
            ids[i] = valorid.id;
        }
    }

    if (todosValidos) {

        const variables = "?arrayId="+ids+"&arrayValores="+valores;
        const url = "../php/AJAX/formatoResponsiva.php"+variables;

        window.open(url, "_blank");

    } else {
        alertImage('Error','Ingrese las cantidades faltantes, al menos un campo esta vació','error');
    }

}

function validarInput(input, max) {
    var min = 1;
    
    valor = input.value.trim();

    if (!isNaN(valor)) {
        var numero = parseInt(valor);

        if (numero >= min && numero <= max) {
            return true;
        } else {
            input.value = valor.substring(0, 0);
        }
    } else {
        input.value = valor.substring(0, 0);
        return false;
    }
}