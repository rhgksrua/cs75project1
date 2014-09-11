<?php

include("../../pw.php");

define('DB_HOST', 'localhost');
define('DB_USER', $user);
define('DB_PASSWORD', $pw);
define('DB_DATABASE', 'project1');

function add_shares($symbol, $quantity, $userid) {
    
    $quote = get_quote_data($symbol);
    $price = $quote['last_trade'];

    $total_cost = $price * $quantity;

    // Connect to DB
	$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_DATABASE;
	$dbh = new PDO($dsn, DB_USER, DB_PASSWORD);

    // Begin Transaction
    // ---------------------------------------------------------------

    $dbh->beginTransaction();

    // Check user balance
    $stmt = $dbh->prepare("SELECT balance FROM users WHERE id=:userid");
	$stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
    $stmt->execute();

    // Not enough to buy stock
    $balance = $stmt->fetch();
    if ($balance[0] < $total_cost) {
        return array('price' => "balance", 'total' => "");
    }
	
	// Add shares to portfolio
	$stmt = $dbh->prepare("INSERT INTO portfolios (userid, symbol, shares, buy_price) VALUES (:userid, :symbol, :quantity, :buy_price)");
	$stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
	$stmt->bindValue(':symbol', $symbol, PDO::PARAM_STR);
	$stmt->bindValue(':quantity', $quantity, PDO::PARAM_INT);
	$stmt->bindValue(':buy_price', $price, PDO::PARAM_INT);

    if(!$stmt->execute()) {
        $dbh->rollBack();
        return False;
    }

    // Update user balance.
	$stmt = $dbh->prepare("UPDATE users SET balance=balance-:total_price WHERE id=:userid");
	$stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
	$stmt->bindValue(':total_price', $total_cost, PDO::PARAM_INT);

    if (!$stmt->execute()) {
        $dbh->rollBack();
        return False;
    }

    $dbh->commit();

    $dbh = null;

    return array('price' => $price, 'total' => $total_cost);

}

function sell_share($symbol, $userid) {
    $quote = get_quote_data($symbol);
    $price = $quote['last_trade'];
    
	$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_DATABASE;
	$dbh = new PDO($dsn, DB_USER, DB_PASSWORD);

    // Begin transaction
    $dbh->beginTransaction();
	
	// get user's portfolio
	$stmt = $dbh->prepare("SELECT symbol, SUM(shares) AS shares FROM portfolios WHERE userid=:userid AND symbol=:symbol GROUP BY symbol");
	$stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
	$stmt->bindValue(':symbol', $symbol, PDO::PARAM_STR);
	if ($stmt->execute())
	{
	    $row = $stmt->fetch();
        $total_shares = $row['shares'];
        
    } else {
        $dbh->rollBack();
        $dbh = null;
        return False;
    }
    
	$stmt = $dbh->prepare("DELETE FROM portfolios WHERE symbol=:symbol AND userid=:userid");
	$stmt->bindValue(':symbol', $symbol, PDO::PARAM_STR);
	$stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
	if (!$stmt->execute())
	{
        $dbh->rollBack();
        $dbh = null;
        return False;
	}

    $total_sold = $total_shares * $price;
	
	$stmt = $dbh->prepare("UPDATE users SET balance=balance+:total_sold WHERE id=:userid");
	$stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
	$stmt->bindValue(':total_sold', $total_sold, PDO::PARAM_INT);
    if ($stmt->execute()) {
        $dbh->commit();
        $dbh = null;
        return array('stock' => $row, 'price' => $price);
    }
    $dbh->rollBack();

	// close database and return null 
	$dbh = null;
	return null;
    
}

function get_quote_data($symbol) {
    $result = array();
    $url = "http://download.finance.yahoo.com/d/quotes.csv?s={$symbol}&f=sl1n&e=.csv";
    $handle = fopen($url, "r");
    if ($row = fgetcsv($handle)) {
        if (isset($row[1])) {
            if ($row[1] <= 0) {
                return False;
            }
            $result = array("symbol" => $row[0], 
                            "last_trade" => $row[1],
                            "name" => $row[2]);
        }
    } else {
        return False;
    }
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

    // Begin transaction
    $dbh->beginTransaction();

    
    $stmt = $dbh->prepare("INSERT INTO users (email, password, balance, registration_date) VALUES (:email, :pwdhash, 10000, NOW())");
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':pwdhash', $pwdhash, PDO::PARAM_STR);
    if ($stmt->execute()) {
        if ($stmt->rowCount() == 1) {
            $userid = $dbh->lastInsertId();

            $dbh->commit();
            $dbh = null;

            
            return $userid;
        } else {
            $dbh->rollBack();
            $dbh = null;
            return False;
        }
    } else {
        $dbh->rollBack();
        $dbh = null;
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
