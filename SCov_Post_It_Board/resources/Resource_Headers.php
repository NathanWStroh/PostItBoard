<?php
//session_start();
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
<!--   B.    --> 
        <link href="../resources/css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="../resources/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../resources/css/basic.css" rel="stylesheet" type="text/css"/>
        <script src="../resources/js/bootstrap.js" type="text/javascript"></script>
        <script src="../resources/js/jquery-1.12.1.js" type="text/javascript"></script>
        <!-- Personally created JS/JQ -->
        <script src="../resources/js/TableFunctionality.js" type="text/javascript"></script>
        <script src="../resources/js/SCov_Usagebiltiy.js" type="text/javascript"></script>
        
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="../resources/css/basic.css" rel="stylesheet" type="text/css"/>
    
    <title><?php
        if (isset($title)) {
            echo $title;
        } else {
            echo "Scov";
        }
        ?></title>
</head>