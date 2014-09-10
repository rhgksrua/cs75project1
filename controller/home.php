<?php

require_once('../includes/helper.php');
require_once('../model/model.php');

if (isset($_SESSION['userid'])) {
    $balance = get_balance($_SESSION['userid']);
    render('home', array('balance' => $balance));
} else {
    render('login');
}

?>
