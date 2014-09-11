<?php

require_once('../includes/helper.php');
require_once('../model/model.php');

// User not logged in
login_status();

if (isset($_GET['symbol'])) {

    $sold = sell_share($_GET['symbol'], $_SESSION['userid']);
    if (isset($sold)) {
        $symbol = $sold['stock']['symbol'];
        $shares = $sold['stock']['shares'];
        $quote = $sold['price'];
        $total = $quote * $shares;
        $balance = get_balance($_SESSION['userid']);
        render('sell', array('symbol' => $symbol, 'shares' => $shares, 'quote' => $quote, 'total' => $total, 'balance' => $balance));
        exit();
    } else {
        print "Error";
    }

} else {
    header("Location: /?page=portfolio");
    exit();
}
        
    

?>
