<?php

require_once('../includes/helper.php');
render('header', array('title' => 'Sell Stock'));

?>

<p>Sold <b><?= $shares ?></b> shares of <b><?= $symbol ?></b> at $<?= number_format($quote, 2) ?></p>
<p>Total added to your account: $<?= number_format($total, 2) ?> </p>
<p>Your new balance: $<?= number_format($balance, 2) ?></p>







<?php
render('footer');
?>
