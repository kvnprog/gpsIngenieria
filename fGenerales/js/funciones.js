// REGRESA HACIA ATRAS
function regreso(){
    window.history.back();
}

// VISIBILIDAD DE PANTALLA DE CARGA
function pantallaCarga(visibilidad){
    if(visibilidad == 'on'){
        document.getElementById('pantallaCarga').style.display='flex'
    } else {
        document.getElementById('pantallaCarga').style.display='none'
    }
}

// ACEPTA SOLO ENTEROS Y DECIMALES
function aceptaNumeros(input) {
    var regex = /^[0-9]+(\.[0-9]+)?$/;
    
    if (regex.test(input.value)) {
        
    } else {
        input.value = "";
    }
}

// ACEPTA SOLO LETRAS
function aceptaLetras(input) {
    var regex = /^[a-zA-Z\s]+$/;
    
    if (regex.test(input.value)) {
        
    } else {
        input.value = "";
    }
}

// EXPORTAR A EXCEL
function exportarTablaExcel(table, nombreDeHoja, nombreArchivo) {
    var uri = 'data:application/vnd.ms-excel;base64,';
    var template =
        '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><style>td { font-size: 11pt; text-align: center; vertical-align: middle; border: 0.5px solid #000000; }</style><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>';
    var base64 = function(s) {
        return window.btoa(unescape(encodeURIComponent(s)));
    };
    var format = function(s, c) {
        return s.replace(/{(\w+)}/g, function(m, p) {
            return c[p];
        });
    };

    if (!table.nodeType) table = document.getElementById(table);
    var ctx = {worksheet: nombreDeHoja || 'Worksheet', table: table.innerHTML};

    //CAMBIAR IMAGENES A CELDAS VACIAS
    var images = table.querySelectorAll('img');
    for (var i = 0; i < images.length; i++) {
        var img = images[i];
        ctx.table = ctx.table.replace(img.outerHTML, ''); 
    }

    // ESTILO A LAS CELDAS
    ctx.table = ctx.table.replace(/<td/g, '<td style="font-size: 12pt; background-color: #f0f0f0; color: #000000; text-align: center; vertical-align: middle; border: 0.5px solid #000000;"');
    ctx.table = ctx.table.replace(/<th/g, '<th style="font-size: 11pt; background-color: #414141; color: #ffffff; text-align: center; vertical-align: middle; border: 0.5px solid #000000;"');

    // ENLACE DE DESCARGA CON NOMBRE
    var link = document.createElement('a');
    link.href = uri + base64(format(template, ctx));
    link.download = nombreArchivo || 'DOCUMENTO.xls';
    link.click();
}