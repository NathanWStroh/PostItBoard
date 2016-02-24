<?php
    //include_once 'resources/SCov_Retrieval_Class.php';
    $title = 'Post It Board';
    include_once("resources/Resource_Headers.php");
    ?>
    <!--<meta http-equiv="refresh" content="10" >-->
    <header>
        <a href="../pages/Admin_Panel.php" class="login" >Log in</a>
    </header>
    <body>
        <table class="table table-condensed">
            <thread>
                <th>Team</th><th>Partner</th><th>Entry Date/Time</th><th>Issues</th><th>Issued Rep</th><th>Status</th><th>Closure Date/Time</th>
            </thread>
            <tbody>
                <tr data-toggle="collapse" data-target="#1" class="clickable" bgcolor="red">
                    <td>5</td><td>Great Plains</td><td>11:30:15 Wed Feb 17, 2016</td><td>Bad weather causing outages</td><td>N Stroh</td><td>Open</td><td></td>
                </tr>
                <tr>
                    <td colspan="7">
                        <div id="1" class="collapse">Testing information for table row.</div>
                    </td>
                </tr>
            </tbody>
            <?php
            //creates collapsible table rows to allow for additional information.
//            $retrievePostIts = new $Scov_Retreva_Classl();
//            $postItList;
//            $postItList = $retrievePostIts . PostItData();
//
//            for ($row = 0; $row < $postItList . size(); $row++) {
//                //will need to add a way for the <tr line to add colors.
//                ?>
                <tbody>
                    <tr data-toggle="collapse" dtat-target="<?php //'#row' . $row ?>" class="clickable" bgcolor="">
                        <?php
//                        for ($col = 0; $col < 7; $col++) {
//                            echo "<td>" . $postItList[$row][$col] . "</td>";
//                        }
//                        ?>
                    </tr></tbody>
                <tr>
                    <td colspan="7">
                        <div id="<?php //'row' . $row ?>">                        
                            //<?php
//                            //additional information for current updates.
//                            echo '</div>';
//                            echo '</td>';
//                            echo '</tr>';
//                        }
//                        ?>

                        </html>