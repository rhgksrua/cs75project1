<?php

require_once('../model/model.php');
require_once('../includes/helper.php');

if (isset($_SESSION['userid'])) {
    render('home');
    exit();
}

// Errors are added to this array
$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset($_POST['email'])) {
        $errors[] = "Please enter your username";
        $email = "";
    } else {
        $email = $_POST['email'];
    }

    if (!isset($_POST['password'])) {
        $errors[] = "Please enter your password";
    } 

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $pwdhash = hash("SHA1", $password);
        $userid = login_user($email, $password);
        if ($userid) {
            // Logged in
            $_SESSION['userid'] = $userid;
            header("Location: /?page=home");
            exit();
        } else {
            // Login failed. Show error on page
            $errors[] = "Wrong email or password";
        }    
    }

    if (!empty($errors)) {
        render('login', array('errors' => $errors, 'email' => $email));
        exit();
    }
}

render('login');

?>
