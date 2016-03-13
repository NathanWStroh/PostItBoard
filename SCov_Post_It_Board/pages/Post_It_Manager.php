<?php
$title = 'Create Post It';
include_once "../resources/Resource_Headers.php";
include_once "Admin_Header.php";
include_once '../Logic/Post_It.php';
include_once '../Logic/PartnerTeamControls.php';


$postIts = new Post_It();
$partnerTeamController = new PartnerTeamControls();


if (isset($_POST['submit'])) {

//    foreach ($_POST as $name => $val) {
//        echo htmlspecialchars($name . ': ' . $val) . "\n";
//    }
    
    //if exists, do update instead of create

    $postItObj = new PostIts();
    $postItObj->setTeam($_POST['team']);
    $postItObj->setPartner($_POST['partner']);
    $postItObj->setIssuedRep('nstroh'); //change to $_Session:username when $_Session is set.
    $postItObj->setIssues($_POST['issue']);
    $postItObj->setCurrentNews($_POST['news']);
    $postItObj->setAlertStatus($_POST['alert']);
    $postItObj->setStatus(0);

    try {
        $postIts->CreatePostIts($postItObj);
        echo '<h3> Ticket has been added. </h3>';
    } catch (Exception $ex) {
        echo '<h3>' . $ex->getMessage() . '</h3>';
    }
}
if(isset($_GET['id'])){
//    $postIts->
    
    
}

?>
<body>
    <h3>Please fill out as accurately as possible.</h3> 
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        Team: <select name='team'>
<?php
$teamList = $partnerTeamController->GetTeams();

for ($row = 1; $row < count($teamList); $row++) {
    echo "<option value='" . $teamList[$row]->getID() . "'>" . $teamList[$row]->getID() . ': ' . $teamList[$row]->getTeamName() . "</option>";
}
?>
        </select><br><br>
        Partner: <select name='partner'>
<?php
$partnerList = $partnerTeamController->RetrievePartners();

for ($row = 0; $row < count($partnerList); $row++) {
    echo "<option value='" . $partnerList[$row]->getPartnerName() . "'>" . $partnerList[$row]->getPartnerName() . "</option>";
}
?>
        </select><br><br>
        Basic Issues: <br>
        <input required='true' type="text" name='issue' placeholder='basic issue. IE: Snow outage' size='60' maxlength="60"/><br><br>
        Additional Information: <br>
        <input required='true' type='text' name='news' placeholder='More information about issues.' size='60' /><br><br>
        Post It Alert: <select name='alert'> class="dropdown-menu" aria-labelledby="alertType">
            <option value="0">Standard Alert</option>
            <option value="1" style="background-color: yellow">Small Outage</option>
            <option value="2" style="background-color: orange">Major Outage</option>
        </select><br><br>

        <input name='submit' type='submit' class='btn btn-primary'/>   
    </form>

</body>
</html>
