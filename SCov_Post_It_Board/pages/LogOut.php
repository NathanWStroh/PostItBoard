<?php
session_start();
session_destroy(); //clean session information.

unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['role']);

header('Location: home.php');