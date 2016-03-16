<?php

include_once 'DBConnection.php';
include_once '../Models/Partner_Obj.php';
include_once '../Models/Team_Obj.php';
include_once '../Models/User_Obj.php';

class PartnerTeamConnections {

    function RetrievePartnerList() {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'SELECT * FROM scov_post_it.partners;';

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
                //print_r($partnerList);
                $dbconnection->close();
                return $partnerList;
            }
        } catch (Exception $ex) {
            echo '<p style="color:red;">ERROR pulling partner list: ' . $ex->getMessage().'</p>';
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
            echo '<p style="color:red;">ERROR retrieving team information: ' . $ex->getMessage().'</p>';
        }
    }

    function CreateTeam($teamName){
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        
        $query = "INSERT INTO TEAM (TEAM) VALUES ('".$teamName."');";
        
        try{
            $dbconnection->query($query);
            
        } catch (Exception $ex) {
            echo '<p style="color:red;">ERROR has occured when creating team: '. $ex->getMessage().'</p>';
        }
    }
    
    function UpdateTeam($teamID,$teamName){
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        
        $query = "UPDATE scov_post_it.team SET team = '".$teamName. "' WHERE team_id =".$teamID.";";
        
        try{
            $dbconnection->query($query);
        } catch (Exception $ex) {
            echo '<p style="color:red;">ERROR has occured updating team name: '.$ex->getMessage().'</p>';
        }
        
    }
    
    function DeleteTeam($teamID){
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'DELETE FROM scov_post_it.team WHERE team_id ='.$teamID;
        
        try{
            $dbconnection->query($query);
        } catch (Exception $ex) {
            echo '<p style="color:red;">An error has occured deleting the team name: '.$ex->getMessage().'</p>';
        }
        
    }
}
