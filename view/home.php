<?php
require_once('../includes/helper.php');
render('header', array('title' => 'C$75 Finance'));

if (isset($_SESSION['userid'])) {
    print "<p>userid: " . $_SESSION['userid'] . "</p>";
}
?>

<p>Balance: $ <?= number_format($balance, 2) ?></p>


<table>
    <tr>
        <td>
            <a href="/?page=portfolio">Portfolio</a></li>
        </td>
        <td>
            <a href="/?page=buy">Buy</a></li>
        </td>
        <td>
            <a href="/?page=sell">Sell</a></li>
        </td>
    </tr>
</table>

<p>Quote</p>
<form action='/?page=quote' method='post'>

    <input type='text' name='param'>
    <input type='submit' value='Get Quote'>

</form>



<?php

render('footer');
?>
