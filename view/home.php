<?php
require_once('../includes/helper.php');
render('header', array('title' => 'C$75 Finance'));

if (isset($_SESSION['userid'])) {
    print "<p>userid: " . $_SESSION['userid'] . "</p>";
}
?>

<p>Balance: $ <?= number_format($balance, 2) ?></p>


<a href="/?page=portfolio">Portfolio</a></li>

<form action='/' method='get'>

    <label>Quote</label>
    <input type='text' name='param' maxlength="6" size="8">
    <input type='hidden' name='page' value='quote'>
    <input type='submit' value='Get Quote'>

</form>



<?php

render('footer');
?>
