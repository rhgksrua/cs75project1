<?php
require_once('../includes/helper.php');

render('header', array('title' => 'No Quote'));

if ($symbol == '') {
?>

<p>No results</p>


<?
}
?>

<p>Balance: $ <?= number_format($balance, 2) ?></p>
<p>No results for <b><?= htmlspecialchars($symbol) ?></b></p>


<?php

render('footer');


?>
