<?php

include_once 'DBConnection.php';
include_once '../Models/SCov_PostIt_Obj.php';

class PostItConnections {

    function GetPostIts() {
        $query = 'SELECT pi.post_it_id, t.team, p.queue_name,pi.issue,pi.news,u.a_username,pi.state,pi.alert_status,pi.entry_date,pi.close_date, u2.a_username as updated_rep, u3.a_username as closed_rep '
                . 'FROM scov_post_it.post_its pi  '
                . 'INNER JOIN scov_post_it.partners p on pi.partner_id = p.id '
                . 'INNER JOIN scov_post_it.team t on pi.team_id = t.team_id '
                . 'INNER JOIN scov_post_it.users u on pi.user_id = u.a_id '
                . 'left JOIN scov_post_it.users u2 on pi.updated_rep = u2.a_id '
                . 'left JOIN scov_post_it.users u3 on pi.closed_rep = u3.a_id; ';
        $postItsList = array();

        $connection = new DBConnection();

        $dbconnection = $connection->dbconnect();
        try {
            $postIts = $dbconnection->query($query);
            if ($postIts->num_rows > 0) {
                while ($row = $postIts->fetch_assoc()) {
                    
                    //display datat to table
                    $postItObj = new PostIts();
                    $postItObj->setPostItID($row["post_it_id"]);
                    $postItObj->setTeam($row["team"]);
                    $postItObj->setPartner($row["queue_name"]);
                    $postItObj->setIssuedRep($row["a_username"]);
                    $postItObj->setEntryDate(date('m/d/y g:i a', strtotime($row["entry_date"])));
                    $postItObj->setIssues($row["issue"]);
                    if ($row["close_date"] == '' || is_null($row["close_date"])) {
                        $postItObj->setCloseDate($row["close_date"]);
                    } else {
                        $postItObj->setCloseDate(date('m/d/y g:i a', strtotime($row["close_date"])));
                    }
                    $postItObj->setStatus($row["state"]);
                    $postItObj->setAlertStatus($row["alert_status"]);
                    $postItObj->setCurrentNews($row["news"]);
                    $postItObj->setUpdatedRep($row["updated_rep"]);
                    $postItObj->setClosedRep($row["closed_rep"]);

                    array_push($postItsList, $postItObj);
                }
                $dbconnection->close();
                
                return $postItsList;
            } else {
                echo '<p style="color:red;">Error retreiving post-its: ' . $dbconnection->connect_error . '</p>';
            }
        } catch (Exception $ex) {
            echo '<p style="color:red;"> Error has occured with Query:' . $ex->getMessage() . '</p>';
        }
    }

    function GetPostItsByUserID($userID) {
        $query = 'SELECT pi.post_it_id, t.team, p.queue_name,pi.issue,pi.news,u.a_username,pi.state,pi.alert_status,pi.entry_date,pi.close_date, u2.a_username as updated_rep, u3.a_username as closed_rep '
                . 'FROM scov_post_it.post_its pi  '
                . 'INNER JOIN scov_post_it.partners p on pi.partner_id = p.id '
                . 'INNER JOIN scov_post_it.team t on pi.team_id = t.team_id '
                . 'INNER JOIN scov_post_it.users u on pi.user_id = u.a_id '
                . 'left JOIN scov_post_it.users u2 on pi.updated_rep = u2.a_id '
                . 'left JOIN scov_post_it.users u3 on pi.closed_rep = u3.a_id '
                . 'WHERE p.id NOT IN ( SELECT partner_id from scov_post_it.rep_partner_settings where visible = 0 and a_id =' . $userID . ');';

        $postItsList = array();

        $connection = new DBConnection();

        $dbconnection = $connection->dbconnect();
        try {
            $postIts = $dbconnection->query($query);
            if ($postIts->num_rows > 0) {
                while ($row = $postIts->fetch_assoc()) {

                    $postItObj = new PostIts();

                    $postItObj->setPostItID($row["post_it_id"]);
                    $postItObj->setTeam($row["team"]);
                    $postItObj->setPartner($row["queue_name"]);
                    $postItObj->setIssuedRep($row["a_username"]);
                    $postItObj->setEntryDate(date('m/d/y g:i a', strtotime($row["entry_date"])));
                    $postItObj->setIssues($row["issue"]);
                    if ($row["close_date"] == '' || is_null($row["close_date"])) {
                        $postItObj->setCloseDate($row["close_date"]);
                    } else {
                        $postItObj->setCloseDate(date('m/d/y g:i a', strtotime($row["close_date"])));
                    }
                    $postItObj->setStatus($row["state"]);
                    $postItObj->setAlertStatus($row["alert_status"]);
                    $postItObj->setCurrentNews($row["news"]);
                    $postItObj->setUpdatedRep($row["updated_rep"]);
                    $postItObj->setClosedRep($row["closed_rep"]);

                    array_push($postItsList, $postItObj);
                }
                $dbconnection->close();
                return $postItsList;
            } else {
                echo '<p style="color:red;">Error retreiving post-its: ' . $dbconnection->connect_error . '</p>';
            }
        } catch (Exception $ex) {
            echo '<p style="color:red;"> Error has occured with Query:' . $ex->getMessage() . '</p>';
        }
    }

