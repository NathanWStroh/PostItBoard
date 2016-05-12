<?php
//session_start();
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        
        <!--   CSS    --> 
        <link href="../resources/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="../resources/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="../resources/css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="../resources/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../resources/css/basic.css" rel="stylesheet" type="text/css"/>
        
        <!--Javascript/JQuery-->
        <script src="../resources/js/jquery-1.12.1.js" type="text/javascript"></script>
        <script src="../resources/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="../resources/js/colResizable-1.5.min.js" type="text/javascript"></script>
        <script src="../resources/js/jquery-ui.js" type="text/javascript"></script>
        <script src="../resources/js/bootstrap.js" type="text/javascript"></script>
        
        <!-- Personally created JS/JQ -->
        <script src="../resources/js/SCOV_functionality.js" type="text/javascript"></script>

        
        <title><?php
            if (isset($title)) {
                echo $title;
            } else {
                echo "Scov";
            }
            ?></title>
    </head>