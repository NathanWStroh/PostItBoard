<?php
header("Refresh:60");
$title = 'Post It Board';
include_once 'Admin_Header.php';
include_once '../resources/Resource_Headers.php';
include_once '../Logic/Post_It.php';

$PostItController = new Post_It();
?>

<body>
    <div id='tooltip' class='tooltip'>

    </div>
    <div id="listOfPostIts" class='panel-body'>
        <table id="tableOfPosts" class="table table-condensed home" style='border-collapse:collapse' data-order='[[3,"DESC"]]'>
            <thead>
                <tr><th>Priority</th><th>Team</th><th>Partner</th><th>Entry Date/Time</th><th>Issues</th><th>Issued Rep</th><th>Status</th><th>Closure Date/Time</th></tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION['id'])) {
                    $postItArray = $PostItController->GrabPostItsByUserId($_SESSION['id']);
                } else {
                    $postItArray = $PostItController->GrabPostIts();
                }

                for ($row = 0; $row < count($postItArray); $row++) {
                    $status = intval($postItArray[$row]->getStatus());
                    if ($postItArray[$row]->getPartner() == 'SCov') {
                        $alertText = 'NOTICE';
                        $alertColor = '#99ddff'; //light blue
                    } else {
                        $alert = intval($postItArray[$row]->getAlertStatus());

                        switch ($alert) {
                            case 0:
                                $alertText = 'standard';
                                $alertColor = '#ffffff'; //white
                                break;
                            case 1:
                                $alertText = 'small';
                                $alertColor = '#ffd11a'; //yellow
                                break;
                            case 2:
                                $alertText = 'major';
                                $alertColor = '#ff6600'; //orange
                                break;
                            default:
                                $alertText = 'standard';
                                $alertColor = '#ffffff'; //white
                                break;
                        }
                    }


                    if ($status == 0) {
                        echo "<tr  data-toggle='tooltip' title='" . $postItArray[$row]->getCurrentNews() . "' style='background-color:" . $alertColor . ";'><td>" . $alertText . "</td>";
                    } else {
                        echo "<tr  data-toggle='tooltip' title='" . $postItArray[$row]->getCurrentNews() . "' style='background-color:white;'><td>" . $alertText . "</td>";
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