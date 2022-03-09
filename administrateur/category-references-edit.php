<?php 
$title = "Modifier la catégorie de référence";
require_once('header.php');
?>

<?php
if (isset($_POST['form1'])) {
    $valid = 1;

    if (empty($_POST['category_name'])) {
        $valid = 0;
        $error_message = "Le nom de la catégorie ne peut pas être vide";
    } else {
        $statement = $pdo->prepare("SELECT * FROM category_references WHERE id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) {
			$current_category_name = $row['category_name'];
		}

		$statement = $pdo->prepare("SELECT * FROM category_references WHERE category_name=? and category_name!=?");
    	$statement->execute(array($_POST['category_name'],$current_category_name));
    	$total = $statement->rowCount();
        if ($total) {
            $valid = 0;
            $error_message = "Le nom de la catégorie existe déjà";
        }
    }

    if ($valid == 1) {
        $statement = $pdo->prepare("UPDATE category_references SET category_name=?, status=? WHERE id=?");
		$statement->execute(array($_POST['category_name'],$_POST['status'],$_REQUEST['id']));
        $success_message = 'La catégorie de référence est mise à jour avec succès..';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	$statement = $pdo->prepare("SELECT * FROM category_references WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if($total == 0) {
		header('location: logout.php');
		exit;
	}
}
?>

<h1 class="h3 mb-2 text-gray-800">Modifier la catégorie de référence</h1>

<?php
if (isset($error_message) && $error_message != '') {
    $name_alert = 'erreur fatale';
    $msg_alert = $error_message;
    require_once('alert/error.php');
}
if (isset($success_message) && $success_message != '') {
    $name_alert = 'Fait avec succès';
    $msg_alert = $success_message;
    require_once('alert/success.php');
}
?>
<?php							
foreach ($result as $row) {
	$category_name = $row['category_name'];
	$status = $row['status'];
}
?>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"></h6>
        <div>
            <a href="category-references.php" class="btn btn-info">
                <span class="text">Afficher toutes</span>
            </a>
        </div>
    </div>


    <section class="card-body">

        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" action="" method="post">
                    <div class="box box-info">
                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="" class="control-label">Nom de catégorie <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="category_name" value="<?php echo $category_name ?>" required placeholder="Nom de catégorie">
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="align-items-xl-end col-4 col-md-4 d-flex">
                                            <label for="active">Active? <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-8 col-8">
                                            <div class="form-control">
                                                <input type="radio" name="status" id="active" required value="active" class="custom-radio" <?php echo $status == "active" ? "checked" : "" ?>>
                                                <label for="active" class="custom-control-inline">Oui</label>
                                                <input type="radio" name="status" id="inactive" required value="inactive" class="custom-radio" <?php echo $status == "inactive" ? "checked" : "" ?>>
                                                <label for="inactive" class="custom-control-inline">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6 offset-md-6 d-flex flex-row justify-content-end">
                                        <button type="submit" name="form1" class="btn btn-info btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                            <span class="text">Mise à jour</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>


            </div>
        </div>

    </section>

    <?php require_once('footer.php'); ?>