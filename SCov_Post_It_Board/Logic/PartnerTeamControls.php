<?php

include_once '../DatabaseConnections/PartnerTeamConnections.php';
include_once '../Models/Team_Obj.php';
include_once '../Models/Partner_Obj.php';

class PartnerTeamControls {

    function GetTeams() {
        $connection = new PartnerTeamConnections();
        
        $teamList = $connection->GrabTeams();
        
        return $teamList;
    }

    function CreateTeam($team) {
        
    }

    function RetrievePartners() {
        $userConnection = new PartnerTeamConnections();
        $partnerList = $userConnection->RetrievePartnerList();

        return $partnerList;
    }

}
