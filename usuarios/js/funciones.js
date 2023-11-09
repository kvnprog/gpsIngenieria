function abrirSeccion(opcion) {
    
    pantallaCarga('on');

    if (opcion == 1) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'flex';
        document.getElementById("registros").style.display = 'none';
        document.getElementById("permisos").style.display = 'none';
        
        pantallaCarga('off');
    }

    if (opcion == 2) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'none';
        document.getElementById("registros").style.display = 'flex';
        document.getElementById("permisos").style.display = 'none';

        pantallaCarga('off');
    }

    if (opcion == 3) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'none';
        document.getElementById("registros").style.display = 'none';
        document.getElementById("permisos").style.display = 'flex';

        pantallaCarga('off');
    }

}

function eliminarUsuario(id) {
    
    pantallaCarga('on');

    var color = '#FFFFFF';
    var icono = 'warning';
    switch (icono) {
        case 'warning':
            color = "#03B559";
            color2 = "#B50309";
            break;
    }
    swal.fire({
        title: "ATENCION",
        text: "Esta seguro que desea eliminar a este usuario?",
        icon: icono,
        showCancelButton: true,
        confirmButtonText: 'SI',
        confirmButtonColor: color,
        cancelButtonText: 'NO',
        cancelButtonColor: color2,
        allowOutsideClick: false

    }).then((result) => {
        if (result.isConfirmed) {
            const options = {
                method: "GET"
            };


            fetch("../../usuarios/php/eliminarAJAX.php?id=" + id, options)
            .then(response => response.json())
            .then(data => {

                if (data[0]["resultado"] == 1) {

                    alertImage('EXITO', 'Se elimino el usuario con existo', 'success');

                    actualizar(data);

                    pantallaCarga('off');

                } else {

                    alertImage('ERROR', 'Error al tratar eliminar registro', 'error')

                    pantallaCarga('off');
                }

            });
        }

    })

}

function abrirModal(usuarioid, nombre, login, correo) {

    var formulario = document.getElementById("frmModificar");
    formulario.id.value = usuarioid;
    formulario.nombre.value = nombre;
    formulario.login.value = login;
    formulario.correo.value = correo;

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
    fetch("../../usuarios/php/modificarAJAX.php", options)
        .then(response => response.json())
        .then(data => {
            if (data[0]["resultado"] == 0)
                alertImage('ERROR', 'Error en el registro', 'error')
                pantallaCarga('off');

            if (data[0]["resultado"] == 1)
                alertImage('ERROR', 'Nesesita llenar todos los campos', 'error')
                pantallaCarga('off');

            if (data[0]["resultado"] == 2)
                alertImage('EXITO', 'Se modifico el usuario con existo', 'success')
                pantallaCarga('off');

                actualizar(data);


        });

}

function actualizar(data){
    var noDatos = data[0]["noDatos"];
    
    var catalogoUsuarios = document.getElementById("catalogoUsuarios");

    catalogoUsuarios.innerHTML = "";

    catalogoUsuarios.innerHTML = "<thead><tr><th class=\"text-center\" scope=\"col\">Nombre</th><th class=\"text-center\" scope=\"col\">Login</th><th class=\"text-center\" scope=\"col\">Correo</th><th class=\"text-center\" colspan=\"2\" scope=\"col\"></th></tr></thead>";

    var cadenaUsuarios = "<tbody>";
    for (var i = 0; i < noDatos; i++) {

        var idusuario = data[i]["idusuario"];
        var nombreusuario = data[i]["nombreusuario"];
        var passwordusuario = data[i]["passwordusuario"];
        var correo = data[i]["correo"];
        var nombre = data[i]["nombre"];

        cadenaUsuarios = cadenaUsuarios + " <tr><td class=\"text-center\">" + nombre + "</td><td class=\"text-center\">" + nombreusuario + "</td><td class=\"text-center\">" + correo + "</td><td class=\"text-center\"><img src=\"../../src/imagenes/editargps.png\" width=\"50px\" onclick=\"abrirModal(" + idusuario + ",'" + nombre + "','" + nombreusuario + "','" + correo + "')\"></td><td class=\"text-center\"><img src=\"../../src/imagenes/eliminargps.png\" width=\"40px\" onclick=\"eliminarUsuario(" + idusuario + ")\"></td></tr>";



    }

    cadenaUsuarios = cadenaUsuarios + "</tbody>"

    catalogoUsuarios.innerHTML = catalogoUsuarios.innerHTML + cadenaUsuarios;
}

