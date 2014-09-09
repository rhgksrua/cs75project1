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
                <input type="textbox" width=16 name="email" value="<?= $email ?>">
            </td>
        </tr>
        <tr>
            <td>
                Password:
            </td>
            <td>
                <input type="password" width=16 name="password">
            </td>
        </tr>
        <tr>
            <td>
                Password Again:
            </td>
            <td>
                <input type="password" width=16 name="password2">
            </td>
        </tr>
    </table>
    <input type="submit" value="Register">
</form>

<p><a href="/?page=login">Log In</a></p>

<?php
render('footer');
?>
