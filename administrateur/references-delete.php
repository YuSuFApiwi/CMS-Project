<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	$statement = $pdo->prepare("SELECT * FROM `references` WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}

$statement = $pdo->prepare("SELECT * FROM `references` WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$photo_name = $row['photo_name'];
}
if($photo_name!='') {
	unlink('../assets/uploads/references/'.$photo_name);
}

$statement = $pdo->prepare("DELETE FROM `references` WHERE id=?");
$statement->execute(array($_REQUEST['id']));
header('location: references.php');
?>