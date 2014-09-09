<!DOCTYPE html>
<html>
    <head>
        <title><?= htmlspecialchars($title) ?></title>
    </head>
    <body>
        <a href="/">Home</a><br />
<?php
if (isset($_SESSION['userid'])) {
    print "<a href='/?page=logout'>Log Out</a>";
}
?>
