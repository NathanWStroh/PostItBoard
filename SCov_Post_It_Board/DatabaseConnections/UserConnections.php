<?php

include_once 'DBConnection.php';
include_once 'PartnerTeamConnections.php';
include_once '../Models/User_Obj.php';

class UserConnections {

    function PullUsers() {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = "SELECT u.a_id,u.a_username, u.a_fname,u.a_lname,ur.user_rights FROM scov_post_it.users u, scov_post_it.user_rights ur WHERE u.a_id = ur.a_id and user_rights <> 2; ";

        $userList = array();

        try {
            $users = $dbconnection->query($query);

            if ($users->num_rows > 0) {
                while ($row = $users->fetch_assoc()) {
                    $userObj = new User_Obj();
                    
                    $userObj->setID($row['a_id']);
                    $userObj->setFirstName($row['a_fname']);
                    $userObj->setLastName($row['a_lname']);
                    $userObj->setUsername($row['a_username']);
                    $userObj->setRole($row['user_rights']);
                    
                    array_push($userList, $userObj);
                }
                return $userList;
            }
        } catch (Exception $ex) {
            echo '<p style="color:red;">ERROR pulling user list: ' . $dbconnection->connect_error . '</p>';
        }
    }

    function UserLogin($username, $userPassword) {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        
        $LogInQuery = "select * from users where a_username ='" . $username . "' and a_password ='" . $userPassword . "';";
        $VerifyUserQuery = "SELECT a_id from user_rights where a_id =";
        $CreateUserQuery = 'INSERT INTO user_rights (a_id) Values (';
        $GetUserInformationQuery = "select u.a_id, u.a_username, u.a_lname,u.a_fname,ur.user_rights from scov_post_it.users u, scov_post_it.user_rights ur where u.a_id = ur.a_id and u.a_id =";


        try {
            $result = $dbconnection->query($LogInQuery);

            //checks to see if user exists
            if ($result->num_rows === 1) {
                while ($row = $result->fetch_assoc()) {
                    $userID = $row['a_id'];
                    $VerifyUserQuery = $VerifyUserQuery . $userID . ";";

                    //creates new user if not in user_rights table
                    $userExists = $dbconnection->query($VerifyUserQuery);
                    if ($userExists->num_rows === 0) {

                        $CreateUserQuery = $CreateUserQuery . $userID . ");";
                        $createPartnerSettingsQuery = 'INSERT INTO scov_post_it.rep_partner_settings (a_id,partner_id,visible) SELECT '.$userID.', id, 1 FROM scov_post_it.partners;' ;

                        $dbconnection->query($CreateUserQuery);
                        $dbconnection->query($createPartnerSettingsQuery);
                        
                        echo '<p style="color:blue;"> Welcome. Your account has been created.</p>';
                    }
                    $GetUserInformationQuery = $GetUserInformationQuery . $userID . ";";
                    $userResult = $dbconnection->query($GetUserInformationQuery);

                    //retrieves user information
                    if ($userResult->num_rows === 1) {
                        while ($userRow = $userResult->fetch_assoc()) {
                            $userObj = new User_Obj();

                            $userObj->setID($userRow['a_id']);
                            $userObj->setFirstName($userRow['a_fname']);
                            $userObj->setLastName($userRow['a_lname']);
                            $userObj->setUsername($row['a_username']);
                            $userObj->setRole($userRow['user_rights']);
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
            echo '<p style="color:red;">Error Retrieving User Information: ' . $dbconnection->connect_error . '</p>';
        }
    }

    function UpdateUserPrivilege($userObj) {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = "UPDATE scov_post_it.user_rights SET USER_RIGHTS = '".$userObj->getRole()."' WHERE a_id=".$userObj->getID();
        try{
            $dbconnection->query($query);
        } catch (Exception $ex) {
            echo "ERROR has occured updating the user's permissions: ".$ex->getMessage();
        }
        
    }

    function UserSettings($userObj) {
        $partnerConnection = new PartnerTeamConnections();
        $partnerList = $partnerConnection->RetrievePartnerList();
        $userSettingsList = array();

        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $createUserSettingsQuery = 'SELECT * FROM rep_partner_settings where userID =' . $userObj->getID();
        $getUserSettingsQuery = 'select partnerID from rep_partner_settings where userID=' . $userObj->getID();

        try {
            $verifySettings = $dbconnection->query($getUserSettingsQuery);

            if ($verifySettings->num_rows > 0) {
                while ($row = $user->fetch_assoc()) {
                    array_push($userSettingsList, $row['partnerID']);
                }
                $userObj->setPartnerSettings($userSettingsList);
            }
        } catch (Exception $ex) {
            echo '<p style="color:red;">Error Retrieving User Settings: ' . $dbconnection->connect_error . '</p>';
        }
        $dbconnection->close();
        return $userObj();
    }

    function SaveUserSettings($userID,$partnerID,$visible) {
        $connection = new DBConnection();
        $dbconnection = $connection->dbconnect();
        $query = 'UPDATE scov_post_it.rep_partner_settings SET visible ='.$visible.' WHERE partner_id ='.$partnerID.' and a_id ='.$userID;

        try {

            $dbconnection->query($query);
            $dbconnection->close();
        } catch (Exception $ex) {
            echo '<p style="color:red;"> Error occured saving user settings: ' . $dbconnection->connect_error . '<p>';
            $dbconnection->close();
        }
    }
    
}
