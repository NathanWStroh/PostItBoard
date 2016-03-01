<?php
require '../DatabaseConnections/PostItConnections.php';
require '../Models/SCov_PostIt_Obj.php';

class Post_It {
    
    function GrabPostItsFromDB(){
        $postItObj = new SCov_PostIt_Obj();
        $postItArray = [];        
        $getPostIts = new PostItConnections();
        
        $postItArray = $getPostIts->GetPostIts();
        
        return $postItArray;
    }
    
    
}
