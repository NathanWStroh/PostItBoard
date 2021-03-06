<?php

include_once '../DatabaseConnections/PostItConnections.php';
include_once '../Models/SCov_PostIt_Obj.php';

class Post_It {

    function GrabPostIts() {
        $postItConnection = new PostItConnections();
        $postItArray = $postItConnection->GetPostIts();

        return $postItArray;
    }
	
	function GrabPostItsForReporting(){
		$postItConnection = new PostItConnections();
        $postItArray = $postItConnection->GetPostItsForReporting();

        return $postItArray;
	}

    function GrabPostItsByUserId($userID) {
        $postItConnection = new PostItConnections();
        $postItArray = $postItConnection->GetPostItsByUserID($userID);

        return $postItArray;
    }

    function FilterPostIts($fromDate, $toDate) {
        $connection = new PostItConnections();
        $postItArray = $connection->GetPostItsWithFilter($fromDate, $toDate);

        return $postItArray;
    }

    function UpdatePostIts($postItObj) {
        $postItConnections = new PostItConnections();

        $postItConnections->UpdatePostIt($postItObj);
    }

    function CreatePostIts($postItObj) {
        $postItConnection = new PostItConnections();

        $postItConnection->CreatePostIt($postItObj);
    }

    function GetTargetPostIt($postItID) {
        $postItConnection = new PostItConnections();
        $postItObj = new PostIts();

        $postItObj = $postItConnection->GetTicket($postItID);

        return $postItObj;
    }

    function DeletePostIt($postItID) {
        $postItConnection = new PostItConnections();

        $postItConnection->DeletePostIt($postItID);
    }

    function ConvertToCSV($postItList, $output_file_name, $delimiter) {
        ob_end_clean();
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $output_file_name);

        $header_array = array(
            'priority',
            'team',
            'partner',
            'issue',
            'additional info',
            'rep',
            'status',
            'entry date',
            'close date',
            'closed rep'
        );

        $csv = fopen('php://output', 'w');
        fputcsv($csv, $header_array, $delimiter);

//        /** loop through array  */
        for ($row = 0; $row < count($postItList); $row++) {
            $input_array = array();
            switch ($postItList[$row]->getAlertStatus()) {
                case 0:
                    array_push($input_array, 'standard');
                    break;
                case 1:
                    array_push($input_array, 'small');
                    break;
                case 2:
                    array_push($input_array, 'major');
                    break;
                default:
                    array_push($input_array, 'standard');
                    break;
            }
            array_push($input_array, htmlspecialchars_decode($postItList[$row]->getTeam(), ENT_QUOTES));
            array_push($input_array, htmlspecialchars_decode($postItList[$row]->getPartner(), ENT_QUOTES));
            array_push($input_array, htmlspecialchars_decode($postItList[$row]->getIssues(), ENT_QUOTES));
            array_push($input_array, htmlspecialchars_decode($postItList[$row]->getCurrentNews(), ENT_QUOTES));
            array_push($input_array, $postItList[$row]->getIssuedRep());
            if ($postItList[$row]->getStatus() == 0) {
                array_push($input_array, 'open');
            } else {
                array_push($input_array, 'closed');
            }
            array_push($input_array, $postItList[$row]->getEntryDate());
            array_push($input_array, $postItList[$row]->getCloseDate());
            array_push($input_array, $postItList[$row]->getClosedRep());

			
			
            /** default php csv handler * */
            fputcsv($csv, $input_array, $delimiter);
        }
        exit();
    }

}
