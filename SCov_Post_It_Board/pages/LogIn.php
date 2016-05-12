<?php
$title = 'Log In';

include_once 'Admin_Header.php';
include_once '../resources/Resource_Headers.php';
include_once '../Logic/UserControls.php';

$userController = new UserControls();

if (isset($_POST['submit'])) {

    try {
        if ($userController->GetUserInformation($_POST['username'], $_POST['password']) == true) {
            $userObj = $userController->GetUserInformation($_POST['username'], $_POST['password']);
            
            $_SESSION['id'] = $userObj->getID();
            $_SESSION['name'] = $userObj->getFirstName();
            $_SESSION['role'] = $userObj->getRole();

            
            header('Location: ./Home.php');
        }

            
    } catch (Exception $ex) {
        echo '<p style="color:red;">' . $ex->getMessage() . '</p>';
    }
}
?>

<body>
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        username: <input type='text' name='username' required="required"/><br><br>
        password: <input type='password' name='password' required="required"/><br><br>
        <input name='submit' type='submit' class='btn btn-primary'/>
    </form>

</body>
</hmtl>