<?php

include("../../pw.php");

define('DB_HOST', 'localhost');
define('DB_USER', $user);
define('DB_PASSWORD', $pw);
define('DB_DATABASE', 'project1');

function get_quote_data($symbol) {
    $result = array();
    $url = "http://download.finance.yahoo.com/d/quotes.csv?s={$symbol}&f=sl1n&e=.csv";
    $handle = fopen($url, "r");
    if ($row = fgetcsv($handle))
        if (isset($row[1]))
            $result = array("symbol" => $row[0], 
                            "last_trade" => $row[1],
                            "name" => $row[2]);
    fclose($handle);
    return $result;
}

function get_balance($userid) {
	$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_DATABASE;
	$dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
	
	// get user's portfolio
	$stmt = $dbh->prepare("SELECT balance FROM users WHERE id=:userid");
	$stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
	if ($stmt->execute())
	{
	    $row = $stmt->fetch();
		$dbh = null;
		return $row[0];
	}
	
	// close database and return null 
	$dbh = null;
	return null;

}

function get_user_shares($userid)
{
	// connect to database with PDO
	$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_DATABASE;
	$dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
	
	// get user's portfolio
	$stmt = $dbh->prepare("SELECT symbol, shares, buy_price FROM portfolios WHERE userid=:userid ORDER BY symbol");
	$stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
	if ($stmt->execute())
	{
	    $result = array();
	    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			array_push($result, $row);
	    }
		$dbh = null;
		return $result;
	}
	
	// close database and return null 
	$dbh = null;
	return null;
}

function add_user($email, $pwdhash) {
	$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_DATABASE;
	$dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
    $stmt = $dbh->prepare("INSERT INTO users (email, password, registration_date) VALUES (:email, :pwdhash, NOW())");
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':pwdhash', $pwdhash, PDO::PARAM_STR);
    if ($stmt->execute()) {
        if ($stmt->rowCount() == 1) {
            $userid = $dbh->lastInsertId();
            $dbh = null;

            return $userid;
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
            $id = $stmt->fetch();
            $userid = $id[0];

        }
    } 
        
    $dbn = null;
	return $userid;
}





?>
