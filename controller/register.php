<?php

require_once('../model/model.php');
require_once('../includes/helper.php');

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Email validation
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];
        // REGEX.  Only checks for '@' in the email.
        //if (!preg_match('/.+\@.+/', $email)) {
        if (!preg_match('/\w+/', $email)) {
            $errors[] = 'Invalid email';
        } else if (email_exists($email)) {
            $errors[] = 'Email already exists';
        } 
    } else {
        $errors[] = "Need to enter email";
    }

    // Password validation
    if (isset($_POST['password']) && isset($_POST['password2']) && !empty($_POST['password']) && !empty($_POST['password'])) {
        if ($_POST['password'] != $_POST['password2']) {
            $errors[] = 'Password does not match';
        } 
    } else {
        $errors[] = "Need to enter passwords";
    }


    // $erros contain all the errors in the registration page.
    // If not empty, sends user to registration page.
    if (empty($errors)) {
        $userid = add_user($_POST['email'], $_POST['password']);
        if ($userid) {
            $_SESSION['userid'] = $userid;
            render('home');
            exit();
        } else {
            // failed to add to database
            $errors[] = "Database Error";
            render('register', array('errors' => $errors, 'email' => $_POST['email']));
            exit();
        }
    } else {
        render('register', array('errors' => $errors, 'email' => $_POST['email']));
        exit();
    }

} else {
    render('register');
    exit();
}

?>
