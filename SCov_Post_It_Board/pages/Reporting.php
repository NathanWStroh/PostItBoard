<?php
$title = 'Reporting';
include_once '../resources/Resource_Headers.php';
include_once '../Logic/PartnerTeamControls.php';
include_once '../Logic/Post_It.php';
include_once '../Logic/UserControls.php';
include_once '../Models/Partner_Obj.php';
include_once '../Models/SCov_PostIt_Obj.php';
include_once '../Models/Team_Obj.php';
include_once '../Models/User_Obj.php';
include_once 'Admin_Header.php';



if (isset($_SESSION['id']) && $_SESSION['role'] >= 1) {
    $postItController = new Post_It();
    $postItArray = $postItController->GrabPostIts();
    if (isset($_POST['filter'])) {
        try {
            $fromDate = $_POST['from'];
            $toDate = $_POST['to'];
            $postItArray = $postItController->FilterPostIts($fromDate, $toDate);
        } catch (Exception $ex) {
            $postItArray = $postItController->GrabPostIts();
        }
    }
    
    if (isset($_POST['export'])) {
        $output_file_name = 'PostIt_Report.csv';
        $delimiter = ',';

        $postItController->ConvertToCSV($_SESSION['displayedPostItArray'], $output_file_name, $delimiter);
    }
    ?>
    <body>
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
            <label for="from">from</label>
            <input type="text" id="from" name="from" value="<?php
            if (isset($_POST['filter'])) {
                echo $_POST['from'];
            }
            ?>"/>
            <label for="to">to</label>
            <input type="text" id="to" name ="to" value="<?php
            if (isset($_POST['filter'])) {
                echo $_POST['to'];
            }
            ?>"/>
            <input type="submit" name="filter" value="Filter" id="filter" class='btn btn-primary'/> 
            <a href='Reporting.php'><button class='btn btn-primary' type='button'>Reset</button></a>       
        </form>
        

        <div id="listOfPostIts" class='panel-body'>
            <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                <input type="submit" name="export" id="export" value="Export" style="float:right; margin-top: -49px " class='btn btn-primary'/><br>
                <table id="tableOfPosts" class="table table-condensed home" style='border-collapse:collapse' data-order='[[3,"DESC"]]'>
                    <thead>
                        <tr><th>Priority</th><th>Team</th><th>Partner</th><th>Entry Date/Time</th><th>Issues</th><th>Issued Rep</th><th>Status</th><th>Closure Date/Time</th></tr>
                    </thead>
                    <tbody>
                        <?php
                        $displayedPostItArray = Array();
                        for ($row = 0; $row < count($postItArray); $row++) {
                            $status = intval($postItArray[$row]->getStatus());
                            $alert = intval($postItArray[$row]->getAlertStatus());
                            switch ($alert) {
                                case 0:
                                    echo "<tr><td>standard</td>";
                                    break;
                                case 1:
                                    echo "<tr><td>small</td>";
                                    break;
                                case 2:
                                    echo "<tr><td>major</td> ";
                                    break;
                                default :
                                    echo "<tr><td>standard</td>";
                                    break;
                            }
                            echo '<td>' . $postItArray[$row]->getTeam() . '</td>';
                            echo '<td>' . $postItArray[$row]->getPartner() . '</td>';
                            echo '<td>' . $postItArray[$row]->getEntryDate() . '</td>';
                            echo "<td>" . $postItArray[$row]->getIssues() . '</td>';
                            echo '<td>' . $postItArray[$row]->getIssuedRep() . '</td>';
                            switch ($status) {
                                case 0:
                                    echo '<td>open</td>';
                                    break;
                                case 1:
                                    echo '<td>closed</td>';
                                    break;
                                default:
                                    echo '<td>undefined</td>';
                                    break;
                            }
                            echo '<td>' . $postItArray[$row]->getCloseDate() . '</td>';
                            
                            echo "</tr>";
                            array_push($displayedPostItArray,$postItArray[$row]);
                        }
                        $_SESSION['displayedPostItArray'] = $displayedPostItArray;
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </body>
    </html>
    <?php
} else {
    header('Location: Home.php');
}