<?php
$title = 'Personal Settings';
include_once'../resources/Resource_Headers.php';
include_once 'Admin_Header.php';
include_once '../Logic/PartnerTeamControls.php';
?>
<body>
    <h3>Select the partners you would like to see on the post it board.</h3>
    <form id='partners'>
        <?php
        $partners = new PartnerTeamControls();
        $partnerList = $partners->RetrievePartners();
        
        for($row = 0; $row < count($partnerList); $row++){
            echo "<input type='checkbox' checked='true' "                
            . "value='". $partnerList[$row]->getId()."'>"
            .$partnerList[$row]->getPartnerName()."<br>";
            }
        ?>
        <input type='submit' value='Submit'>
    </form>
</body>
</html>