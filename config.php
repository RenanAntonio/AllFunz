<?php 

require 'database.connection.php';
require 'forum.class.php';

$forums = new Forum($dbh);
$errors = array(); //creates the $errors[] array.

?>