<?php
include_once (dirname('__FILE__')) . '/Models/User_Obj.php';
include_once (dirname('__FILE__')) . '/DatabaseConnections/UserConnections.php';

class UserControls {

    function GetUserInformation($username,$userPassword){
        $userConnection = new UserConnections();
        $userObj = $userConnection->UserLogin($username, $userPassword);
        
        $userObj = $userConnection->UserSettings($userObj);
        
        return $userObj;
    }
    
    function SetNewUserSettings($userObj,$updatedUserSettings){
        $userConnection = new UserConnections();
        
        $result = array_diff($userObj->getPartnerSettings, $updatedUserSettings);
        foreach($result as $newSetting){
            $userConnection->SaveUserSettings($newSetting);
        }
    }
    
    function RetrievePartners(){
        $userConnection = new UserConnections();
        $partnerList = $userConnection->RetrievePartnerList();
               
        return $partnerList;
    }
    
    function UpdateUserPrivilege($userObj){
        $userConnection = new UserConnections();
        $userConnection->UpdateUserPrivilege($userObj);
    }
    
    function CreateTeam($team){
        
    }
}
