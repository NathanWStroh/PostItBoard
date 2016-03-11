<?php
include_once "../resources/Resource_Headers.php";
include_once "Admin_Header.php";
include_once '../Logic/Post_It.php';

$getPostIts = new Post_It();
?>
<body>
    <div class="container">
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
            <li><a href="#create" aria-controls="create" role="tab" data-toggle="tab" >Create New Post it</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade in active" id="home">
                <table id="tableOfPosts" class="table table-condensed" class="tablesorter">
                    <thread>
                        <th>Team</th><th>Partner</th><th>Entry Date/Time</th><th>Issues</th><th>Issued Rep</th><th>Status</th><th>Closure Date/Time</th>
                    </thread>
                    <tbody>
                        <?php
                        $postItList = $getPostIts->GrabPostIts();
                        
                        
                        ?>
                    </tbody>        
            </div>
            <div class="tab-pane fade" id="create">
                <h3>Please fill out as accurately as possible.</h3>
                <form>
                    Team: <select> 
                        <?php
                        for ($placeholderValue = 1; $placeholderValue < 6; $placeholderValue++) {
                            echo "<option value='$placeholderValue'>" . $placeholderValue . "</option>";
                        }
                        ?>
                    </select><br><br>
                    Partner: <select> class="dropdown-menu" aria-labelledby="teamDropdown">
                        <?php
                        for ($placeholderValue = 1; $placeholderValue < 6; $placeholderValue++) {
                            echo "<option> Partner: " . $placeholderValue . "</option>";
                        }
                        ?>
                    </select><br><br>
                    <input type="text" placeholder="Issues" size='60' maxlength="60"/><br><br>
                    Rep's Name: <input type="text" placeholder='will grab name via session' disabled><br><br>

                    <select> class="dropdown-menu" aria-labelledby="alertType">
                        <option value="0">Standard Alert</option>
                        <option value="1" style="background-color: yellow">Small Outage</option>
                        <option value="2" style="background-color: orange">Major Outage</option>
                        <?php
                        $timestamp = time();
                        echo "<p> Timestamp: " . (date('m/d/Y  H:i', $timestamp)) . "</p>";
                        ?>
                        <button type='submit' class='btn btn-primary'>Submit</button>   
                </form>
            </div>
        </div>
    </div>
</body>
</html>
