<?php

require_once('../includes/helper.php');
render('header', array('title' => 'Register'));

?>

<p>Balance: $ <?= number_format($balance, 2) ?></p>

<table>
    <tr>
        <th>
            Symbol
        </th>
        <th>
            Shares
        </th>
        <th>
            Bought Price
        </th>
        <th>
            Last Trade
        </th>
    </tr>

<?php
foreach ($portfolio as $holding) {
?>
    <tr>
        <td>
            <?= $holding["symbol"] ?>
        </td>
        <td>
            <?= $holding["shares"] ?>
        </td>
        <td>
            $ <?= number_format($holding["buy_price"], 2) ?>
        </td>
        <td>
            $ <?= number_format($holding["current_price"], 2) ?>
        </td>
    </tr>

<?
}
?>

</table>
