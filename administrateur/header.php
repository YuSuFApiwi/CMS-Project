<?php
ob_start();
session_start();
include("config.php");
$error_message = '';
$success_message = '';

<<<<<<< HEAD
if(!isset($_SESSION['utilisateur'])) {
=======
if(!isset($_SESSION['user'])) {
>>>>>>> 3db4c6eb7d31a5891f29c19c2d31bf32eb14a6ea
	header('location: login.php');
	exit;
}
/* This is here script header */




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Apiwi">
    <title>Tableau de bord - Admin Handcomm</title>
    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
<<<<<<< HEAD
    <link href="css/vender/dataTables.bootstrap4.min.css" rel="stylesheet">
=======
>>>>>>> 3db4c6eb7d31a5891f29c19c2d31bf32eb14a6ea
    <!-- Custom styles for this template-->
    <link href="css/admin.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php require_once('sidebar.php') ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php require_once('navbar.php') ?>
<<<<<<< HEAD
            
            <!-- Begin Page Content -->
            <div class="container-fluid">
=======
>>>>>>> 3db4c6eb7d31a5891f29c19c2d31bf32eb14a6ea
