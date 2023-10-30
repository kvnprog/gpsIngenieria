<?php

// include "../../fGenerales/bd/conexion.php";

function checarLogin($usuario, $password){
  $conexion = new conexion;
  $query = "SELECT idusuario,nombre FROM usuarios WHERE nombreusuario = ? and passwordusuario = md5(?) ";

  $queryPreparada = $conexion->conn->prepare($query);
  $queryPreparada->bind_param('ss', $usuario, $password);
  $queryPreparada->execute();

  $resultados = $queryPreparada->get_result();

  $datos = [];

  if ($resultados->num_rows > 0) {

    session_name('gpsingenieria');
    session_start();

    foreach ($resultados->fetch_all() as $usuario) {
      $datos[0] = true;
      $datos[1] = $usuario[0];
      $datos[2] = $usuario[1];
    }

    $_SESSION['usuarioid'] = $datos[1];
    $_SESSION['nombre'] = $datos[2];

    return $datos;

  } else {

    $datos[0] = false;
    return $datos;

  }
}

function iniciarSession(){
  session_name('gpsingenieria');
  session_start();
}

function checarPermisosSeccion($usuarioid){
  $conexionSeccionesPermisos = new conexion;
  $query = "SELECT*FROM permisossecciones where idusuario = " . $usuarioid;

  $datos = $conexionSeccionesPermisos->conn->query($query);

  return $datos;
}

function pintarHead($titulo){
  echo "<meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        
        <link rel='shortcut icon' href='../../src/imagenes/logo.png'>
        <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' />
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65' crossorigin='anonymous'>
        <link href='../../fGenerales/css/style.css' rel='stylesheet' />
        <link href='../css/style.css' rel='stylesheet' />
        <link href='../../src/fontawesome-free-6.4.2-web/css/fontawesome.css' rel='stylesheet'>
        <link href='../../src/fontawesome-free-6.4.2-web/css/brands.css' rel='stylesheet'>
        <link href='../../src/fontawesome-free-6.4.2-web/css/solid.css' rel='stylesheet'>
        
        <script src='../js/funciones.js'></script>
        <script src='../../fGenerales/js/funciones.js'></script>
        <script src='../../fGenerales/js/alerts.js'></script>
        <script src='../../fGenerales/js/jquery.js'></script>";

  echo "<title>GpsIngeniería-".$titulo."</title>";
}

function pintarEncabezado($titulo,$img){
  if($titulo=='' && $img==''){
    echo "<div class='row'>
            <div class='col-3 justify-content-center align-items-center'>
              <img class='imgregreso' src='../../src/imagenes/backgps.svg' onclick='regreso()'/>
            </div>
            
            <div class='col-6 divLogo justify-content-center align-items-center'>
              <img class='imgLogo' src='../../src/imagenes/logo.png'/>
            </div>
            <div class='col-3'></div>
          </div>";
  } else {
    echo "<div class='row'>
            <!-- BOTON DE IR ATRAS -->
            <div class='col-3 justify-content-center align-items-center'>
              <img class='imgregreso' src='../../src/imagenes/backgps.svg' onclick='regreso()'/>
            </div>

            <!-- TITULO DEL MODULO -->
            <div class='col-6  text-center  txtTitulo'>
              <span><i class='aTitulo'>".$titulo."</i><img class='imgIconoUsuarios' src='../../src/imagenes/".$img."' width='50px'></span>
            </div>

            <!-- LOGO DE LA EMPRESA -->
            <div class='col-3 divLogo justify-content-center align-items-center'>
              <img class='imgLogo' src='../../src/imagenes/logo.png'/>
            </div>         
          </div>";
  }

}

function pintarFooter(){
  echo "
          <footer class='footer-distributed fixed-bottom'>
            <div class='contenedorFlecha'><div class='flecha'></div></div>
            <div class='footer-left'>
              <h3><img src='../../src/imagenes/logo.jpg' width='100px'></h3>
              <p class='footer-links'>
                <a href='../../menuPrincipal/php/menuPrincipal.php' class='link-1'>Inicio</a>
                <a href='#'>Blog</a>
                <a href='#acercaDe'>Acerca de</a>
                <a href='#contacto'>Contacto</a>
              </p>

              <p class='footer-company-name'>GPSIngeniería © 2023</p>
            </div>

            <div class='footer-center' id='contacto'>
              <div>
                <i class='fa fa-map-marker'></i>
                <p><span>Calle #</span> Irapuato,Gto.</p>
              </div>

              <div>
                <i class='fa fa-phone'></i>
                <p>462 000 00 00</p>
              </div>
  
              <div>
                <i class='fa fa-envelope'></i>
                <p><a href='mailto:correo@gpsing.com'>correo@gpsing.com</a></p>
              </div>
            </div>
  
            <div class='footer-right' id='acercaDe'>
              <p class='footer-company-about'>
                <span>Acerca de la compañía</span>
                Ejemplo de información de la empresa tal y más información al respecto, etc.
              </p>
  
              <div class='footer-icons'>
                <a href='#'><i class='fa fa-facebook'></i></a>
                <a href='#'><i class='fa fa-twitter'></i></a>
                <a href='#'><i class='fa fa-whatsapp'></i></a>
              </div>
            </div>
          </footer>";
}

function pantallaCarga($vis){
  if($vis=='on'){
    $visibilidad = 'display:flex;';
  } else {
    $visibilidad = 'display:none;';
  }
  echo "<div id='pantallaCarga' class='dots' style='--size: 200px; --dot-size: 15px; --dot-count: 6; --color: #ffffff; --speed: 1s; --spread: 60deg; ".$visibilidad." '>
          <div class='fondoDot'></div>
          <div style='--i: 0;' class='dot'></div>
          <div style='--i: 1;' class='dot'></div>
          <div style='--i: 2;' class='dot'></div>
          <div style='--i: 3;' class='dot'></div>
          <div style='--i: 4;' class='dot'></div>
          <div style='--i: 5;' class='dot'></div>
        </div>";
}