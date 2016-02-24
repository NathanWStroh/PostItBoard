<?php

class DBConnection {
    
    //this function will need to be updated to allow for proper db connection on live server.
    function AccessDatabase(){
        $servername = "localhost";
        $username = "root";
        $password = "root";
        
        try{
        //create connection
        $connection = new mysqli($servername,$username,$password);
        echo "connection successful";
        
        
        }catch(PDOException $e){
            echo "Connection failed: " .$e->getMessage();
        }
  
    }
}
