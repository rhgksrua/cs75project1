<?php

require_once("../includes/helper.php");
render('header', array('title' => 'Not Logged In'));

?>

<p>Please <a href="/">LOG IN</a> or <a href="/?page=register">REGISTER</a><p>

<?
render('footer');
?>
