<?php 
ob_start();
session_start();
include 'config.php';
unset($_SESSION['utilisateur']);
header("location: login.php"); 
?>