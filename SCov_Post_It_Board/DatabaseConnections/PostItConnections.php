<?php

include_once 'DBConnection.php';
include_once '../Models/SCov_PostIt_Obj.php';

class PostItConnections {

    function GetPostIts() {
        $user = 'root';
        $pass = 'root';
        $query = 'CALL GET_POST_ITS();';
        $postItObj = new PostIts();
        $postItsList = array();

        $connection = new DBConnection();

        $dbconnection = $connection->dbconnect($user, $pass);
        try {
            $postIts = $dbconnection->query($query);
            if ($postIts->num_rows > 0) {
                while ($rows = $postIts->fetch_assoc()) {
                    $postItObj->setPostItID($rows["id"]);
                    $postItObj->setTeam($rows["team_id"]);
                    $postItObj->setPartner($rows["partner"]);
                    $postItObj->setIssuedRep($rows["rep"]);
                    $postItObj->setEntryDate($rows["entry_date"]);
                    $postItObj->setIssues($rows["issue"]);
                    $postItObj->setCloseDate($rows["closure_date"]);
                    $postItObj->setStatus($rows["state"]);

                    array_push($postItsList, $postItObj);
                }

                return $postItsList;
            } else {
                echo 'Error retreiving post-its: ' . $dbconnection->connect_error;
            }
        } catch (Exception $ex) {
            echo "Error has occured with Query: " . $ex->getMessage();
        }

        $dbconnection->close();
    }
    
    //Just needs to have logic to check for difference and update the rows. 
    function UpdatePostIt($PostItObj) {
//        $selectionQuery = 'SELECT * FROM post_its where id = ' . $PostItObj->getPostItID;
//        $query = 'UPDATE post_its SET';
//
//        $connection = new DBConnection();
//
//        $dbconnection = $connection->dbconnect();
//
//        try {
//            $OldPostIt = $dbconnection->query($selectionQuery);
//           
//        } catch (Exception $ex) {
//            echo "Error has occured with Update query: " . $ex->getMessage();
//        }
//
//        $dbconnection->close();
    }

    function CreatePostIt($PostItObj) {
        
        $query = "CALL CREATE_NEW_POST_IT ('"
                . $PostItObj->getTeam() . "','"
                . $PostItObj->getPartner() . "','"
                . $PostItObj->getEntryDate() . "','"
                . $PostItObj->getIssues() . "','"
                . $PostItObj->getIssuedRep() . "',"
                . $PostItObj->getStatus() . "',"
                . $PostItObj->getCurrentNews().");";

        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();

        $dbconnection->close();
    }

}
