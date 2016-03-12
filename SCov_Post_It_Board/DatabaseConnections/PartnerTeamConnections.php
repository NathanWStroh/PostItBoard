<?php

include_once 'DBConnection.php';
include_once '../Models/Partner_Obj.php';
include_once '../Models/Team_Obj.php';
include_once '../Models/User_Obj.php';

class PartnerTeamConnections {

    function RetrievePartnerList() {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'CALL RETRIEVE_PARTNERS();';

        $partnerList = array();
        try {
            $partners = $dbconnection->query($query);

            if ($partners->num_rows > 0) {
                while ($row = $partners->fetch_assoc()) {

                    $partnerObj = new Partner_Obj();

                    $partnerObj->setID($row["partnerID"]);
                    $partnerObj->setPartnerName($row["parnterName"]);

                    $partnerList[] = $partnerObj;
                }
                //print_r($partnerList);
                $dbconnection->close();
                return $partnerList;
            }
        } catch (Exception $ex) {
            echo 'ERROR pulling partner list: ' . $ex->getMessage();
        }
    }

    function GrabTeams() {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'Select * from Team;';


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
            echo "ERROR retrieving team information: " . $ex->getMessage();
        }
    }

}
