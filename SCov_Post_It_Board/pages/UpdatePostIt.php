<?php
$title = 'Update Post It';
include_once 'Admin_Header.php';
include_once '../resources/Resource_Headers.php';
include_once '../Logic/Post_It.php';

$getPostIts = new Post_It();

//if (isset($_POST['edit'])) {
//   
//}
//?>
<head>
    <script src="resources/js/TableFunctionality.js" type="text/javascript"></script>
</head>

<body>
    <p>***Will more than likely do a page refresh if time doesn't allow for partial page refresh.</p>
    <div id="listOfPostIts">
        <table id="tableOfPosts" class="table table-condensed tablesorter">
            <thead>
                <tr><th>Team</th><th>Partner</th><th>Entry Date/Time</th><th>Issues</th><th>Issued Rep</th><th>Status</th><th>Closure Date/Time</th><th>Edit</th></tr>
            </thead>
            <tbody>
                <?php
                $postItArray = $getPostIts->GrabPostIts();

                for ($row = 0; $row < count($postItArray); $row++) {
                    $status = intval($postItArray[$row]->getStatus());
                    $alert = intval($postItArray[$row]->getAlertStatus());
                    switch ($alert) {
                        case 0:
                            echo '<tr>';
                            break;
                        case 1:
                            echo  "<tr bgcolor='yellow'> ";
                            break;
                        case 2:
                            echo "<tr bgcolor='orange'> ";
                            break;
                        default :
                            echo '<tr>';
                            break;
                    }
                    echo "<form method='LINK' action='Post_It_Manager.php?id=".$postItArray[$row]->getPostItID()."'>";
                    echo '<td>' . $postItArray[$row]->getTeam() . '</td>';
                    echo '<td>' . $postItArray[$row]->getPartner() . '</td>';
                    echo '<td>' . $postItArray[$row]->getEntryDate() . '</td>';
                    echo '<td>' . $postItArray[$row]->getIssues() . '</td>';
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
                    echo '<td>' . $postItArray[$row]->getCloseDate();
                    echo "<td><a href='Post_It_Manager.php?id=".$postItArray[$row]->getPostItID()."'><button type='button'>edit</button></a></td>";
                    echo '</form></tr>';
                }
                ?>
            
            </tbody>
    </div>
</html>