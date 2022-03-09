<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	$statement = $pdo->prepare("SELECT * FROM category_references WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php
	$statement = $pdo->prepare("DELETE FROM category_references WHERE id=?");
	$statement->execute(array($_REQUEST['id']));

	$statement = $pdo->prepare("SELECT * FROM `references` WHERE category_id=?");
	$statement->execute(array($_REQUEST['id']));
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		unlink('../assets/uploads/references/' . $row['photo_name']);
	}

	$statement = $pdo->prepare("DELETE FROM `references` WHERE category_id=?");
	$statement->execute(array($_REQUEST['id']));

	header('location: category-references.php');
?>