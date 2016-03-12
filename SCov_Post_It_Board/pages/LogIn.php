<?php
$title = 'Log In';

include_once 'Admin_Header.php';
include_once '../resources/Resource_Headers.php';
include_once '../Logic/Post_It.php';
?>

<body>
    <form>
        username: <input type='text' name='username' required="true"/><br><br>
        password: <input type='password' required="true"/><br><br>
        <input type="submit" />
    </form>

</body>
</hmtl>