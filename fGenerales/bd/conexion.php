<?php


class conexion{

    public $conn;
    


    function __construct(){
        $this->conn = new mysqli("localhost","mysql","","gpsingenieria",3306);
    }


public function checar(){
 
    if ($this->conn->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $this->conn->connect_errno . ") " . $this->conn->connect_error;
        
    }else{
        echo $this->conn->host_info . "\nsoy yo";
    }
    
}


}





