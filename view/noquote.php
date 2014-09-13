<?php
require_once('../includes/helper.php');

render('header', array('title' => 'No Quote', 'css' => 'home'));

if ($symbol == '') {
?>

<p>No results</p>


<?
}
?>

<p>Balance: $ <?= number_format($balance, 2) ?></p>
<p><?= htmlspecialchars($symbol) ?></p>
<p>Cannot retrieve quote</p>


<?php

render('footer');


?>
