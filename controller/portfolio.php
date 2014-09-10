<?php

require_once('../includes/helper.php');
require_once('../model/model.php');

if (!isset($_SESSION["userid"])) {
    print "Log in first";
} else {
    $userid = $_SESSION["userid"];
    $portfolio = get_user_shares($userid);
    $balance = get_balance($_SESSION['userid']);
    // Add updated last trade to the portfolio
    foreach ($portfolio as $key => $holding) {
        $current = get_quote_data($holding['symbol']);
        $portfolio[$key]['current_price'] = $current['last_trade'];
    }
    render('portfolio', array('portfolio' => $portfolio,
                              'balance' => $balance));
}

?>
