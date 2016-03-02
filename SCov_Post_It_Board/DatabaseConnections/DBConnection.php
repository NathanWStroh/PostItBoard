<?php

class DBConnection {

    //this function will need to be updated to allow for proper db connection on live server.
    public function dbconnect($user, $pass) {
        $servername = 'localhost';
        $database = 'scov_post_it';
        
        try {
            $connection = new mysqli($servername,$user,$pass,$database);
            $TestSQL = "Insert into post_its Values (0,2,'GRM','2038-01-19','No internet',1,1,null)";
            
            if($connection->connect_error){
                die("Connection failed: " . $connection->connect_error);
            }else {
                echo 'seems to be working???';
            }
            if($connection->query($TestSQL)===TRUE){
               echo 'Record Added'; 
            } else {
                echo 'ERROR: ' . $TestSQL ."<br>" . $connection->error;
            }
            
            
            $connection->close();
            
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}
