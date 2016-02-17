<?php
include_once("../resources/Resource_Headers.php");
include_once("Admin_Header.php");
?>
<body>
    <div class="container">
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
            <li><a href="#create" aria-controls="create" role="tab" data-toggle="tab" >Create New Post it</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade in active" id="home">
                <p> Will have a list of Post It's that can be edited and have additional notes added to it.</p>                    
            </div>
            <div class="tab-pane fade" id="create">
                <h3>Please fill out as accurately as possible.</h3>
                <form>
                    Team: <select> class="dropdown-menu" aria-labelledby="teamDropdown">
                        <?php
                        for ($placeholderValue = 1; $placeholderValue < 6; $placeholderValue++) {
                            echo "<option>" . $placeholderValue . "</option>";
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
                    <textarea placeholder="Issues" cols='50'></textarea><br>
                    Rep's Name: <input type="text" placeholder='will grab name via session' disabled>
                    <p>Status</p>
                    <p>closure</p>

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
