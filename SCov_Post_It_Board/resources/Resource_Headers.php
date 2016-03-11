<?php
//session_start();
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
<!--     **Don't seem to be loading correctly. Adding in URL links for Bootstrap to create pages.    
        <link href="../resources/css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="../resources/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <script src="js/TableFunctionality.js" type="text/javascript"></script>-->
    

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="../js/SCov_Usagebiltiy.js" type="text/javascript"></script>
    <link href="../resources/css/basic.css" rel="stylesheet" type="text/css"/>
    
    <title><?php
        if (isset($title)) {
            echo $title;
        } else {
            echo "Scov";
        }
        ?></title>
</head>