    function GetPostItsWithFilter($fromDate, $toDate) {

        $query = 'SELECT pi.post_it_id, t.team, p.queue_name,pi.issue,pi.news,u.a_username,pi.state,pi.alert_status,pi.entry_date,pi.close_date, u2.a_username as updated_rep, u3.a_username as closed_rep '
                . 'FROM scov_post_it.post_its pi  '
                . 'INNER JOIN scov_post_it.partners p on pi.partner_id = p.id '
                . 'INNER JOIN scov_post_it.team t on pi.team_id = t.team_id '
                . 'INNER JOIN scov_post_it.users u on pi.user_id = u.a_id '
                . 'left JOIN scov_post_it.users u2 on pi.updated_rep = u2.a_id '
                . 'left JOIN scov_post_it.users u3 on pi.closed_rep = u3.a_id '
                . 'WHERE CAST(pi.entry_date AS DATE) >="' . $fromDate . '" AND CAST(pi.entry_date AS DATE) <="' . $toDate . '";';

        $postItsList = array();

        $connection = new DBConnection();

        $dbconnection = $connection->dbconnect();
        try {
            $postIts = $dbconnection->query($query);
            if ($postIts->num_rows > 0) {
                while ($row = $postIts->fetch_assoc()) {

                    $postItObj = new PostIts();

                    $postItObj->setPostItID($row["post_it_id"]);
                    $postItObj->setTeam($row["team"]);
                    $postItObj->setPartner($row["queue_name"]);
                    $postItObj->setIssuedRep($row["a_username"]);
                    $postItObj->setEntryDate(date('m/d/y g:i a', strtotime($row["entry_date"])));
                    $postItObj->setIssues($row["issue"]);
                    if ($row["close_date"] == '' || is_null($row["close_date"])) {
                        $postItObj->setCloseDate($row["close_date"]);
                    } else {
                        $postItObj->setCloseDate(date('m/d/y g:i a', strtotime($row["close_date"])));
                    }
                    $postItObj->setStatus($row["state"]);
                    $postItObj->setAlertStatus($row["alert_status"]);
                    $postItObj->setCurrentNews($row["news"]);
                    $postItObj->setUpdatedRep($row["updated_rep"]);
                    $postItObj->setClosedRep($row["closed_rep"]);

                    array_push($postItsList, $postItObj);
                }
                $dbconnection->close();
                return $postItsList;
            }
        } catch (Exception $ex) {
            echo '<p style="color:red;"> Error has occured with Query:' . $ex->getMessage() . '</p>';
        }
    }

