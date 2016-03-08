<?php
include_once'../resources/Resource_Headers.php';
include_once 'Admin_Header.php';
include_once '../DatabaseConnections/UserConnections.php';
//include_once("../Logic/UserControls.php");
?>
<body>
    <H3>Personal settings. This will meet the requirement to allow users to hide/show partners accordingly.</H3>
    <p>The idea is to have this page will pull up a list of partners with check boxes. Each check box will change up what the user sees.</p>
    <form>
        <?php
//            $partners = new UserControls();
//            $partnerList = $partners->RetrievePartners();
//            foreach($partnerList as $partner){
//                echo "<input type='checkbox' value='$partner'>$partner <br>";
//            }
        $partners = new UserConnections();
        $partnerList = $partners->RetrievePartnerList();
        
        foreach($partnerList as $partner){
                echo "<input type='checkbox' value='$partner'>$partner <br>";
            }
        ?>
        <input type='submit' value='Submit'>
    </form>
</body>
</html>