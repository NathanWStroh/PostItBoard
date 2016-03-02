
<?php
//require_once '../DatabaseConnections/PostItConnections.php';
require (dirname('__FILE__')) . '/DatabaseConnections/DBConnection.php';
//require '../Models/SCov_PostIt_Obj.php';

class Post_It {
    
    function GrabPostItsFromDB(){
//        $postItObj = new SCov_PostIt_Obj();
//        $postItArray = []  ;      
//        $getPostIts = new PostItConnections();
        
//        $postItArray = $getPostIts->GetPostIts();
        
        $CONN = new DBConnection();
        $CONN->dbconnect('root', 'root');
        
//        return $postItArray;
    }
    
    
}
