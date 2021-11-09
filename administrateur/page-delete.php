<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	$statement = $pdo->prepare("SELECT * FROM page WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
$statement = $pdo->prepare("SELECT * FROM page WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$banner = $row['banner'];
}

if($banner != '' && $banner != 'defualt-banner.jpg') {
	unlink('../assets/uploads/banners/'.$banner);
}
//Delete from page
$statement = $pdo->prepare("DELETE FROM page WHERE id=?");
$statement->execute(array($_REQUEST['id']));

header('location: page.php');
?>