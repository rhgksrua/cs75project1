<?php

require_once('../includes/helper.php');

render('header', array('title' => 'Register', 'css' => 'main'));

//show errors
if (isset($errors)) {
    foreach ($errors as $error) {
        print "<p class='error'>$error</p>";
    }
}

if (!isset($email)) {
    $email = "";
}
    

?>

<form action="/?page=register" method="post">
    <input class='input' type="text" name="email" value="<?= $email ?>" placeholder="Email">
    <br /><br />
    <input class='input' type="password" name="password" placeholder="Password">
    <br /><br />
    <input class='input' type="password" name="password2" placeholder="Verfify Password">
    <br /><br />
    <input class="loginbutton" type="submit" value="Register">
</form>

<p><a href="/?page=login">Log In</a></p>

<?php
render('footer');
?>
