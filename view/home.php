<?php
require_once('../includes/helper.php');

login_status();

render('header', array('title' => 'C$75 Finance', 'css' => 'home'));

?>

<p>Balance: $ <?= number_format($balance, 2) ?></p>

<?php

render('footer');
?>
