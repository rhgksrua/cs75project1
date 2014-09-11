<!DOCTYPE html>
<html>
    <head>
        <title><?= htmlspecialchars($title) ?></title>
    </head>
    <body>
        <a href="/">Home</a><br />
<?php
if (isset($_SESSION['userid'])) {
    print "<p><a href='/?page=logout'>Log Out</a></p>";
    print "<p><a href='/?page=portfolio'>Portfolio</a></p>";
    print "<p>userid: " . $_SESSION['userid'] . "</p>";
    render('addquote');
    render('user_balance');

}
?>

