<!DOCTYPE html>

<html lang="en">
    <?php
    //include_once 'resources/SCov_Retrieval_Class.php';
    $title = 'Post It Board';
    include_once("pages/Headers.php");
    ?>
    <meta http-equiv="refresh" content="5" >
    <header>
        <a href="../pages/AdminPanel.php" class="login" >Log in</a>
    </header>
    <body>
        <table class="table table-condensed">
            <tr>
                <th>Team</th><th>Partner</th><th>Entry Date/Time</th><th>Issues</th><th>Issued Rep</th><th>Status</th><th>Closure Date/Time</th>
            </tr>
            <?php
            //won't need to create the object here as it will be writting the object to the array, then reading the cols.
//            $retrievePostIts = new $Scov_Retreva_Classl();
//            $postItList;
//            $postItList = $retrievePostIts . PostItData();
//
//            for ($row = 0; $row < $postItList . size(); $row++) {
//                echo "<tr>";
            //will need to change the condition to better reflect the col count.
//                for ($col = 0; $col < $postItList . size(); $col++) {
//                    echo "<td>" . $postItList[$row][$col] . "</td>";
//                }
//                echo "</tr>";
//            }
            ?>
</html>
