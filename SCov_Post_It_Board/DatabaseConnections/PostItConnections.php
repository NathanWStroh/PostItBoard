<?php
require 'DBConnection.php';

class PostItConnections {
    private $mySQLquery;
    private $pdo;
    
    public function __construct($database){
        $this->pdo= $database;
    }
    
    function GetPostIts(){
        $host = 'localhost';
        $dbname='scov_post_it';
        $user='root';
        $pass='root';
        
        $database = new Database($host,$dbname,$user,$pass);
        
        $sql = 'Select * from post_its';
        
        $statment = $this->pdo->prepare($sql);
        $postIts= $statment->fetchAll();
        
        return $postIts;
    }
            
    function UpdatePostIt($PostItObj){
        
    }
    
    function CreatePostIt($PostItObj){
        
    }
}
