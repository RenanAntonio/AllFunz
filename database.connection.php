<?php

/*
* script: database.connection.php
*/

$host = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'project7';

try
{
	$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $dbuser, $dbpass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e)
{
	echo 'Connection failed: ' . $e->getMessage();
	//file_put_contents('connection.errors.txt', $e->getMessage().PHP_EOL,FILE_APPEND);
}

?>
