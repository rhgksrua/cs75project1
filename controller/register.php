<?php

require_once('../model/model.php');
require_once('../includes/helper.php');

if (isset($_SESSION['userid'])) {
    print "Log out first please";
    exit();
}

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Email validation
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];
        // REGEX.  Only checks for '@' in the email.
        //if (!preg_match('/.+\@.+/', $email)) {
        if (!preg_match('/^[\w\d]+\@[\w\d]+(\.\w+)+$/', $email)) {
            $errors[] = 'Invalid email';
        } else if (email_exists($email)) {
            $errors[] = 'Email already exists';
        } 
    } else {
        $errors[] = "Need to enter email";
    }

    // Password validation
    if (isset($_POST['password']) && isset($_POST['password2']) && !empty($_POST['password']) && !empty($_POST['password'])) {
        if (strlen($_POST['password']) < 6) {
            $errors[] = 'Password needs to be at least 6 letters in length';
        }

        // Check if all numbers or all letters.
        if (ctype_alpha($_POST['password']) || ctype_digit($_POST['password'])) {
            $errors[] = 'Password must contain at least a letter and a digit';
        } 
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
            $balance = get_balance($_SESSION['userid']);
            render('home', array('balance' => $balance));
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
