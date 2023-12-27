<?php


class conexion{

    public $conn;
    


    function __construct(){
        //local
        $this->conn = new mysqli("localhost","u798288314_admin","Contrasen@2023","u798288314_gpsingenieria",3306);
        //pruebas
        //$this->conn = new mysqli("185.27.134.10","if0_34641860","","if0_34641860_gpsingenieria",3306);
    }


public function checar(){
 
    if ($this->conn->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $this->conn->connect_errno . ") " . $this->conn->connect_error;
        
    }else{
        echo $this->conn->host_info . "\nsoy yo";
    }
    
}


}





