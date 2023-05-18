<?php 


function checarLogin($usuario,$password){

  

    include "../../fGenerales/bd/conexion.php";
    
    
    
    $conexion = new conexion;
    
    $query = "SELECT*FROM usuarios WHERE nombreusuario = ? and passwordusuario = md5(?) ";
    
    $queryPreparada = $conexion->conn->prepare($query);
    
    $queryPreparada->bind_param('ss',$usuario,$password);
    
    
     $queryPreparada->execute();
    
     $resultados = $queryPreparada->get_result();
    
     if($resultados->num_rows>0){
       return true;
     }else{
        return false;
     }
    
    


}