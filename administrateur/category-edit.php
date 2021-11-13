<?php
    $title = "Ajouter une nouvelle catégorie";
    require_once('header.php')
?>
<?php
    if (isset($_POST['formC'])) {
        $valid = 1;

        if(empty($_POST['category_name'])) {
            $valid = 0;
            $error_message = "Le nom de la catégorie ne peut pas être vide.";
        } else {
            $statement = $pdo->prepare("SELECT * FROM categories WHERE id=?");
            $statement->execute(array($_REQUEST['id']));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row) {
                $old_category_name = $row['category_name'];
            }

            $statement = $pdo->prepare("SELECT * FROM categories WHERE category_name=? and category_name!=?");
            $statement->execute(array($_POST['category_name'],$old_category_name));
            $total = $statement->rowCount();							
            if($total) {
                $valid = 0;
                $error_message = 'Le nom de la catégorie existe déjà';
            }
        }

        if($valid == 1) {

            if($_POST['slug'] == '') {
                $temp_string = strtolower($_POST['category_name']);
                $category_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
            } else {
                $temp_string = strtolower($_POST['slug']);
                $category_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
            }

            $statement = $pdo->prepare("SELECT * FROM categories WHERE category_slug=?");
            $statement->execute(array($category_slug));
            $total = $statement->rowCount();
            if($total) {
                $category_slug = $category_slug.'-1';
            }

            $statement = $pdo->prepare("UPDATE categories SET category_name=?, category_slug=?, meta_title=?, meta_keyword=?, meta_description=? WHERE id=?");
    		$statement->execute(array($_POST['category_name'],$category_slug,$_POST['meta_title'],$_POST['meta_keyword'],$_POST['meta_description'],$_REQUEST['id']));

            $success_message = 'La catégorie est mis à jour avec succés.';
        }
    }
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	$statement = $pdo->prepare("SELECT * FROM categories WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>
<h1 class="h3 mb-2 text-gray-800">Modifier la catégorie</h1>
<?php							
foreach ($result as $row) {
	$category_name = $row['category_name'];
	$category_slug = $row['category_slug'];
	$meta_title = $row['meta_title'];
	$meta_keyword = $row['meta_keyword'];
	$meta_description = $row['meta_description'];
}
?>

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

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Informations sur la catégorie</h6>
        <div>
            <a href="category.php" class="btn btn-info">
                <span class="text">Afficher Les catégories</span>
            </a>
        </div>
    </div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name-category">Nom de catégorie <span class="text-danger">*</span></label>
                        <input type="text" class="form-control text-capitalize" required value="<?php echo $category_name; ?>" id="name-category" name="category_name" placeholder="Entrez le nom de catégorie">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="slug-category">Slug <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control text-lowercase" id="slug-category" value="<?php echo $category_slug; ?>" name="slug" placeholder="Example: nom-de-catégorie">
                        <span class="text-muted text-sm-left">generate slug automatic.</span>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">Meta title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required id="title" value="<?php echo $meta_title; ?>" name="meta_title" placeholder="Meta Title">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="key">Meta Keyword <span class="text-muted">(Optional)</span></label>
                        <textarea rows="4" class="form-control" id="key" name="meta_keyword" style="min-height: 50px;" placeholder="Example: handcomm,blog,website,..."><?php echo $meta_keyword; ?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Meta Description <span class="text-muted">(Optional)</span></label>
                        <textarea rows="8" class="form-control" id="description" placeholder="Meta Description..." name="meta_description" style="min-height: 150px;"><?php echo $meta_description; ?></textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 offset-md-6 d-flex flex-row justify-content-end">
                            <button type="submit" name="formC"  class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span class="text">Mettre à jour la catégorie</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



<?php 
    require_once('footer.php')
?>