<?php

require_once('../includes/helper.php');
require_once('../model/model.php');

login_status();


$userid = $_SESSION["userid"];
$portfolio = get_user_shares($userid);
$balance = get_balance($_SESSION['userid']);
// Add updated last trade to the portfolio
$total_value = 0;
$total_bought_cost = 0;
// temporary holder for quoted price (last_trade)
$quoted_price = array();
foreach ($portfolio as $key => $holding) {
    if (isset($quoted_price[$holding['symbol']])) {
        $current = $quoted_price[$holding['symbol']];
    } else {
        $raw_current = get_quote_data($holding['symbol']);
        $quoted_price[$holding['symbol']] = $raw_current['last_trade'];
        $current = $raw_current['last_trade'];
    }

    // $current = get_quote_data($holding['symbol']);
    $portfolio[$key]['current_price'] = $current;
    $total_value += ($current * $holding['shares']);
    $total_bought_cost += ($holding['buy_price'] * $holding['shares']);
}

// Total value of holdings
    
render('portfolio', array('portfolio' => $portfolio,
                          'balance' => $balance,
                          'total_value' => $total_value,
                          'total_bought_cost' => $total_bought_cost 
));


?>
