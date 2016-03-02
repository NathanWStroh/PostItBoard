<?php
require 'DBConnection.php';

class PostItConnections {
    private $mySQLquery;
    private $user= 'root';
    private $pass= 'root';
    
    function GetPostIts(){
             $user= 'root';
     $pass= 'root';
        $dbconn = new DBConnection();
        
        $dbconn->dbconnect($user, $pass);
        
//        return $postIts;
    }
            
    function UpdatePostIt($PostItObj){
        
    }
    
    function CreatePostIt($PostItObj){
        
    }
}
