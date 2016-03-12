<?php
//start session

//include_once '../Models/User_Obj.php';
//include_once (dirname('__FILE__')) . '/Logic/UserControls.php';
//
//
if(session_id()=='' || !isset($_SESSION)){
        session_start();
}

//    $userObj = new User_Obj();
//    
//
//if($userObj === null){
//    echo '<h1>no user atm...</h1>';
//}

?>
<header>
    <h3>Long Polling will not be added as it doesn't make since with the refresh.</h3>
    <nav class="navbar navbar-default">
        <ul class="basicNav">
            <li> <a href="../pages/home.php">Home</a></li>
            <li> <a href="../pages/Post_It_Manager.php" >Create Post It</a></li>
            <li> <a href="../pages/Personal_Settings.php" >Personal Settings</a></li>      
            <li> <a href="../pages/Team_User_Panel.php" >Admin Panel</a></li>
            <li> <a href="../pages/Reporting.php">Reporting</a></li>
            <li style="float:right;"> <a href="../pages/LogIn.php" class="btn" >Log in</a></li>
        </ul>
    </nav>
</header>

