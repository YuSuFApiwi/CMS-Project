<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	$statement = $pdo->prepare("SELECT * FROM categories WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php
	$statement = $pdo->prepare("SELECT * FROM news WHERE category_id=?");
	$statement->execute(array($_REQUEST['id']));
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		unlink('../assets/uploads/news/'.$row['photo']);
	}

	// Delete from news
	$statement = $pdo->prepare("DELETE FROM news WHERE category_id=?");
	$statement->execute(array($_REQUEST['id']));

	// Delete from categories
	$statement = $pdo->prepare("DELETE FROM categories WHERE id=?");
	$statement->execute(array($_REQUEST['id']));

	header('location: category.php');
?>