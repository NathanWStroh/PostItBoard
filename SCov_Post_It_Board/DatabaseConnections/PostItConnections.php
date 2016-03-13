<?php

include_once 'DBConnection.php';
include_once '../Models/SCov_PostIt_Obj.php';

class PostItConnections {

    function GetPostIts() {
        $query = 'CALL GET_POST_ITS();';
        $postItsList = array();

        $connection = new DBConnection();

        $dbconnection = $connection->dbconnect();
        try {
            $postIts = $dbconnection->query($query);
            if ($postIts->num_rows > 0) {
                while ($rows = $postIts->fetch_assoc()) {

                    $postItObj = new PostIts();

                    $postItObj->setPostItID($rows["post_it_ID"]);
                    $postItObj->setTeam($rows["TEAM_ID"]);
                    $postItObj->setPartner($rows["partner"]);
                    $postItObj->setIssuedRep($rows["rep"]);
                    $postItObj->setEntryDate($rows["entry_date"]);
                    $postItObj->setIssues($rows["issue"]);
                    $postItObj->setCloseDate($rows["close_date"]);
                    $postItObj->setStatus($rows["STATE"]);
                    $postItObj->setAlertStatus($rows["alert_status"]);
                    $postItObj->setCurrentNews($rows["news"]);

                    array_push($postItsList, $postItObj);
                }
                $dbconnection->close();
                return $postItsList;
            } else {
                echo 'Error retreiving post-its: ' . $dbconnection->connect_error;
            }
        } catch (Exception $ex) {
            echo "Error has occured with Query: " . $ex->getMessage();
        }
    }

    //Just needs to have logic to check for difference and update the rows. 
    function UpdatePostIt($postItObj) {
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

    function CreatePostIt($postItObj) {
$query = "INSERT INTO post_its (TEAM_ID,partner,issue,news,rep,STATE,alert_status) VALUES ("
        . $postItObj->getTeam(). ","
        ."'".$postItObj->getPartner()."',"
        ."'". $postItObj->getIssues()."',"
        ."'".$postItObj->getCurrentNews()."',"
        ."'".$postItObj->getIssuedRep()."',"
        . $postItObj->getStatus().","
        . $postItObj->getAlertStatus().")";
//        
//        $query = "CALL CREATE_NEW_POST_IT ('"
//                . $postItObj->getTeam() . "','"
//                . $postItObj->getPartner() . "','"
//                . $postItObj->getIssues() . "','"
//                . $postItObj->getIssuedRep() . "',"
//                . $postItObj->getStatus() . "',"
//                . $postItObj->getCurrentNews() . ");";

        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();

        try{
            echo '<p>Have made it to the try catch.</p>';
            
            if( $dbconnection->query($query)===TRUE){
                echo '<p>Ticket has been added.</p>';
            }else{
                echo '<p>An issue occured running the query: '.$dbconnection->error.'</p>';
            }
            
            
            $dbconnection->close();
        } catch (Exception $ex) {
            echo "ERROR! A problem occured saving post it: ".$ex->getMessage();
        }
        
        
    }

}
