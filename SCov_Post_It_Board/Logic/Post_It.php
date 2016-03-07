
<?php

require_once (dirname('__FILE__')) . '/DatabaseConnections/PostItConnections.php';
require_once (dirname('__FILE__')) . '/Models/SCov_PostIt_Obj.php';

class Post_It {

    function GrabPostIts() {
//        $postItObj = new SCov_PostIt_Obj();
        $postItConnection = new PostItConnections();

        $postItArray = $postItConnection->GetPostIts();
        for ($row = 0; $row < count($postItArray); $row++) {
            $status = intval($postItArray[$row]->getStatus());
            echo '<tr>';
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
            echo '</tr>';
        }
    }

    function UpdatePostIts($postItObj) {
        //see bottom function. The goal is to add to the post it table once it is all complete.
        
        $this->ComparePostItsForTableUpdate($currentPostItsList);
    }

    function CreatePostIts($postItObj) {
        $postItConnection = new PostItConnections();
        
        $postItConnection->CreatePostIt($PostItObj);
    }

    function ComparePostItsForTableUpdate($currentPostItsList) {
        $postItConnections = new PostItConnections();

        $databasePostItList = $postItConnections->GetPostIts();

        if ($databasePostItList != $currentPostItsList) {
            echo '<script>$(#PostItTable tr).detach(); </script>';

            $this->GrabPostIts();
        }
    }

}
