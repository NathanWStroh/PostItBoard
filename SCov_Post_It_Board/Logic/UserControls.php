<?php
include_once '../Models/User_Obj.php';
include_once '../DatabaseConnections/UserConnections.php';

class UserControls {

    function GetUserInformation($username,$userPassword){
        $userConnection = new UserConnections();
        $userObj = $userConnection->UserLogin($username, $userPassword);
        
//        $userObj = $userConnection->UserSettings($userObj);
        
        return $userObj;
    }
    
    function SetNewUserSettings($userObj){
        $userConnection = new UserConnections();
        
    }
    
    function UpdateUserPrivilege($userObj){
        $userConnection = new UserConnections();
        $userConnection->UpdateUserPrivilege($userObj);
    }
    
    function RetrieveUsers(){
        $userConnections = new UserConnections();
        $userList = $userConnections->PullUsers();
        
        return $userList;
    }

}
