<?php

// include "../../fGenerales/bd/conexion.php";

function checarLogin($usuario,$password){




    $conexion = new conexion;
    
    $query = "SELECT idusuario,nombre FROM usuarios WHERE nombreusuario = ? and passwordusuario = md5(?) ";
    
    $queryPreparada = $conexion->conn->prepare($query);
    
    $queryPreparada->bind_param('ss',$usuario,$password);
    
    
     $queryPreparada->execute();
    
     $resultados = $queryPreparada->get_result();

     $datos = [];
    
     if($resultados->num_rows>0){

      session_name('gpsingenieria');

      session_start();

     

      foreach($resultados->fetch_all() as $usuario){
          $datos[0] = true;
          $datos[1] = $usuario[0];
          $datos[2] = $usuario[1];
      }

      $_SESSION['usuarioid'] = $datos[1] ;
      $_SESSION['nombre'] = $datos[2] ;

       return $datos;
     }else{

      $datos[0]=false;
        return $datos;
     }
    
    


}

function iniciarSession(){

  session_name('gpsingenieria');

  session_start();


}

function checarPermisosSeccion($usuarioid){



  $conexionSeccionesPermisos = new conexion;
  $query = "SELECT*FROM permisossecciones where idusuario = ".$usuarioid;

  $datos = $conexionSeccionesPermisos->conn->query($query);


  return $datos;

}