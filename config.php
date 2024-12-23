<?php

$currency = 'Tk '; //Currency Character or code
$db_username = 'root';
$db_password = '';
$db_name = 'shop';
$db_host = 'localhost';
date_default_timezone_set('Asia/Ho_Chi_Minh');

$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);
if ($mysqli->connect_error) {
	die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
