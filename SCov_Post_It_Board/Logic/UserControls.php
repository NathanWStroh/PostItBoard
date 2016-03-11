<?php
include_once '../Models/User_Obj.php';
include_once '../DatabaseConnections/UserConnections.php';

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
    
    function UpdateUserPrivilege($userObj){
        $userConnection = new UserConnections();
        $userConnection->UpdateUserPrivilege($userObj);
    }

}
