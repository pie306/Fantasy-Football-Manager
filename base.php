<?php
	session_start();
	 
	/*$dbhost = "localhost"; // this will ususally be 'localhost', but can sometimes differ
	$dbname = "heroku_3459d78c3442ad9"; // the name of the database that you are going to use for this project
	$dbuser = "b73bf768820bf5"; // the username that you created, or were given, to access your database
	$dbpass = "ab827e68"; // the password that you created, or were given, to access your database
	 
	mysql_connect($dbhost, $dbuser, $dbpass) or die("MySQL Error: " . mysql_error());
	mysql_select_db($dbname) or die("MySQL Error: " . mysql_error());
	*/
    $url=parse_url(getenv("CLEARDB_DATABASE_URL"));
	
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"],1);

    mysql_connect($server, $username, $password);


    mysql_select_db($db);
?>