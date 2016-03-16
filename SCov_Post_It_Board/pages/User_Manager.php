<?php
$title = 'User Manager';
include_once '../resources/Resource_Headers.php';
include_once 'Admin_Header.php';
include_once '../Models/User_Obj.php';
include_once '../Logic/UserControls.php';

if (isset($_SESSION['id']) && $_SESSION['role'] >= 1) {
    $userController = new UserControls();

    if (isset($_POST['update'])) {
        $userObj = new User_Obj();

        $userObj->setID($_POST['userID']);
        $userObj->setRole($_POST['userRole']);

        try {
            $userController->UpdateUserPrivilege($userObj);
            echo '<p style="color:blue;">User has been updated. </p>';
        } catch (Exception $ex) {
            echo '<p style="color:red;">' . $ex->getMessage() . '</p>';
        }
    }
    ?>

    <body>
        <h3></h3>
        <table id="tableOfPosts" class="table table-condensed">
            <thead>
                <tr><td hidden></td><td>Username</td><td>First Name</td><td>Last Name</td><td>Role</td><td>Update</td></tr>
            </thead>
            <tbody>
                <?php
                $partnerList = $userController->RetrieveUsers($_SESSION['role']);

                for ($row = 0; $row < count($partnerList); $row++) {
                    if ($partnerList[$row]->getID() != $_SESSION['id']) {

                        echo "<tr><form name='form" . $row . " ' method='POST' action='" . $_SERVER['PHP_SELF'] . "'>";
                        echo "<td hidden><input type= 'text' name='userID' value='" . $partnerList[$row]->getID() . "'/></td>";
                        echo "<td>" . $partnerList[$row]->getUsername() . "</td>";
                        echo "<td>" . $partnerList[$row]->getFirstName() . "</td>";
                        echo "<td>" . $partnerList[$row]->getLastName() . "</td>";
                        echo "<td><select name='userRole'>";
                        echo "<option value='0'";
                        if ($partnerList[$row]->getRole() == 0) {
                            echo " selected=\'selected\'";
                        }
                        echo ">Basic User</option>";
                        echo "<option value='1'";
                        if ($partnerList[$row]->getRole() == 1) {
                            echo " selected=\'selected\'";
                        }
                        echo ">Team Lead</option>";
                        if ($_SESSION['role'] >= 2) {
                            echo "<option value='2'";
                            if ($partnerList[$row]->getRole() == 2) {
                                echo " selected=\'selected\'";
                            }
                            echo ">Supervisor</option>";
                        }
                        echo"</td></select>";
                        echo "<td><input id='update" . $row . "' class='btn btn-default'   type='submit' name='update' value='update' "
                        . "onclick=\"return confirm('Updating user permissions for " . $partnerList[$row]->getFirstName() . " " . $partnerList[$row]->getLastName() . "?');\"></td>";
                        echo '</form></tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </body>
    </html>
    <?php
} else {
    header('Location: Home.php');
}