<?php
$title = 'Post It Board';
include_once 'Admin_Header.php';
include_once '../resources/Resource_Headers.php';
include_once '../Logic/Post_It.php';

$getPostIts = new Post_It();

if ($_SESSION) {
    
}
?>
<head>
    <script src="resources/js/TableFunctionality.js" type="text/javascript"></script>
</head>

<body>
    <div id="listOfPostIts">
        <table id="tableOfPosts" class="table table-condensed tablesorter">
            <thead>
                <tr><th>Team</th><th>Partner</th><th>Entry Date/Time</th><th>Issues</th><th>Issued Rep</th><th>Status</th><th>Closure Date/Time</th></tr>
            </thead>
            <tbody>
                <?php
                $getPostIts->GrabPostIts();
                ?>
            </tbody>
    </div>
</html>