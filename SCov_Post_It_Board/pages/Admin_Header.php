<?php
//start session

//require_once '../Models/User_Obj.php';
//require_once (dirname('__FILE__')) . '/Logic/UserControls.php';
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
    <h3>Need to add in logic for push notifications(long polling).</h3>
    <nav class="navbar navbar-default">
        <ul class="basicNav">
            <li> <a href="../index.php">Home</a></li>
            <li> <a href="../pages/Admin_Panel.php" >Admin Panel</a></li>
            <li> <a href="../pages/Personal_Settings.php" >Personal Settings</a></li>      
            <li> <a href="../pages/Post_It_Manager.php" >Post It Manager</a></li> 
            <li> <a href="../pages/Reporting.php">Reporting</a></li>
            <li style="float:right;"> <a href="#NotBuiltYet" class="btn" >Log in</a></li>
        </ul>
    </nav>
</header>

