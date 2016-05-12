<?php

include_once 'DBConnection.php';
include_once '../Models/Partner_Obj.php';
include_once '../Models/Team_Obj.php';
include_once '../Models/User_Obj.php';

class PartnerTeamConnections {

    function RetrievePartnerList() {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'SELECT id, queue_name, queue_number, scr_user_id, scr_group_name FROM scov_post_it.partners ORDER BY queue_name;';

        $partnerList = array();
        try {
            $partners = $dbconnection->query($query);

            if ($partners->num_rows > 0) {
                while ($row = $partners->fetch_assoc()) {

                    $partnerObj = new Partner_Obj();

                    $partnerObj->setID($row["id"]);
                    $partnerObj->setPartnerName($row["queue_name"]);
                    $partnerObj->setPartnerNumber($row["queue_number"]);
                    $partnerObj->setScrUserID($row["scr_user_id"]);
                    $partnerObj->setScrGroupName($row["scr_group_name"]);

                    $partnerList[] = $partnerObj;
                }
                $dbconnection->close();
                return $partnerList;
            }
        } catch (Exception $ex) {
            echo '<p style="color:red;">ERROR pulling partner list: ' . $ex->getMessage() . '</p>';
        }
    }

    function DeletePartner($partnerID) {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = "DELETE FROM scov_post_it.partners WHERE id =" . $partnerID;
        $deleteRepSettings = "DELETE FROM scov_post_it.rep_partner_settings WHERE partner_id=" . $partnerID;
        try {
            $dbconnection->query($query);
            $dbconnection->query($deleteRepSettings);
        } catch (Exception $ex) {
            echo '<p style="color:red;">An error has occured deleting the team name: ' . $ex->getMessage() . '</p>';
        }
    }

    function UpdatePartner($partnerObj) {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();

        $query = "UPDATE scov_post_it.partners "
                . "SET queue_name = '" . htmlspecialchars($partnerObj->getPartnerName(), ENT_QUOTES) . "', queue_number=" . $partnerObj->getPartnerNumber() . ", scr_user_id =" . $partnerObj->getScrUserID() . ", scr_group_name='" . htmlspecialchars($partnerObj->getScrGroupName(), ENT_QUOTES) . "' "
                . "WHERE id =" . $partnerObj->getID() . ";";

        try {
            $dbconnection->query($query);
        } catch (Exception $ex) {
            echo '<p style="color:red;">ERROR has occured updating team name: ' . $ex->getMessage() . '</p>';
        }
    }

    function CreatePartner($partnerObj) {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();

        $query = "INSERT INTO scov_post_it.partners (queue_name, queue_number,scr_user_id,scr_group_name) "
                . "VALUES ('" . htmlspecialchars($partnerObj->getPartnerName(), ENT_QUOTES) . "', "
                . $partnerObj->getPartnerNumber() . ", "
                . $partnerObj->getScrUserID() . ", "
                . "'" . htmlspecialchars($partnerObj->getScrGroupName(), ENT_QUOTES) . "');";
        $getNewPartnerID = "SELECT id FROM scov_post_it.partners WHERE queue_name='" . htmlspecialchars($partnerObj->getPartnerName(), ENT_QUOTES) . "' and queue_number='" . $partnerObj->getPartnerNumber() . "';";

        try {
            $dbconnection->query($query);
            $partner = $dbconnection->query($getNewPartnerID);
            if ($partner->num_rows == 1) {
                while ($row = $partner->fetch_assoc()) {
                    $partnerID = $row['id'];
                }
                $updateRepSettings = "INSERT INTO scov_post_it.rep_partner_settings (a_id,partner_id,visible) SELECT a_id," . $partnerID . ", 1 FROM scov_post_it.user_rights;";
                $dbconnection->query($updateRepSettings);
            }
        } catch (Exception $ex) {
            echo '<p style="color:red;">ERROR has occured when creating partner: ' . $ex->getMessage() . '</p>';
        }
    }

    function GrabTeams() {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'SELECT team_id, team FROM scov_post_it.team;';


        $teamList = array();

        try {
            $teams = $dbconnection->query($query);
            if ($teams->num_rows > 0) {
                while ($row = $teams->fetch_assoc()) {

                    $teamObj = new Team_Obj();

                    $teamObj->setID($row['team_id']);
                    $teamObj->setTeamName($row['team']);

                    array_push($teamList, $teamObj);
                }
            }
            $dbconnection->close();
            return $teamList;
        } catch (Exception $ex) {
            echo '<p style="color:red;">ERROR retrieving team information: ' . $ex->getMessage() . '</p>';
        }
    }

    function CreateTeam($teamName) {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();

        $query = "INSERT INTO scov_post_it.team (team) VALUES ('" . htmlspecialchars($teamName, ENT_QUOTES) . "');";

        try {
            $dbconnection->query($query);
        } catch (Exception $ex) {
            echo '<p style="color:red;">ERROR has occured when creating team: ' . $ex->getMessage() . '</p>';
        }
    }

    function UpdateTeam($teamID, $teamName) {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();

        $query = "UPDATE scov_post_it.team SET team = '" . htmlspecialchars($teamName, ENT_QUOTES) . "' WHERE team_id =" . $teamID . ";";

        try {
            $dbconnection->query($query);
        } catch (Exception $ex) {
            echo '<p style="color:red;">ERROR has occured updating team name: ' . $ex->getMessage() . '</p>';
        }
    }

    function DeleteTeam($teamID) {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'DELETE FROM scov_post_it.team WHERE team_id =' . $teamID;

        try {
            $dbconnection->query($query);
        } catch (Exception $ex) {
            echo '<p style="color:red;">An error has occured deleting the team name: ' . $ex->getMessage() . '</p>';
        }
    }

}
