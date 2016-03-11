<?php

include_once 'DBConnection.php';
include_once '../Models/Partner_Obj.php';
include_once '../Models/Team_Obj.php';

class PartnerTeamConnections {
    
       function RetrievePartnerList() {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'CALL RETRIEVE_PARTNERS();';

        $partnerObj = new Partner_Obj();

        $partnerList = array();
        try {
            $partners = $dbconnection->query($query);
                    
            if ($partners->num_rows > 0) {
                while ($row = $partners->fetch_assoc()) {
                
                    $partnerObj->setID($row["partnerID"]);
                    $partnerObj->setPartnerName($row["parnterName"]);
                    
                    array_push($partnerList, $partnerObj);
                }
                 $dbconnection->close();
                return $partnerList;
               
            }
        } catch (Exception $ex) {
            echo 'ERROR pulling partner list: ' . $ex->getMessage();
        }
    }
    
    function GrabTeams(){
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'Select * from Team;';
        
        $teamObj = new Team_Obj();
        $teamList = array();
        
        try{
            $teams = $dbconnection->query($query);
            if($teams->num_rows > 0){
                while ($row = $teams->fetch_assoc()){
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
