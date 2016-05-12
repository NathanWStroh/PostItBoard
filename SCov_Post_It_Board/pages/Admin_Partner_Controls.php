<?php
$title = 'Super Admin';
include_once'../resources/Resource_Headers.php';
include_once 'Admin_Header.php';
include_once '../Logic/PartnerTeamControls.php';

if (isset($_SESSION['id']) && $_SESSION['role'] == 3) {

    $partnerTeamController = new PartnerTeamControls();
    if (isset($_POST['submit'])) {

        try {
            $partnerObj = new Partner_Obj();
            
            $partnerObj->setPartnerName($_POST['queueName']);
            $partnerObj->setPartnerNumber($_POST['queueNumber']);
            $partnerObj->setScrUserID($_POST['scrUserID']);
            $partnerObj->setScrGroupName($_POST['scrGroupName']);
            
            $partnerTeamController->CreatePartner($partnerObj);
            echo '<p style="color:blue;"> Partner has been added. </p>';
        } catch (Exception $ex) {
            echo '<p style="color:red;">' . $ex->getMessage() . '</p>';
        }
    }
    if (isset($_POST['update'])) {

        try {
            $partnerObj = new Partner_Obj();
            $partnerObj->setID($_POST['partnerID']);
            $partnerObj->setPartnerName($_POST['queueName']);
            $partnerObj->setPartnerNumber($_POST['queueNumber']);
            $partnerObj->setScrUserID($_POST['scrUserID']);
            $partnerObj->setScrGroupName($_POST['scrGroupName']);

            $partnerTeamController->UpdatePartner($partnerObj);
            echo '<p style="color:blue;"> Partner has been UPDATED! </p>';
        } catch (Exception $ex) {
            echo '<p style="color:red;">' . $ex->getMessage() . '</p>';
        }
    }

    if (isset($_POST['delete'])) {

        try {
            $partnerID = $_POST['partnerID'];

            $partnerTeamController->DeletePartner($partnerID);
            echo '<p style="color:blue;"> Partner has been deleted! </p>';
        } catch (Exception $ex) {
            echo '<p style="color:red;">' . $ex->getMessage() . '</p>';
        }
    }
    ?>
    <body>
        <h4>Enter new ISP Partner:</h4>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            Queue Name: <input type="text" name='queueName' required/>
            Queue Number: <input type="text" name='queueNumber' required />
            SCR User ID: <input type="text" name='scrUserID' required />
            SCR Group Name: <input type="text" name='scrGroupName' required />
            <input name='submit' type='submit' class='btn btn-primary'/>
        </form><br><br>
        <table id="tableOfPosts" class="table table-condensed team"  style='border-collapse:collapse' data-order='[[1,"asc"]]'>
            <thead>
                <tr>
                    <th hidden>ID</th><th>Queue Name</th><th>Queue Number</th><th>SCR User ID</th><th>SCR Group Name</th><th>Update</th><th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $partners = new PartnerTeamControls();
                $userList = $partners->RetrievePartners();

                for ($row = 0; $row < count($userList); $row++) {
                    echo "<tr><form name='form" . $row . " ' method='POST' action='" . $_SERVER['PHP_SELF'] . "'>";
                    echo "<td hidden><input type='text' name='partnerID' value='" . $userList[$row]->getID() . "'/></td>";
                    echo "<td><input type='text' name='queueName' value='" . $userList[$row]->getPartnerName() . "'/><p hidden>" . $userList[$row]->getPartnerName() . "</p></td>";
                    echo "<td><input type='text' name='queueNumber' value='" . $userList[$row]->getPartnerNumber() . "'/><p hidden>" . $userList[$row]->getPartnerNumber() . "</p></td>";
                    echo "<td><input type='text' name='scrUserID' value='" . $userList[$row]->getScrUserID() . "'/><p hidden>" . $userList[$row]->getScrUserID() . "</p></td>";
                    echo "<td><input type='text' name='scrGroupName' value='" . $userList[$row]->getScrGroupName() . "'/><p hidden>" . $userList[$row]->getScrGroupName() . "</p></td>";
                    echo "<td><input class='btn btn-primary' id='update' type='submit' name='update' value='update'></td>";
                    echo "<td><input class='btn btn-primary' id='delete' type='submit' name='delete' value='delete' onclick=\"return confirm('Are you sure you want to delete " . $userList[$row]->getPartnerName() . "?');\"></td>";
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