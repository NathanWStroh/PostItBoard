<?php
session_start();
?>

<header>
    <nav class="navbar navbar-default">
        <ul class="basicNav">
            <li> <a href="../pages/Home.php">Home</a></li>
            <?php
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] >= 0) {
                    echo '<li> <a href="../pages/Post_It_Manager.php" >Create Post It</a></li>';
                    echo '<li> <a href="../pages/UpdatePostIt.php">Update Post It</a></li>';
                    echo '<li> <a href="../pages/Personal_Settings.php" >Personal Settings</a></li>';
                }
                if ($_SESSION['role'] >= 1) {
                    echo '<li> <a href="../pages/User_Manager.php" >User Panel</a></li>';
                    echo '<li> <a href="../pages/Team_Manager.php" >Team Panel</a></li>';
                }
                if ($_SESSION['role'] >= 2) {
                    echo '<li> <a href="../pages/Reporting.php">Reporting</a></li>';
                }
                if ($_SESSION['role'] == 3) {
                    echo '<li> <a href="../pages/Admin_Partner_Controls.php">Partner Controls</a></li>';
                }
                echo '<li style="float:right;"><a href="../pages/LogOut.php" class="btn" >Log Out</a></li><li style="float:right;"><span class="welcome">Welcome, ' . $_SESSION['name'] . '.</span></li>';
            } else {
                echo '<li style="float:right;"><a href="../pages/LogIn.php"  >Log In</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>

