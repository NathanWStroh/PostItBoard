<?php

include_once '../DatabaseConnections/PostItConnections.php';
include_once '../Models/SCov_PostIt_Obj.php';

//$postItObj = new PostIts();
//$postItObj->setTeam($_POST['']);
//$postItObj->setPartner($_POST['']);
//$postItObj->setIssuedRep($_POST['']);
//$postItObj->setIssues($_POST['']);
//$postItObj->setCurrentNews($_POST['']);
//$postItObj->setAlertStatus($_POST['']);
//$postItObj->setIssuedRep($_POST['']);



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
        $postItObj->setStatus() = 0;
        
        $postItConnection->CreatePostIt($PostItObj);
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
