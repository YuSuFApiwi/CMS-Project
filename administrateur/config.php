<?php
/* Hide Error in the page */
ini_set('display_errors', 1);

/* Info Host (Host Name)*/
$dbhost = 'sql303.epizy.com';
/* Database Name */
$dbname = 'epiz_31061339_w940';
/* Database Username */
$dbuser = 'epiz_31061339';
/* Database Password */
$dbpass = 'w1IAwuMc0hpmi';

/* Public Pathe the Localhost here */
define("BASE_URL", 'http://deltamultimedia.42web.io/');
/* Pathe Administrateur */
define("ADMIN_URL", BASE_URL . "administrateur" . "/");

try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
	echo "Connection error :" . $exception->getMessage();
}