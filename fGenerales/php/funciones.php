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

function pintarNavBar(){

  echo " <div class=\"row\">
  <div class=\"col-3 justify-content-center align-items-center\">
      <img class=\"imgregreso\" src=\"../../src/imagenes/back.svg\" onclick=\"regreso()\" />
  </div>";
  echo "<div class=\"col-6 divLogo justify-content-center align-items-center \">
      <img class=\"imgLogo\" src=\"../../src/imagenes/logo.png\" />
  </div>";
  echo "<div class=\"col-3\"></div>";

  echo "</div>";

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
    
    <script src='../js/funciones.js'></script>
    <script src='../../fGenerales/js/funciones.js'></script>
    <script src='../../fGenerales/js/alerts.js'></script>
    <script src='../../fGenerales/js/jquery.js'></script>";

  echo "<title>GpsIngeniería-".$titulo."</title>";

}