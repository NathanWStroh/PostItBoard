<?php

include_once '../DatabaseConnections/PostItConnections.php';
include_once '../Models/SCov_PostIt_Obj.php';

class Post_It {

    function GrabPostIts() {
        $postItConnection = new PostItConnections();
        $postItArray = $postItConnection->GetPostIts();
        
        return $postItArray;
    }

    function UpdatePostIts($postItObj) {
       $postItConnections = new PostItConnections();
       $postItConnections->UpdatePostIt($PostItObj);
    }

    function CreatePostIts($postItObj) {
        $postItConnection = new PostItConnections();
        
        $postItConnection->CreatePostIt($postItObj);
    }

    function ComparePostItsForTableUpdate($currentPostItsList) {
        $postItConnections = new PostItConnections();

        $databasePostItList = $postItConnections->GetPostIts();

        if ($databasePostItList != $currentPostItsList) {
            echo '<script>$(#PostItTable tr).detach(); </script>';

            $this->GrabPostIts();
        }
    }

}