    function GetTicket($postItId) {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'SELECT pi.post_it_id, t.team, p.queue_name,pi.issue,pi.news,u.a_username,pi.state,pi.alert_status,pi.entry_date,pi.close_date,u2.a_username as updated_rep, u3.a_username as closed_rep  '
                . 'FROM scov_post_it.post_its pi  '
                . 'INNER JOIN scov_post_it.partners p on pi.partner_id = p.id '
                . 'INNER JOIN scov_post_it.team t on pi.team_id = t.team_id '
                . 'INNER JOIN scov_post_it.users u on pi.user_id = u.a_id '
                . 'left JOIN scov_post_it.users u2 on pi.updated_rep = u2.a_id '
                . 'left JOIN scov_post_it.users u3 on pi.closed_rep = u3.a_id '
                . 'WHERE pi.post_it_id =' . $postItId . ';';
        $postItObj = new PostIts();

        try {
            $postIt = $dbconnection->query($query);

            if ($postIt->num_rows === 1) {
                while ($row = $postIt->fetch_assoc()) {

                    $postItObj = new PostIts();

                    $postItObj->setPostItID($row["post_it_id"]);
                    $postItObj->setTeam($row["team"]);
                    $postItObj->setPartner($row["queue_name"]);
                    $postItObj->setIssuedRep($row["a_username"]);
                    $postItObj->setEntryDate(date('m/d/y g:i a', strtotime($row["entry_date"])));
                    $postItObj->setIssues($row["issue"]);
                    if ($row["close_date"] == '' || is_null($row["close_date"])) {
                        $postItObj->setCloseDate($row["close_date"]);
                    } else {
                        $postItObj->setCloseDate(date('m/d/y g:i a', strtotime($row["close_date"])));
                    }
                    $postItObj->setStatus($row["state"]);
                    $postItObj->setAlertStatus($row["alert_status"]);
                    $postItObj->setCurrentNews($row["news"]);
                    $postItObj->setUpdatedRep($row["updated_rep"]);
                    $postItObj->setClosedRep($row["closed_rep"]);
                }
                $dbconnection->close();
                return $postItObj;
            } else {
                echo '<p style="color:red;">Error retreiving post-its: ' . $dbconnection->connect_error . '</p>';
            }
        } catch (Exception $ex) {
            echo '<p style="color:red;">Error has occured with Query: ' . $ex->getMessage() . '</p>';
        }
    }

    //Just needs to have logic to check for difference and update the rows. 
    function UpdatePostIt($postItObj) {
        $query = "UPDATE scov_post_it.post_its SET team_id =" . $postItObj->getTeam() . ","
                . "partner_id=" . $postItObj->getPartner() . ", "
                . "issue= '" . $postItObj->getIssues() . "', "
                . "news= '" . $postItObj->getCurrentNews() . "'";


        $connection = new DBConnection();

        $dbconnection = $connection->dbconnect();

        try {
            if ($postItObj->getStatus() == 0) {
                $query = $query . ", state = 0, alert_status= '" . $postItObj->getAlertStatus() . "', close_date = null, updated_rep=".$postItObj->getIssuedRep()." ";
            } else if ($postItObj->getStatus() == 1) {
                $query = $query . ", state= 1, alert_status = 0, close_date = now(), updated_rep=" .$postItObj->getIssuedRep() . ", closed_rep=".$postItObj->getIssuedRep()." ";
            }
            $query = $query . "where post_it_ID =" . $postItObj->getPostItID() . ";";
            $result = $dbconnection->query($query);
        } catch (Exception $ex) {
            echo '<p style="color:red;">Error has occured with Update query: ' . $ex->getMessage() . '</p>';
        }

        $dbconnection->close();
    }

    function CreatePostIt($postItObj) {
        $query = "INSERT INTO scov_post_it.post_its (team_id,partner_id,issue,news,user_id,state,alert_status,entry_date) VALUES ("
                . $postItObj->getTeam() . ","
                . "'" . $postItObj->getPartner() . "',"
                . "'" . $postItObj->getIssues() . "',"
                . "'" . $postItObj->getCurrentNews() . "',"
                . "'" . $postItObj->getIssuedRep() . "',"
                . $postItObj->getStatus() . ","
                . $postItObj->getAlertStatus() . ","
                . " now()); ";

        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();

        try {

            $dbconnection->query($query);
            $dbconnection->close();
            
        } catch (Exception $ex) {
            echo '<p style="color:red;">ERROR! A problem occured saving post it: ' . $ex->getMessage() . '</p>';
        }
    }

    function DeletePostIt($postItID) {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'DELETE FROM scov_post_it.post_its WHERE post_it_ID =' . $postItID;

        try {
            $result = $dbconnection->query($query);
        } catch (Exception $ex) {
            echo '<p style="color:red;">Error has occured with Delete query: ' . $ex->getMessage() . '</p>';
        }
    }

}
