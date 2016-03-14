<?php
$title = 'User Manager';
include_once '../resources/Resource_Headers.php';
include_once 'Admin_Header.php';
include_once '../Models/User_Obj.php';
include_once '../Logic/UserControls.php';

$userClass = new UserControls();
?>

<body>
    <h3></h3>
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <?php
        
        $userList = $userClass->RetrieveUsers();

        for ($row = 0; $row < count($userList); $row++) {
            echo "<input type='checkbox' name='users'";
            if ($userList[$row]->getRole() != "STANDARD USER") {
                echo "checked='true'";
            }
            echo "value='" . $userList[$row]->getId() . "'>"
            . $userList[$row]->getFirstName() . ' ' . $userList[$row]->getLastName() . "<br>";
        }
        ?>
        <button style='float:right;' type='submit' class='btn btn-primary'>Submit</button>
    </form>
</body>
</html>