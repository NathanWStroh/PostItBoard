<?php
include_once("../resources/Resource_Headers.php");
include_once("Admin_Header.php");
include_once("../Logic/UserControls.php");
?>
<body>
    <H3>Personal settings. This will meet the requirement to allow users to hide/show partners accordingly.</H3>
    <p>The idea is to have this page will pull up a list of partners with check boxes. Each check box will change up what the user sees.</p>
    <form action='UserControls.php'> <!-- will need to be updated to reflect the proper action for the partner call -->
        <input type="checkbox">Great Plains Communication</br>
        <input type="checkbox">GRM</br>
        <input type="checkbox">TelAlaska</br>
        <?php
//            $partners = new UserControls();
//            $partnerList = $partners->RetrievePartners();
//            foreach($partnerList as $partner){
//                echo "<input type='checkbox' value='$partner'>$partner <br>";
//            }
        ?>
        <input type='submit' value='Submit'>
    </form>
</body>
</html>