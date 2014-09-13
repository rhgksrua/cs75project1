<?php
require_once('../includes/helper.php');
render('header', array('title' => 'Log In', 'css' => 'main'));

//show errors
if (isset($errors)) {
    foreach ($errors as $error) {
        print "<p class='error'>$error</p>";
    }
}

if (!isset($email)) {
    $email = "''";
}

?>

<form action="/?page=login" method="post">
    <input class='input' id="focus" type="text" name="email" value='<?= $email ?>' placeholder="Email">
    <br /><br />
    <input class='input' type="password" name="password" placeholder="Password">
    <br /><br />
    <input class="loginbutton" type="submit" value="Log In">
</form>

<p><a href="/?page=register">Register</a></p>

<?php
render('footer');
?>
