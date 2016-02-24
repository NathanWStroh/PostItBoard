<?php
include_once 'DBConnection.php';

class UserConnections{
    
    function AddUser($userObj){
        $dbconn = new DBConnection();
    }
    
    function UpdateUser(){
        $dbconn = new DBConnection($userObj);
    }
    
    function DeleteUser($userObj){
        $dbconn = new DBConnection();
    }
    
}
