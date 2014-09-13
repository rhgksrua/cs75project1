<?php

require_once('../includes/helper.php');

render('header', array('title' => 'Register'));

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
    <table>
        <tr>
            <td>
                Email:
            </td>
            <td>
                <input class='input' type="text" name="email" value="<?= $email ?>">
            </td>
        </tr>
        <tr>
            <td>
                Password:
            </td>
            <td>
                <input class='input' type="password" name="password">
            </td>
        </tr>
        <tr>
            <td>
                Password Again:
            </td>
            <td>
                <input class='input' type="password" name="password2">
            </td>
        </tr>
    </table>
    <input type="submit" value="Register">
</form>

<p><a href="/?page=login">Log In</a></p>

<?php
render('footer');
?>
