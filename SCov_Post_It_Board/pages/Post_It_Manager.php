<?php
$title = 'Post It';
include_once "../resources/Resource_Headers.php";
include_once "Admin_Header.php";
include_once '../Logic/Post_It.php';
include_once '../Logic/PartnerTeamControls.php';
include_once '../Models/SCov_PostIt_Obj.php';

if (isset($_SESSION['id'])) {

    $postIts = new Post_It();
    $postItObj = new PostIts();
    $partnerTeamController = new PartnerTeamControls();


    if (isset($_POST['submit'])) {

        $postItObj->setTeam($_POST['teamID']);
        $postItObj->setPartner($_POST['partnerID']);
        $postItObj->setIssuedRep($_SESSION['id']); //change to $_Session:username when $_Session is set.
        $postItObj->setIssues($_POST['issue']);
        $postItObj->setCurrentNews($_POST['news']);
        $postItObj->setAlertStatus($_POST['alert']);

        if (isset($_GET['id'])) {
            $postItObj->setPostItID($_GET['id']);
            $postItObj->setStatus($_POST['status']);

            try {
                $postIts->UpdatePostIts($postItObj);
                echo '<p style="color:blue;">Post It has been updated.</p>';
            } catch (Exception $ex) {
                echo '<p style="color:red;">' . $ex->getMessage() . '</p>';
            }
        } else {

            $postItObj->setStatus(0);

            try {
                $postIts->CreatePostIts($postItObj);
                echo '<p style="color:blue;">Post It has been added.</p>';
            } catch (Exception $ex) {
                echo '<p style="color:red;">' . $ex->getMessage() . '</p>';
            }
        }
    }

    if (isset($_GET['id'])) {
        try {
            $postItObj = $postIts->GetTargetPostIt($_GET['id']);
        } catch (Exception $ex) {
            echo '<p style="color:red;">Failed loading Post It: ' . $ex->getMessage() . '</p>';
        }
    }
    ?>

    <body>
        <h4>Please fill out as accurately as possible.</h4> 
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            Team: <select name='teamID'>
                <?php
                $teamList = $partnerTeamController->GetTeams();

                for ($row = 0; $row < count($teamList); $row++) {
                    if ($postItObj->getTeam() === $teamList[$row]->getTeamName()) {
                        echo "<option selected='selected' value='" . $teamList[$row]->getID() . "'>" . $teamList[$row]->getID() . ': ' . $teamList[$row]->getTeamName() . "</option>";
                    } else {
                        echo "<option value='" . $teamList[$row]->getID() . "'>" . $teamList[$row]->getID() . ': ' . $teamList[$row]->getTeamName() . "</option>";
                    }
                }
                ?>
            </select><br><br>
            Partner: <select name='partnerID'>
                <?php
                $userList = $partnerTeamController->RetrievePartners();

                for ($row = 0; $row < count($userList); $row++) {
                    if ($postItObj->getPartner() === $userList[$row]->getPartnerName()) {
                        echo "<option selected='selected' value='" . $userList[$row]->getID() . "'>" . $userList[$row]->getPartnerName() . "</option>";
                    } else {
                        echo "<option value='" . $userList[$row]->getID() . "'>" . $userList[$row]->getPartnerName() . "</option>";
                    }
                }
                ?>
            </select><br><br>
            Basic Issues: <br>
            <input required='true' type="text" name='issue' placeholder='basic issue. IE: Snow outage' size='60' maxlength="60"
            <?php
            if ($postItObj->getPostItID() != '') {
                echo "value='" . $postItObj->getIssues() . "'/>";
            } else {
                echo '/>';
            }
            ?><br><br>
            Additional Information: <br>
            <textarea required='true' type='text' name='news' placeholder='More information about issues.' row='4' maxlength="120" cols='60'
            <?php
            if ($postItObj->getPostItID() != '') {
                echo ">" . $postItObj->getCurrentNews() . "</textarea>";
            } else {
                echo '></textarea>';
            }
            ?><br><br>
            Post It Alert: 
            <select name='alert' class="dropdown-menu" aria-labelledby="alertType">            
                <option value="0"<?php
                if ($postItObj->getAlertStatus() == 0) {
                    echo "selected='selected'";
                }
                ?>>Standard Alert</option>
                <option value="1"<?php
                if ($postItObj->getAlertStatus() == 1) {
                    echo "selected='selected'";
                }
                ?> style="background-color: yellow">Small Outage</option>
                <option value="2"<?php
                if ($postItObj->getAlertStatus() == 2) {
                    echo "selected='selected'";
                }
                ?> style="background-color: orange">Major Outage</option>
            </select><br><br>
            <?php
            if ($postItObj->getPostItID() != '') {
                echo "State: <select name='status'>";
                echo "<option value='0'>Open</option>";
                if ($postItObj->getStatus() == 1) {
                    echo "<option value='1' selected ='selected'>Closed</option>";
                } else {
                    echo "<option value='1'>Closed</option>";
                }
                echo "</select><br><br>";

                if ($postItObj->getEntryDate() != '') {
                    echo "Ticket Opened: <br><input disabled type='text' id='entrydate'  name='entrydate' value=' ".$postItObj->getEntryDate() ."'/><br><br>";
                }
            }
            ?>
            <input name='submit' type='submit' class='btn btn-primary'/>   
        </form>

    </body>
    </html>
    <?php
} else {
    header('Location: Home.php');
}
