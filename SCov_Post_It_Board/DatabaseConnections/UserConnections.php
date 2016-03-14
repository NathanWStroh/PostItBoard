<?php

include_once 'DBConnection.php';
include_once 'PartnerTeamConnections.php';
include_once '../Models/User_Obj.php';

class UserConnections {
    
    function PullUsers() {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = "SELECT U.A_ID,U.A_FNAME,U.A_LNAME,UR.USER_RIGHTS FROM USERS U, USER_RIGHTS UR WHERE U.A_ID = UR.A_ID and USER_RIGHTS <> 'Super Admin'; ";

        $userList = array();

        try {
            $users = $dbconnection->query($query);

            if ($users->num_rows > 0) {
                while ($row = $users->fetch_assoc()) {
                    $userObj = new User_Obj();

                    $userObj->setID($row['A_ID']);
                    $userObj->setFirstName($row['A_FNAME']);
                    $userObj->setLastName($row['A_LNAME']);
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

        $LogInQuery = "select * from users where a_username ='" . $username . "' and a_password ='" . $userPassword . "';";
        $VerifyUserQuery = "SELECT a_id from user_rights where a_id =";
        $CreateUserQuery = 'INSERT INTO user_rights (a_id) Values (';
        $GetUserInformationQuery = "select u.a_id, u.a_username, u.a_lname,u.a_fname,ur.USER_RIGHTS from users u, user_rights ur where u.a_id = ur.a_id and u.a_id =";


        try {
            $result = $dbconnection->query($LogInQuery);

            //checks to see if user exists
            if ($result->num_rows === 1) {
                while ($row = $result->fetch_assoc()) {
                    $userID = $row['a_id'];
                    echo $userID;
                    $VerifyUserQuery =$VerifyUserQuery . $userID . ";";
                    
                    //creates new user if not in user_rights table
                    $userExists = $dbconnection->query($VerifyUserQuery);
                    if ($userExists->num_rows ===0) {
                        
                        $CreateUserQuery = $CreateUserQuery. $userID . ");";
                        $dbconnection->query($CreateUserQuery);
                        echo 'Welcome. Your account has been created.';
                    }
                    $GetUserInformationQuery = $GetUserInformationQuery. $userID . ";";
                    $userResult = $dbconnection->query($GetUserInformationQuery);
                    
                    //retrieves user information
                    if ($userResult->num_rows === 1) {
                        while ($userRow = $userResult->fetch_assoc()) {
                            $userObj = new User_Obj();

                            $userObj->setID($userRow['a_id']);
                            $userObj->setFirstName($userRow['a_fname']);
                            $userObj->setLastName($userRow['a_lname']);
                            $userObj->setRole($userRow['USER_RIGHTS']);
                            
                            echo '<br><br>HELLO, '.$userObj->getFirstName().'!';
                        }
                        $dbconnection->close();
                        return $userObj;
                    }
                }
            } else {
                echo '<p style="color:red;">Username/Password does not exist in iTools.</p>';
                $dbconnection->close();
            }
        } catch (Exception $ex) {
            echo 'Error Retrieving User Information: ' . $dbconnection->connect_error;
        }
    }

    function UpdateUserPrivilege($userObj) {
        
    }

    function UserSettings($userObj) {
        $partnerConnection = new PartnerTeamConnections();
        $partnerList = $partnerConnection->RetrievePartnerList();
        $userSettingsList = array();

        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $createUserSettingsQuery = 'SELECT * FROM rep_partner_settings where userID ='.$userObj->getID();
        $getUserSettingsQuery = 'select partnerID from rep_partner_settings where userID='.$userObj->getID();

        try {
            $verifySettings = $dbconnection->query($getUserSettingsQuery);

            if ($verifySettings->num_rows > 0) {
                while ($row = $user->fetch_assoc()) {
                    array_push($userSettingsList, $row['partnerID']);
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
