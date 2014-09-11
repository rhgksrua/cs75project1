<?php

require_once('../model/model.php');
require_once('../includes/helper.php');

login_status();


if (!is_numeric($_POST['quantity'])) {
    header("Location: /?page=quote&param={$_GET['symbol']}");
    exit();
}




if (!isset($_GET['symbol'])) {
    header("Location: /?page=quote");
    exit();
} else if ($_POST['quantity'] <= 0 ) {
    header("Location: /?page=quote&param={$_GET['symbol']}");
    exit();
} else {
    $price = add_shares($_GET['symbol'], $_POST['quantity'], $_SESSION['userid']);

    $balance = get_balance($_SESSION['userid']);

    if (isset($price) && $price['price'] == "balance") {
        render('buy', array('symbol' => '', 'price' => '', 'message' => 'Not enough balance', 'total' => '', 'balance' => $balance
        ));
        exit();
    } else if (isset($price)) {
        render('buy', array('quantity' => $_POST['quantity'], 'message' => '', 'symbol' => $_GET['symbol'], 'price' => $price['price'], 'total' => $price['total'], 'balance' => $balance
        ));
        exit();
    } else {
        print "error";
    }

}

?>
