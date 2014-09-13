<?php
require_once('../includes/helper.php');
if (!isset($quote_data["symbol"])) {
    render('header', array('title' => 'Quote', 'css' => 'home'));
} else {
    render('header', array('title' => 'Quote for ' . htmlspecialchars($quote_data["symbol"]), 'css' => 'home'));

?>


<p>Balance: $ <?= number_format($balance, 2) ?></p>

<form action='/?page=buy&amp;symbol=<?= $quote_data["symbol"] ?>' method='post'>
<table>
    <tr>
        <th>Symbol</th>
        <th>Name</th>
        <th>Last Trade</th>
        <th>Quantity</th>
    </tr>
    <tr>
        <td><?= htmlspecialchars($quote_data["symbol"]) ?></td>
        <td><?= htmlspecialchars($quote_data["name"]) ?></td>
        <td><?= htmlspecialchars($quote_data["last_trade"]) ?></td>
        <td><input id='quantity' type='text' name='quantity'></td>
        <td><input id='submit' type='submit' value='buy'></td>
    </tr>
</table>
</form>

<script src="js/quote.js"></script>

<?php
}

render('footer');
?>
