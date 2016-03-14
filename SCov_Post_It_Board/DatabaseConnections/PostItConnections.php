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

    function GetTicket($teamID) {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'SELECT * FROM scov_post_it.post_its WHERE post_it_ID =' . $teamID . ';';
        $postItObj = new PostIts();

        try {
            $postIt = $dbconnection->query($query);

            if ($postIt->num_rows === 1) {
                while ($rows = $postIt->fetch_assoc()) {

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
                }
                $dbconnection->close();
                return $postItObj;
            } else {
                echo 'Error retreiving post-its: ' . $dbconnection->connect_error;
            }
        } catch (Exception $ex) {
            echo "Error has occured with Query: " . $ex->getMessage();
        }
    }

    //Just needs to have logic to check for difference and update the rows. 
    function UpdatePostIt($postItObj) {
        $query = "UPDATE scov_post_it.post_its SET team_id =" . $postItObj->getTeam() . ","
                . "partner='" . $postItObj->getPartner() . "',"
                . "issue= '" . $postItObj->getIssues() . "',"
                . "news= '" . $postItObj->getCurrentNews() . "',";

        $connection = new DBConnection();

        $dbconnection = $connection->dbconnect();

        try {
            if ($postItObj->getStatus() == 1) {
                $query = $query . "state=" . $postItObj->getStatus() . ",";
                $query = $query . "alert_status=0 ";
            }
            $query = $query . "where post_it_ID =" . $postItObj->getPostItID() . ";";
            $result = $dbconnection->query($query);
        } catch (Exception $ex) {
            echo "Error has occured with Update query: " . $ex->getMessage();
        }

        $dbconnection->close();
    }

    function CreatePostIt($postItObj) {
        $query = "INSERT INTO post_its (TEAM_ID,partner,issue,news,rep,STATE,alert_status) VALUES ("
                . $postItObj->getTeam() . ","
                . "'" . $postItObj->getPartner() . "',"
                . "'" . $postItObj->getIssues() . "',"
                . "'" . $postItObj->getCurrentNews() . "',"
                . "'" . $postItObj->getIssuedRep() . "',"
                . $postItObj->getStatus() . ","
                . $postItObj->getAlertStatus() . ")";

        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();

        try {

            $dbconnection->query($query);
            $dbconnection->close();
        } catch (Exception $ex) {
            echo "ERROR! A problem occured saving post it: " . $ex->getMessage();
        }
    }

}
