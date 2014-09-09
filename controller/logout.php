<?php
require_once('../includes/helper.php');

if (!isset($_SESSION['userid'])) {
    print "oops!";
} else {


    $email = $_SESSION['userid'];
    unset($_SESSION['userid']);
    session_destroy();

    render('logout', array('title' => $email));
}



?>
