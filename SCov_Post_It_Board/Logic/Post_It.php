<?php

include_once '../DatabaseConnections/PostItConnections.php';
include_once '../Models/SCov_PostIt_Obj.php';

class Post_It {

    function GrabPostIts() {
        $postItConnection = new PostItConnections();
        $postItArray = $postItConnection->GetPostIts();
        
        return $postItArray;
    }

    function GrabPostItsByUserId($userID) {
        $postItConnection = new PostItConnections();
        $postItArray = $postItConnection->GetPostItsByUserID($userID);

        return $postItArray;
    }

    function FilterPostIts($fromDate, $toDate) {
        $connection = new PostItConnections();
        $postItArray = $connection->GetPostItsWithFilter($fromDate, $toDate);

        return $postItArray;
    }

    function UpdatePostIts($postItObj) {
        $postItConnections = new PostItConnections();

        $postItConnections->UpdatePostIt($postItObj);
    }

    function CreatePostIts($postItObj) {
        $postItConnection = new PostItConnections();

        $postItConnection->CreatePostIt($postItObj);
    }

    function GetTargetPostIt($postItID) {
        $postItConnection = new PostItConnections();
        $postItObj = new PostIts();

        $postItObj = $postItConnection->GetTicket($postItID);

        return $postItObj;
    }

    function DeletePostIt($postItID) {
        $postItConnection = new PostItConnections();

        $postItConnection->DeletePostIt($postItID);
    }

}
