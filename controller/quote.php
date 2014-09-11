<?php

require_once('../model/model.php');
require_once('../includes/helper.php');

login_status();

if (isset($_GET['param'])) {
    $balance = get_balance($_SESSION['userid']);

    if ($_GET['param'] == '') {
        render('noquote', array('symbol' => '', 'balance' => $balance));
        exit();
    }



    $quote_data = get_quote_data(urlencode($_REQUEST['param']));
    
    if (!$quote_data) {
        render('noquote', array('symbol' => $_REQUEST['param'], 'balance' => $balance));
    } else {
        render('quote', array('quote_data' => $quote_data, 'balance' => $balance));
    }
} else {

    render('quote');
}


?>
