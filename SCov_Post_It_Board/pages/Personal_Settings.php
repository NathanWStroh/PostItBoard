<?php
$title = 'Personal Settings';
include_once'../resources/Resource_Headers.php';
include_once 'Admin_Header.php';
include_once '../Logic/UserControls.php';

if (isset($_SESSION['id'])) {

    $userController = new UserControls();
    
    if (isset($_POST['show'])) {

        try {
            $userSettingObj = new UserSettings();
            
            $userSettingObj->setSettingID($_POST['settingID']);
            $userSettingObj->setVisible(1);

            $userController->SetNewUserSettings($userSettingObj);
        } catch (Exception $ex) {
            echo '<p style="color:red;">' . $ex->getMessage() . '</p>';
        }
    }

    if (isset($_POST['hide'])) {

        try {
            $userSettingObj = new UserSettings();
            
            $userSettingObj->setSettingID($_POST['settingID']);
            $userSettingObj->setVisible(0);

            $userController->SetNewUserSettings($userSettingObj);
        } catch (Exception $ex) {
            echo '<p style="color:red;">' . $ex->getMessage() . '</p>';
        }
    }
    ?>
    <body>
        <h3>Select the partners you would like to see on the post it board.</h3>
        <table id="tableOfPosts" class="table table-condensed">
            <thead>
                <tr><td hidden></td><td>Partner Name</td><td>Show/Hide</td></tr>
            </thead>
            <tbody>
                <?php
                $userSettings = new UserControls();
                $settingsList = $userSettings->GrabUserSetting($_SESSION['id']);

                for ($row = 0; $row < count($settingsList); $row++) {
                    echo "<tr><form name='form" . $row . " ' method='POST' action='" . $_SERVER['PHP_SELF'] . "'>";
                    echo "<td hidden><input type= 'text' name='settingID' value='" . $settingsList[$row]->getSettingID() . "'/></td>";
                    echo "<td>" . $settingsList[$row]->getPartnerName() . "</td>";

                    if ($settingsList[$row]->getVisible() == 0) {
                        echo "<td><input style='background-color: #4dff4d;' id='show' type='submit' name='show' value='show'></td>";
                    } else {
                        echo "<td><input style='background-color: #ff6666;' id='hide' type='submit' name='hide' value='hide'></td>";
                    }
                    echo '</form></tr>';
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