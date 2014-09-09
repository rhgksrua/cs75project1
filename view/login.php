<?php
require_once('../includes/helper.php');
render('header', array('title' => 'Log In'));

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

<form action="/?page=login" method="post">
    <table>
        <tr>
            <td>
                Email:
            </td>
            <td>
                <input type="textbox" width=16 name="email" value=<?= $email ?>>
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
    </table>
    <input type="submit" value="Log In">
</form>

<p><a href="/?page=register">Register</a></p>

<?php
render('footer');
?>
