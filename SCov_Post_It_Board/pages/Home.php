<?php
$title = 'Post It Board';
include_once 'Admin_Header.php';
include_once '../resources/Resource_Headers.php';
include_once '../Logic/Post_It.php';

$PostItController = new Post_It();
?>
<head>
    <script src="resources/js/TableFunctionality.js" type="text/javascript"></script>
</head>

<body>
    <div id='tooltip' class='tooltip'>
        test
    </div>
    <div id="listOfPostIts" class='panel-body'>
        <table id="tableOfPosts" class="table table-condensed" style='border-collapse:collapse' data-order='[[3,"DESC"]]'>
            <thead>
                <tr><th>Priority</th><th>Team</th><th>Partner</th><th>Entry Date/Time</th><th>Issues</th><th>Issued Rep</th><th>Status</th><th>Closure Date/Time</th></tr>
            </thead>
            <tbody>
                <?php
                
                if (isset($_SESSION['id'])) {
                    $postItArray = $PostItController->GrabPostItsByUserId($_SESSION['id']);
                }else{
                    $postItArray = $PostItController->GrabPostIts();
                }
                
                for ($row = 0; $row < count($postItArray); $row++) {
                    $status = intval($postItArray[$row]->getStatus());
                    $alert = intval($postItArray[$row]->getAlertStatus());
                    switch ($alert) {
                        case 0:
                            echo "<tr><td>standard</td>";
                            break;
                        case 1:
                            echo "<tr style='background-color:yellow;'><td>small</td>";
                            break;
                        case 2:
                            echo "<tr  style='background-color:orange;'><td>major</td> ";
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
                }
                ?>
            </tbody>
        </table>
    </div>
</html>