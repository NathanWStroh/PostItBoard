<?php
include_once '../Models/User_Obj.php';
include_once '../DatabaseConnections/UserConnections.php';

class UserControls {

    function GetUserInformation($username,$userPassword){
        $userConnection = new UserConnections();
        $userObj = $userConnection->UserLogin($username, $userPassword);
        
        return $userObj;
    }
    
    function SetNewUserSettings($userSettingObj){
        $userConnection = new UserConnections();
        $userConnection->SaveUserSettings($userSettingObj);
    }
    
    function GrabUserSetting($userID){
        $userConnections = new UserConnections();
        $userSettings = $userConnections->GetUserSettings($userID);
        
        return $userSettings;
    }
    
    function UpdateUserPrivilege($userObj){
        $userConnection = new UserConnections();
        $userConnection->UpdateUserPrivilege($userObj);
    }
    
    function DeleteUser($userID){
        $userConnection = new UserConnections();
        $userConnection->DeleteUser($userID);
    }
    
    function RetrieveUsers($userRole){
        $userConnections = new UserConnections();
        $userList = $userConnections->PullUsers($userRole);
        
        return $userList;
    }

}
