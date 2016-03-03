<?php
//include_once 'resources/SCov_Retrieval_Class.php';
$title = 'Post It Board';
require 'pages/Admin_Header.php';
require 'resources/Resource_Headers.php';
require 'Logic/Post_It.php';
//require 'DatabaseConnections/PostItConnections.php';
//require 'DatabaseConnections/DBConnection.php';

$getPostIts = new Post_It();
?>
<!--<meta http-equiv="refresh" content="10" >-->
<body>
    <table class="table table-condensed">
        <thread>
            <th>Team</th><th>Partner</th><th>Entry Date/Time</th><th>Issues</th><th>Issued Rep</th><th>Status</th><th>Closure Date/Time</th>
        </thread>
        <tbody>
            <?php
            $getPostIts->GrabPostIts();
            ?>
        </tbody>
        <script>
            setInterval = (function, 1000);
        </script>
    </html>