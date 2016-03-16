<?php
$title = 'Super Admin';
include_once'../resources/Resource_Headers.php';
include_once 'Admin_Header.php';
include_once '../Logic/PartnerTeamControls.php';

if (isset($_SESSION['id'])&& $_SESSION['role']==2) {
    ?>
    <body>
        <h3>Work in progress. For Sam's Eyes only.</h3>

        <table id="tableOfPosts" class="table table-condensed" style='border-collapse:collapse' data-order='[[1,"asc"]]'>
            <thead>
                <tr>
                    <th>ID</th><th>Queue Name</th><th>Queue Number</th><th>SCR User ID</th><th>SCR Group Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $partners = new PartnerTeamControls();
                $partnerList = $partners->RetrievePartners();

                for ($row = 0; $row < count($partnerList); $row++) {
                    echo "<tr>";
                    echo "<td>" . $partnerList[$row]->getID() . "</td>";
                    echo "<td>" . $partnerList[$row]->getPartnerName() . "</td>";
                    echo "<td>" . $partnerList[$row]->getPartnerNumber() . "</td>";
                    echo "<td>" . $partnerList[$row]->getScrUserID() . "</td>";
                    echo "<td>" . $partnerList[$row]->getScrGroupName() . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>

        </table>

    </body>
    </html>
    <?php
} else {
    header('Location: Home.php');
}