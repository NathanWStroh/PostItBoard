<?php
$title = 'Admin';
include_once '../resources/Resource_Headers.php';
include_once 'Admin_Header.php';
include_once '../Models/Team_Obj.php';
include_once '../Logic/PartnerTeamControls.php';


$partnerTeamController = new PartnerTeamControls();
?>
<body>
<body>
    <div class="container">
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#user" aria-controls="user" role="tab" data-toggle="tab">User Manager</a></li>
            <li><a href="#team" aria-controls="team" role="tab" data-toggle="tab" >Team Manager</a></li>
        </ul>
    </div>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="user">
               
            </div>
            <div class="tab-pane fade" id="team">
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
               
                for($row=0;$row < count($teamList);$row++){
                    echo '<tr>';
                    echo "<td>".$teamList[$row]->getID()."</td><td>".$teamList[$row]->getTeamName()."</td>";
                    echo '</tr>';
                }
            ?>
                    </tbody>
                    </table>
            </div>
        </div>
</body>
</html>