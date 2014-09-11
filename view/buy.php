<?php

require_once('../includes/helper.php');

render('header', array('title' => 'Buy Stock'));

?>
<p>Balance: $ <?= number_format($balance, 2) ?></p>
<p><?= $message ?>

<?
if (empty($message)) {
?>

    <p>Bought <?= $quantity ?> shares of <?= $symbol ?> at $<?= number_format($price, 2) ?> for a total of $<?= number_format($total, 2) ?></p>

<?
}
?>




<?
render('footer');
?>


