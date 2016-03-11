<?php
include_once "../resources/Resource_Headers.php";
include_once "Admin_Header.php";
include_once '../Logic/Post_It.php';
include_once '../Logic/PartnerTeamControls.php';

$title = 'Create Post It';
$postIts = new Post_It();
$partnerTeamController = new PartnerTeamControls();


if (isset($_POST['submit'])) {

    $postItObj = new PostIts();
    $postItObj->setTeam($_POST['team']);
    $postItObj->setIssuedRep($_POST['rep']);
    $postItObj->setIssues($issues);
    $postItObj->setIssues($issues);
    $postItObj->setIssues($issues);
    $postIts->CreatePostIts($postItObj);
}
?>
<body>
    <h3>Please fill out as accurately as possible.</h3> 
    <form action=''>

        Partner: <select>
            <?php
            $partnerList = $partnerTeamController->RetrievePartners();

            for ($row = 0; $row < count($partnerList); $row++) {
                echo "<option value='" . $partnerList[$row]->getID . "'>" . $partnerList[$row]->getPartnerName() . "</option>";
            }
            ?>
        </select><br><br>
        Basic Issues: <br>
        <input type="text" name='issue' placeholder='basic issue. IE: Snow outage' size='60' maxlength="60"/><br><br>
        Additional Information: <br>
        <input type='text' name='news' placeholder='More information about issues.' size='60' /><br><br>
        Post It Alert: <select> class="dropdown-menu" aria-labelledby="alertType">
            <option value="0">Standard Alert</option>
            <option value="1" style="background-color: yellow">Small Outage</option>
            <option value="2" style="background-color: orange">Major Outage</option>
        </select><br><br>
        Rep's Name: <input type="text" name='rep' placeholder='nstroh' disabled><br><br>
        Team: <input type='text' name='team' value='5' size='5' disabled/><br><br>

        <button type='submit' class='btn btn-primary'>Submit</button>   
    </form>

</body>
</html>