function crearUsuario() {
    
    pantallaCarga('on');
    
    const data = new FormData(document.getElementById('frmRegistroUsuario')); 

    console.log(data);
    const options = {
        method: "POST",
        body: data

    };


    fetch("../../usuarios/php/crearAJAX.php", options)
        .then(response => response.json())
        .then(data => {

            //CHECANDO SI HUBO UN ERROR
            if(data[0]["resultado"] == 2){

                alertImage('EXITO', 'Se registro el cliente con existo', 'success')
                
                actualizar(data);

                pantallaCarga('off');
            }else{

               if(data[0]["resultado"] == 0)alertImage('ERROR', 'Surgio un error al hacer el registro', 'error')

               if(data[0]["resultado"] == 1)alertImage('ERROR', 'El nombre o usuario ya fueron registrados', 'error')
               
               pantallaCarga('off');
            }
           
        })

}

function cargaPermisos(idusuario){
    
    document.getElementById('divSeccionTipoPermiso').innerHTML = "";
    document.getElementById("divSeccionPermiso").innerHTML = "";

    if(idusuario != 0){

        pantallaCarga('on');

        const options = { method: "GET" };
        
        fetch("../../usuarios/php/traerPermisosAJAX.php?idusuario="+idusuario, options)
        .then(response => response.json())
        .then(data => {

            var divSeccionPermiso = document.getElementById("divSeccionPermiso");
            divSeccionPermiso.innerHTML = "";
            var cadenaAreas = "";

            //NUMERO DE AREAS 
            nAreas = data["noDatosAreas"][0]["noDatos"];
    
            cadenaAreas = "<div class='contenedorInputs'>";

            for(var i = 0;i<nAreas;i++){

                cadenaAreas +=   "<div class='contenedorInputs'>"+
                                        "<button class='botonMenuLista' id='"+data["areas"][i]["id"]+"' onclick='verSeccionesDeArea("+idusuario+","+data["areas"][i]["id"]+","+JSON.stringify(data["noDatosSeccion"])+", "+JSON.stringify(data["noDatosAreas"])+", "+JSON.stringify(data["secciones"])+", "+JSON.stringify(data["areas"])+")'>"+                                        
                                            data["areas"][i]["nombre"]+
                                        "</button>"+
                                    "</div>";
            }
            cadenaAreas += "</div>";

            divSeccionPermiso.innerHTML = cadenaAreas;

            pantallaCarga('off');
        })
    }

}
function verSeccionesDeArea(idusuario, idArea, noDatosSeccion, noDatosAreas,secciones, areas){
    
    var numDePermisos = noDatosSeccion[0]["noDatos"];
    var numDeAreas = noDatosAreas[0]["noDatos"];
    var divSeccionTipoPermiso = document.getElementById('divSeccionTipoPermiso');

    var cadenaPermiso = "";

    for(var j = 0 ; j < numDePermisos ; j++){

        if(idArea == secciones[j]["idarea"]){

            if(secciones[j]["permiso"]){
                
                cadenaPermiso +=    "<label class='containerCheck contenedorMargen'>" + 
                                        secciones[j]["nombre"]+
                                        "<input type='checkbox' id='"+secciones[j]["idseccion"]+"' checked='checked' onclick='ponerPermiso(this.id, "+idusuario+")'>" +
                                        "<div class='checkmark'></div>" +
                                    "</label>";
            }else{

                cadenaPermiso +=    "<label class='containerCheck contenedorMargen'>" + 
                                        secciones[j]["nombre"]+
                                        "<input type='checkbox' id='"+secciones[j]["idseccion"]+"' onclick='ponerPermiso(this.id, "+idusuario+")'>" +
                                        "<div class='checkmark'></div>" +
                                    "</label>";
            }                        
        } 

        divSeccionTipoPermiso.innerHTML = cadenaPermiso;
    }
}

function ponerPermiso(idseccion,idusuario){
    
    pantallaCarga('on');
    
    const options = {
        method: "GET"

    };

    fetch("../../usuarios/php/ponerPermisoAJAX.php?idseccion="+idseccion+"&idusuario="+idusuario, options)
    .then(response => response.json())
    .then(data => {

        if(data["resultado"]){
            alertImage('EXITO', 'Se hiso el cambio en el permiso', 'success')
            pantallaCarga('off');
        }else{
            alertImage('EXITO', 'Se hiso el cambio en el permiso', 'success')
            pantallaCarga('off');
        }

    });

}