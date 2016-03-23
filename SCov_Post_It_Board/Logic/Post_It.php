<?php

include_once '../DatabaseConnections/PostItConnections.php';
include_once '../Models/SCov_PostIt_Obj.php';

class Post_It {

    function GrabPostIts() {
        $postItConnection = new PostItConnections();
        $postItArray = $postItConnection->GetPostIts();
        
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

//    function ConvertToCSV($postItArray, $output_file_name, $delimiter) {
//        ob_end_clean();
//        header('Content-Type: text/csv; charset=utf-8');
//        header('Content-Disposition: attachment; filename=' . $output_file_name);
//
//        $header_array = array(
//            'priority',
//            'team',
//            'partner',
//            'issue',
//            'additional info',
//            'rep',
//            'status',
//            'entry date',
//            'close date'
//        );
//
//        $csv = fopen('php://output', 'w');
//        fputcsv($csv, $header_array, $delimiter);
//
////        /** loop through array  */
//        for ($row = 0; $row < count($postItArray); $row++) {
//            $input_array = array();
//            switch ($postItArray[$row]->getAlertStatus()) {
//                case 0:
//                    array_push($input_array, 'standard');
//                    break;
//                case 1:
//                    array_push($input_array, 'small');
//                    break;
//                case 2:
//                    array_push($input_array, 'major');
//                    break;
//                default:
//                    array_push($input_array, 'standard');
//                    break;
//            }
//            array_push($input_array, $postItArray[$row]->getTeam());
//            array_push($input_array, $postItArray[$row]->getPartner());
//            array_push($input_array, $postItArray[$row]->getIssues());
//            array_push($input_array, $postItArray[$row]->getCurrentNews());
//            array_push($input_array, $postItArray[$row]->getIssuedRep());
//            if ($postItArray[$row]->getStatus() == 0) {
//                array_push($input_array, 'open');
//            } else {
//                array_push($input_array, 'closed');
//            }
//            array_push($input_array, $postItArray[$row]->getEntryDate());
//            array_push($input_array, $postItArray[$row]->getCloseDate());
//
//            /** default php csv handler * */
//            fputcsv($csv, $input_array, $delimiter);
//        }
//        exit();
//    }


}
