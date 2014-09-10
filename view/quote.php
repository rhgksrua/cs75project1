<?php
require_once('../includes/helper.php');
if (!isset($quote_data["symbol"])) {
    render('header', array('title' => 'Quote'));
    print "No symbol was provided, or no quote data was found.";
} else {
    render('header', array('title' => 'Quote for ' . htmlspecialchars($quote_data["symbol"])));
?>


<table>
    <tr>
        <th>Symbol</th>
        <th>Name</th>
        <th>Last Trade</th>
        <td>Quantity</td>
    </tr>
    <tr>
        <td><?= htmlspecialchars($quote_data["symbol"]) ?></td>
        <td><?= htmlspecialchars($quote_data["name"]) ?></td>
        <td><?= htmlspecialchars($quote_data["last_trade"]) ?></td>
    <form action='/?page=buy&symbol=<?= $quote_data["symbol"] ?>' method='post'>
        <td><input type='text' name='quantity'></td>
        <td><input type='submit' value='buy'></td>
    </form>
    </tr>
</table>

<?php
}

render('footer');
?>
