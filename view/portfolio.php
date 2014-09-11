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
        <th>
            Sell All

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

        <td>
            <form action='/?page=sell&amp;symbol=<?= $holding['symbol'] ?>' method='post'>
                <input type='submit' value='sell'>
            </form>
        </td>

    </tr>

<?
}
?>

</table>


<p>Total value during purchase: <b>$ <?= number_format($total_bought_cost, 2) ?></b></p>
<p>Current value of holdings: <b>  $ <?= number_format($total_value, 2) ?></b></p>

<?

//render('addquote');

render('footer');
?>
