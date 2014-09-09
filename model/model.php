<?php

include("../../pw.php");

define('DB_HOST', 'localhost');
define('DB_USER', 'hankoh');
define('DB_PASSWORD', $pw);
define('DB_DATABASE', 'project1');

function add_user($email, $pwdhash) {
	$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_DATABASE;
	$dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
    $stmt = $dbh->prepare("INSERT INTO users (email, password, registration_date) VALUES (:email, :pwdhash, NOW())");
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':pwdhash', $pwdhash, PDO::PARAM_STR);
    if ($stmt->execute()) {
        if ($stmt->rowCount() == 1) {
            return True;
        } else {
            return False;
        }
    } else {
        return False;
    }

}

function email_exists($email) {

    // Connect to DB
	$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_DATABASE;
	$dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
	
    $stmt = $dbh->prepare("SELECT email FROM users WHERE email=:email");
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    if ($stmt->execute()) {
        $row = $stmt->rowCount();
        if ($row == 0) {
            $userid = False;
        } else {
            $userid = True;
        }
    } 
    $dbn = null;
	return $userid;
}

function login_user($email, $password)
{
	// prepare email address and password hash for safe query
	$email = mysql_escape_string($email);
	$pwdhash = $password; //hash("SHA1",$password);

	$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_DATABASE;
	$dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
	
    $stmt = $dbh->prepare("SELECT id FROM users WHERE email=:email AND password=:pwdhash");
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':pwdhash', $pwdhash, PDO::PARAM_STR);
    if ($stmt->execute()) {
        $row = $stmt->rowCount();
        if ($row == 0) {
            $userid = False;
        } else {
            $userid = True;
        }
    } 
        
    $dbn = null;
	return $userid;
}

function get_user_shares($userid)
{
	// connect to database with PDO
	$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_DATABASE;
	$dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
	
	// get user's portfolio
	$stmt = $dbh->prepare("SELECT symbol, shares, buy_price FROM portfolios WHERE userid=:userid");
	$stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
	if ($stmt->execute())
	{
	    $result = array();
	    while ($row = $stmt->fetch()) {
			array_push($result, $row);
	    }
		$dbh = null;
		return $result;
	}
	
	// close database and return null 
	$dbh = null;
	return null;
}

