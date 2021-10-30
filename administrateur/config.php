<?php
/* Hide Error in the page */
ini_set('display_errors', 1);

/* Info Host (Host Name)*/
$dbhost = 'localhost';
/* Database Name */
$dbname = 'pro_handcomm';
/* Database Username */
$dbuser = 'root';
/* Database Password */
$dbpass = '';

/* Public Pathe the Localhost here */
define("BASE_URL", 'http://localhost/Project-me/cms-project/');
/* Pathe Administrateur */
define("ADMIN_URL", BASE_URL . "administrateur" . "/");

try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
	echo "Connection error :" . $exception->getMessage();
}