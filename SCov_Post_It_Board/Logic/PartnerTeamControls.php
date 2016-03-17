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

    function CreateTeam($teamName) {
        $connection = new PartnerTeamConnections();
        $connection->CreateTeam($teamName);
    }

    function UpdateTeam($teamID, $teamName) {
        $connection = new PartnerTeamConnections();
        $connection->UpdateTeam($teamID, $teamName);
    }

    function DeleteTeam($teamID) {
        $connection = new PartnerTeamConnections();
        $connection->DeleteTeam($teamID);
    }

    function RetrievePartners() {
        $userConnection = new PartnerTeamConnections();
        $partnerList = $userConnection->RetrievePartnerList();

        return $partnerList;
    }
    function CreatePartner($partnerObj){
        $userConnection = new PartnerTeamConnections();
        $userConnection->CreatePartner($partnerObj);
    }

    function UpdatePartner($partnerObj) {
        $userConnection = new PartnerTeamConnections();
        $userConnection->UpdatePartner($partnerObj);
    }

    function DeletePartner($partnerID) {
        $userConnection = new PartnerTeamConnections();
        $userConnection->DeletePartner($partnerID);
    }

}
