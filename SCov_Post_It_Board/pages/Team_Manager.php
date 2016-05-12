<?php
$title = 'Team Manager';
include_once '../resources/Resource_Headers.php';
include_once 'Admin_Header.php';
include_once '../Models/Team_Obj.php';
include_once '../Logic/PartnerTeamControls.php';

$partnerTeamController = new PartnerTeamControls();

if (isset($_SESSION['id']) && $_SESSION['role'] >= 1 ) {
if (isset($_POST['submit'])) {

    try {
        $partnerTeamController->CreateTeam($_POST['team']);
        echo '<p style="color:blue;"> Team has been added. </p>';
    } catch (Exception $ex) {
        echo '<p style="color:red;">' . $ex->getMessage() . '</p>';
    }
}
if (isset($_POST['update'])) {

    try {
        $teamID = $_POST['teamID'];
        $teamName = $_POST['teamName'];

        $partnerTeamController->UpdateTeam($teamID, $teamName);
        echo '<p style="color:blue;"> Team has been updated! </p>';
    } catch (Exception $ex) {
        echo '<p style="color:red;">' . $ex->getMessage() . '</p>';
    }
}

if (isset($_POST['delete'])) {

    try {
        $teamID = $_POST['teamID'];

        $partnerTeamController->DeleteTeam($teamID);
        echo '<p style="color:blue;"> Team has been deleted! </p>';
    } catch (Exception $ex) {
        echo '<p style="color:red;">' . $ex->getMessage() . '</p>';
    }
}
?>
<body>
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        Create a new team: <input type="text" name='team' />
        <input name='submit' type='submit' class='btn btn-primary'/>
    </form><br><br>
    <table id="tableOfPosts" class="table table-condensed team"  style='border-collapse:collapse'>
        <thead>
            <tr><td hidden></td><td>Team ID</td><td>Team Name</td><td>Update</td><td>Delete</td></tr>
        </thead>
        <tbody>
            <?php
            $userList = $partnerTeamController->GetTeams();

            for ($row = 0; $row < count($userList); $row++) {
                echo "<tr><form name='form" . $row . " ' method='POST' action='" . $_SERVER['PHP_SELF'] . "'>";
                echo "<td hidden><input type= 'text' name='teamID' value='" . $userList[$row]->getID() . "'/></td>";
                echo "<td>" . $userList[$row]->getID() . "</td><td><input type='text' name='teamName' value='" . $userList[$row]->getTeamName() . "'/><p hidden>".$userList[$row]->getTeamName() ." </p></td>";
                echo "<td><input class='btn btn-primary' id='update' type='submit' name='update' value='Update'></td>";
                echo "<td><input class='btn btn-primary' id='delete' type='submit' name='delete' value='Delete' onclick=\"return confirm('Are you sure you want to delete ".$userList[$row]->getTeamName()."?');\"></td>";
                echo '</form></tr>';
            }
            ?>
        </tbody>
    </table>
</body>
</html>
<?php
}else{
    header('Location: Home.php');
}