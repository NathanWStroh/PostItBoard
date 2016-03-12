<?php

include_once 'DBConnection.php';
include_once '../Models/User_Obj.php';

class UserConnections {

    function PullUsers() {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'SELECT U.A_ID, U.A_USERNAME, UR.USER_RIGHTS '
                . 'FROM USERS U, USER_RIGHTS UR '
                . 'WHERE U.A_ID = UR.A_ID';

        $userList = array();

        try {
            $users = $dbconnection->query($query);

            if ($users->num_rows > 0) {
                while ($row = $users->fetch_assoc()) {
                    $userObj = new User_Obj();

                    $userObj->setID($row['A_ID']);
                    $userObj->setUsername($row['A_USERNAME']);
                    $userObj->setRole($row['USER_RIGHTS']);

                    array_push($userList, $userObj);
                }
                return $userList;
            }
        } catch (Exception $ex) {
            echo 'ERROR pulling user list: ' . $dbconnection->connect_error;
        }
    }

    function UserLogin($username, $userPassword) {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'Call Get_User_Information(' . $username . ',' . $userPassword . ' );';


        try {
            $user = $dbconnection->query($query);

            if ($user->num_rows === 1) {
                while ($row = $user->fetch_assoc()) {

                    $userObj = new User_Obj();

                    $userObj->setID($row['a_id']);
                    $userObj->setUsername($row['a_username']);
                    $userObj->setPassword($row['a_password']);
                    $userObj->setRole($row['a_role']);
                }
            }

            VerifyUser($userObj->getID());

            $dbconnection->close();
            return $userObj;
        } catch (Exception $ex) {
            echo 'Error Retrieving User Information: ' . $dbconnection->connect_error;
        }
    }

    function VerifyUser($userObj) {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'CALL Verify_employee_exists(' . $userObj->getId() . ');';
        $createUserQuery = 'CALL CREATE_USER(' . $userObj->getId() . ');';

        try {
            $user = $dbconnection->query($query);
            if ($user->num_rows === 0 || $user === null) {
                $dbconnection->query($createUserQuery);
//                $userObj->setRole() = "STANDARD USER";
            }
            return $userObj;

            $dbconnection->close();
        } catch (Exception $ex) {
            echo "Error occured verifying employee permissions: " . $dbconnection->connect_error;
        }
    }

    function UpdateUserPrivilege($userObj) {
        
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

    function SaveUserSettings($newUserSetting) {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'CALL SAVE_USER_SETTINGS (' . $newUserSetting . ');';

        try {

            $dbconnection->query($query);
            $dbconnection->close();
        } catch (Exception $ex) {
            echo 'Error occured saving user settings: ' . $dbconnection->connect_error;
        }
    }

}
