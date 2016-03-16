<?php
$title = 'Personal Settings';
include_once'../resources/Resource_Headers.php';
include_once 'Admin_Header.php';
include_once '../Logic/PartnerTeamControls.php';
include_once '../Logic/UserControls.php';

if (isset($_SESSION['id'])) {
?>
<body>
    <h3>Select the partners you would like to see on the post it board.</h3>
        <table id="tableOfPosts" class="table table-condensed">
        <thead>
            <tr><td hidden></td><td>Partner Name</td><td>Show/Hide</td></tr>
        </thead>
        <tbody>
            <?php
        $partners = new PartnerTeamControls();
        $partnerList = $partners->RetrievePartners();

            for ($row = 1; $row < count($partnerList); $row++) {
                echo "<tr><form name='form" . $row . " ' method='POST' action='" . $_SERVER['PHP_SELF'] . "'>";
                echo "<td hidden><input type= 'text' name='partnerID' value='" . $partnerList[$row]->getID() . "'/></td>";
                echo "<td>".$partnerList[$row]->getPartnerName() . "</td>";
                
                if($partnerList[$row]->getPartnerName()){
                    
                }
                echo "<td><input id='update' type='submit' name='update' value='update'></td>";
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