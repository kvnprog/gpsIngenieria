function abrirSeccion(opcion) {

    if (opcion == 1) {


        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'flex';
        document.getElementById("registros").style.display = 'none';
        document.getElementById("permisos").style.display = 'none';
    }

    if (opcion == 2) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'none';
        document.getElementById("registros").style.display = 'flex';
        document.getElementById("permisos").style.display = 'none';


    }

    if (opcion == 3) {

        //MOVIENDO LA VISIBILIDAD
        document.getElementById("catalogo").style.display = 'none';
        document.getElementById("registros").style.display = 'none';
        document.getElementById("permisos").style.display = 'flex';


    }

}

function eliminarUsuario(id) {

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

                        alertImage('EXITO', 'Se elimino el usuario con existo', 'success')

                        actualizar(data);

                    } else {

                        alertImage('ERROR', 'Error al tratar eliminar registro', 'error')

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

            if (data[0]["resultado"] == 1)
                alertImage('ERROR', 'Nesesita llenar todos los campos', 'error')

            if (data[0]["resultado"] == 2)
                alertImage('EXITO', 'Se modifico el usuario con existo', 'success')

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

                alertImage('EXITO', 'Se registro el usuario con existo', 'success')
                
                actualizar(data);

            }else{

               if(data[0]["resultado"] == 0)alertImage('ERROR', 'Surgio un error al hacer el registro', 'error')

               if(data[0]["resultado"] == 1)alertImage('ERROR', 'El nombre o usuario ya fueron registrados', 'error')
            }
           
        })

}

function cargaPermisos(idusuario){

    const options = {
        method: "GET"

    };

    fetch("../../usuarios/php/traerPermisosAJAX.php?idusuario="+idusuario, options)
    .then(response => response.json())
    .then(data => {


       
    })

}