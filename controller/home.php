<?php

require_once('../includes/helper.php');

if (isset($_SESSION['userid'])) {
    render('home');
} else {
    render('login');
}

?>
