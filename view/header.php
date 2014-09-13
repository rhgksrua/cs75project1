<!DOCTYPE html>
<html>
    <head>
        <title><?= htmlspecialchars($title) ?></title>
<?php 
if (isset($css)) {
    print "<link rel='stylesheet' href='css/{$css}.css'>";
}
?>
    </head>
    <body>
        <br />
        <a class="home" href="/">C$ 75 FINANCE</a><br /><br />
<?php
if (isset($_SESSION['userid'])) {
    print "<p><a href='/?page=logout'>Log Out</a></p>";
    print "<p><a href='/?page=portfolio'>Portfolio</a></p>";
    print "<p>userid: " . $_SESSION['userid'] . "</p>";
    render('addquote');
    render('user_balance');

}
?>

