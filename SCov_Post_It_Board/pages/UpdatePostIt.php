<?php
$title = 'Update Post It';
include_once 'Admin_Header.php';
include_once '../resources/Resource_Headers.php';
include_once '../Logic/Post_It.php';

if (isset($_SESSION['id'])) {

    $PostItController = new Post_It();

    if (isset($_POST['delete'])) {
        try {
            $postItID = $_POST['postItID'];
            $PostItController->DeletePostIt($postItID);

            echo '<p style="color:blue;"> Post It has been deleted! </p>';
        } catch (Exception $ex) {
            echo '<pstyle="color:red;">' . $ex->getMessage() . '</p>';
        }
    }
    ?>
    <head>
        <script src="resources/js/TableFunctionality.js" type="text/javascript"></script>
    </head>

    <body>
        <div id="listOfPostIts">
            <table id="tableOfPosts" class="table table-condensed updatePageTable" style='border-collapse:collapse' data-order='[[3,"DESC"]]'>
                <thead>
                    <tr><th hidden></th><th>Team</th><th>Partner</th><th>Entry Date/Time</th><th>Issues</th><th>Issued Rep</th><th>Status</th><th>Closure Date/Time</th><th>Edit</th>
                        <?php if ($_SESSION['role'] >= 1) {
                            echo '<th>Delete</th>';
                        } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $postItArray = $PostItController->GrabPostIts();

                    for ($row = 0; $row < count($postItArray); $row++) {
                        $status = intval($postItArray[$row]->getStatus());
                        $alert = intval($postItArray[$row]->getAlertStatus());
                        switch ($alert) {
                            case 0:
                                echo "<tr>";
                                break;
                            case 1:
                                echo "<tr style='background-color:yellow;'>";
                                break;
                            case 2:
                                echo "<tr  style='background-color:orange;'>";
                                break;
                            default :
                                echo "<tr>";
                                break;
                        }
                        echo "<form name='form" . $row . "' method='POST' action='" . $_SERVER['PHP_SELF'] . "'>";
                        echo "<td hidden><input type= 'text' name='postItID' value='" . $postItArray[$row]->getPostItID() . "'/></td>";
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
                        echo "<td><a href='Post_It_Manager.php?id=" . $postItArray[$row]->getPostItID() . "'><button type='button'>Edit</button></a></td>";
                        if ($_SESSION['role'] >= 1) {
                            echo "<td><input id='delete' type='submit' name='delete' value='Delete' onclick=\"return confirm('Are you sure you want to delete?');\"></td>";
                        }
                        echo "</form></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </html>
    <?php
} else {
    header('Location: Home.php');
}