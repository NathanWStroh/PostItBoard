<?php

class DBConnection {
    
    //this function will need to be updated to allow for proper db connection on live server.
    public function __construct($host,$dbname,$user,$pass){

        try{
        $this->pdo= new PDO("localhost", $user, $pass);
        
        }catch(PDOException $e){
            echo "Connection failed: " .$e->getMessage();
        }
  
    }
}
