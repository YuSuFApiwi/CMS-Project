<?php require_once('header.php'); ?>
<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	$statement = $pdo->prepare("SELECT * FROM service WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>
<?php
	$statement = $pdo->prepare("SELECT * FROM service WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		$photo = $row['photo'];
		$banner = $row['banner'];
	}

	if($photo!= '' && $photo != 'defualt-service.jpg') {
		unlink('../assets/uploads/services/'.$photo);	
	}
	if($banner!= '' && $banner != 'defualt-service.jpg') {
		unlink('../assets/uploads/services/'.$banner);
    }
	$statement = $pdo->prepare("DELETE FROM service WHERE id=?");
	$statement->execute(array($_REQUEST['id']));

	header('location: service.php');
?>