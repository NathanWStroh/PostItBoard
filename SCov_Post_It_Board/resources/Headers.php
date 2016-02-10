<?php
//Start user Session
session_start();
?>

<head>
    <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
    <script src="js/bootstrap.js" type="text/javascript"></script>
</head>
<header>
    <title><?php
        if (isset($title)) {
            echo $title;
        } else {
            echo "SCov";
        }
        ?></title>
    <?php
    if (session_name() == null) {
        ?>
        <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
            Log In</button>
        <?php
    }
    ?>
</header>