<?php
$title = 'Admin';
include_once '../resources/Resource_Headers.php';
include_once 'Admin_Header.php';
include_once '../Models/Team_Obj.php';
include_once '../Models/User_Obj.php';
include_once '../Logic/PartnerTeamControls.php';
include_once '../Logic/UserControls.php';

$partnerTeamController = new PartnerTeamControls();
?>

<body>
    <div class="container">
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#user" aria-controls="user" role="tab" data-toggle="tab">User Manager</a></li>
            <li><a href="#team" aria-controls="team" role="tab" data-toggle="tab" >Team Manager</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade" id="user">
            <p>Clicked members are admins. If you don't see a user. they are</p>
            <form action='home.php'>
                <?php
            $userClass = new UserControls();
            $userList = $userClass->RetrieveUsers();

            for ($row = 0; $row < count($userList); $row++) {
                echo "<input type='checkbox' ";
                if ($userList[$row]->getRole() === "STANDARD USER") {
                    echo "checked='true'";
                }
                echo "value='" . $userList[$row]->getId() . "'>"
                . $userList[$row]->getUsername() . "<br>";
            }            
            ?>
            <button style='float:right;' type='submit' class='btn btn-primary'>Submit</button>
            </form>
        </div>
        <div class="tab-pane fade" id="team">
            <form>
            <table class="table table-condensed tablesorter">
                <thead>
                    <tr>
                        <td>Team ID</td>
                        <td>Team Name</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $teamList = $partnerTeamController->GetTeams();

                    for ($row = 0; $row < count($teamList); $row++) {
                        echo '<tr>';
                        echo "<td>" . $teamList[$row]->getID() . "</td><td>" . $teamList[$row]->getTeamName() . "</td>";
                        echo "<td><input type='button' name='' value='edit'</td>";
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <button style='float:right;' type='submit' class='btn btn-primary'>Submit</button>
        </form>
        </div>
    </div>
</body>
</html>