<?php

include_once 'DBConnection.php';
include_once (dirname('__FILE__')) . '/Models/User_Obj.php';

class UserConnections {

    function UserLogin($username, $userPassword) {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'Call Get_User_Information(' . $username . ',' . $userPassword . ' );';
        $userObj = new User_Obj();
        try {
            $user = $dbconnection->query($query);

            if ($user->num_rows === 1) {
                while ($row = $user->fetch_assoc()) {
                    $userObj->setUsername($row['a_username']);
                    $userObj->setPassword($row['a_password']);
                    $userObj->setRole($row['a_role']);
                }
            }
            $dbconnection->close();
            return $userObj;
        } catch (Exception $ex) {
            echo 'Error Retrieving User Information: ' . $dbconnection->connect_error;
        }
    }

    function UserSettings($userObj) {
        $userSettingsList = array();

        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'Call Get_User_Settings(' . $userObj->getUsername . ',' . $userObj->getPassword . ' );';

        try {
            $user = $dbconnection->query($query);

            if ($user->num_rows > 0) {
                while ($row = $user->fetch_assoc()) {
                    array_push($userSettingsList, $row['partnerVariable']);
                }
                $userObj->setPartnerSettings($userSettingsList);
            }
        } catch (Exception $ex) {
            echo 'Error Retrieving User Settings: ' . $dbconnection->connect_error;
        }
        $dbconnection->close();
        return $userObj();
    }

    function SaveUserSettings($newUserSetting){
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'CALL SAVE_USER_SETTINGS ('.$newUserSetting.');';
        
        try{
            
            $dbconnection->query($query);
            $dbconnection->close();
            
        } catch (Exception $ex) {
            echo 'Error occured saving user settings: ' . $dbconnection->connect_error;
        }
    }
    
    function RetrievePartnerList(){
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'CALL RETRIEVE_PARTNERS();';
        
        try{
            $partnerList = $dbconnection->query($query);
            
            return $partnerList;
        } catch (Exception $ex) {
            echo 'ERROR occured retrieving list of partners: ' . $dbconnection->connect_error;
        }
        
    }
}
