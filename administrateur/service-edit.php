<?php
    $title = "Mise à jour de service";
    $before_css = '<link rel="stylesheet" href="css/vender/summernote.css">';
    require_once('header.php')
?>
<?php
    if (isset($_POST['formS'])) {
        $valid = 1;
    
	if(empty($_POST['name'])) {
		$valid = 0;
        $error_message = 'Le nom ne peut pas être vide';
	}

	if(empty($_POST['content'])) {
		$valid = 0;
        $error_message = 'La description ne peut pas être vide';
	}

	if(empty($_POST['short_description'])) {
		$valid = 0;
        $error_message = 'La description courte ne peut pas être vide';
	}
	
    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if($path!='') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message = 'Vous devez avoir à télécharger un fichier jpg, jpeg, gif ou png pour la photo';
        }
    }

    $path1 = $_FILES['banner']['name'];
    $path_tmp1 = $_FILES['banner']['tmp_name'];

    if($path1!='') {
        $ext1 = pathinfo( $path1, PATHINFO_EXTENSION );
        $file_name1 = basename( $path1, '.' . $ext1 );
        if( $ext1!='jpg' && $ext1!='png' && $ext1!='jpeg' && $ext1!='gif' ) {
            $valid = 0;
            $error_message = 'Vous devez avoir à télécharger un fichier jpg, jpeg, gif ou png pour la bannière';
        }
    }

	if($valid == 1) {

		$statement = $pdo->prepare("SELECT * FROM service WHERE id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) {
			$old_name = $row['name'];
		}


		if($_POST['slug'] == '') {
    		$temp_string = strtolower($_POST['name']);
    		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);;
    	} else {
    		$temp_string = strtolower($_POST['slug']);
    		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
    	}
		$statement = $pdo->prepare("SELECT * FROM service WHERE slug=? AND name!=?");
		$statement->execute(array($slug,$old_name));
		$total = $statement->rowCount();
		if($total) {
			$slug = $slug.'-1';
		}

		if($path == '' && $path1 == '') {
			$statement = $pdo->prepare("UPDATE service SET name=?, slug=?, description=?, short_description=? WHERE id=?");
    		$statement->execute(array($_POST['name'],$slug,$_POST['content'],$_POST['short_description'],$_REQUEST['id']));
		}
		if($path != '' && $path1 == '') {
			unlink('../assets/uploads/services/'.$_POST['old_photo']);

			$final_name = 'service-'.random_int(99,9999). '-@-' . time() .'.'.$ext;
        	move_uploaded_file( $path_tmp, '../assets/uploads/services/'.$final_name );

        	$statement = $pdo->prepare("UPDATE service SET name=?, slug=?, description=?, short_description=?, photo=? WHERE id=?");
    		$statement->execute(array($_POST['name'],$slug,$_POST['content'],$_POST['short_description'],$final_name,$_REQUEST['id']));
		}
		if($path == '' && $path1 != '') {
			unlink('../assets/uploads/services/'.$_POST['old_banner']);

			$final_name1 = 'service-banner-'.random_int(99,9999). '-@-' . time() .'.'.$ext1;
        	move_uploaded_file( $path_tmp1, '../assets/uploads/services/'.$final_name1 );

        	$statement = $pdo->prepare("UPDATE service SET name=?, slug=?, description=?, short_description=?, banner=? WHERE id=?");
    		$statement->execute(array($_POST['name'],$slug,$_POST['content'],$_POST['short_description'],$final_name1,$_REQUEST['id']));
		}
		if($path != '' && $path1 != '') {

			unlink('../assets/uploads/services/'.$_POST['old_photo']);
			unlink('../assets/uploads/services/'.$_POST['old_banner']);

			$final_name = 'service-'.random_int(99,9999). '-@-' . time() .'.'.$ext;
        	move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

			$final_name1 = 'service-banner-'.random_int(99,9999). '-@-' . time() .'.'.$ext1;
        	move_uploaded_file( $path_tmp1, '../assets/uploads/'.$final_name1 );

        	$statement = $pdo->prepare("UPDATE service SET name=?, slug=?, description=?, short_description=?, photo=?, banner=? WHERE id=?");
    		$statement->execute(array($_POST['name'],$slug,$_POST['description'],$_POST['short_description'],$final_name,$final_name1,$_REQUEST['id']));
		}

		$success_message = 'Le service est mis à jour avec succès !';
	}
}
?>
<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	$statement = $pdo->prepare("SELECT * FROM service WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>
<h1 class="h3 mb-2 text-gray-800">Modification de service</h1>

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
$statement = $pdo->prepare("SELECT * FROM service WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$name              = $row['name'];
	$slug              = $row['slug'];
	$content           = $row['description'];
	$short_description = $row['short_description'];
	$photo             = $row['photo'];
	$banner            = $row['banner'];
}
?>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Des informations de service</h6>
        <div>
            <a href="service.php" class="btn btn-info">
                <span class="text">Afficher tous les services</span>
            </a>
        </div>
    </div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Nom du service <span class="text-danger">*</span></label>
                        <input type="text" class="form-control text-capitalize" required value="<?php echo $name;?>" id="name" name="name" placeholder="Entrez le nom du service">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="slug-page">Slug <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control text-lowercase" id="slug-page" value="<?php echo $slug;?>" name="slug" placeholder="Example: nom-du-service">
                        <span class="text-muted text-sm-left">generate slug automatic.</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="content-news">Contenu de l'actualité <span class="text-danger">*</span></label>
                        <textarea rows="15" minlength="200" class="form-control" name="content" style="min-height: 150px;" required id="content-news"><?php echo $content;?></textarea>
					</div>	
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="content-news">Brève description <span class="text-danger">*</span></label>
                        <textarea rows="5" minlength="20" class="form-control" name="short_description" required><?php echo $short_description;?></textarea>
					</div>	
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="height: 50vh;" class="parent-banner">
                                <?php if ($banner != '' && $banner != 'defualt-service.jpg'):?>
                                    <img class="h-100 img-thumbnail w-100" id="img-banner" src="../assets/uploads/services/<?php echo $banner ?>" alt="image service">
                                <?php else: ?>
                                <img class="h-100 img-thumbnail w-100" id="img-banner" src="../assets/uploads/services/defualt-service.jpg" alt="image service">
                                <?php endif ?>    
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="banner">Bannière <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="banner" id="banner">
                                <span class="text-muted text-sm-left">Seuls les jpg, jpeg, gif et png sont autorisés.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $photo; ?>" name="old_photo">
                <input type="hidden" value="<?php echo $banner; ?>" name="old_banner">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="height: 50vh;" class="parent-img">
                            <?php if ($photo != '' && $photo != 'defualt-service.jpg'):?>
                                <img class="h-100 img-thumbnail w-100" id="img-banner" src="../assets/uploads/services/<?php echo $photo ?>" alt="image service">
                            <?php else: ?>
                                <img class="h-100 img-thumbnail w-100" id="img-banner" src="../assets/uploads/services/defualt-service.jpg" alt="image service">
                            <?php endif ?>  
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="photo">Photo en vedette <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="photo" id="photo">
                                <span class="text-muted text-sm-left">Seuls les jpg, jpeg, gif et png sont autorisés.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 offset-md-6 d-flex flex-row justify-content-end">
                            <button type="submit" name="formS"  class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Mise à jour de service</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



<?php 
    $after_js = '<script src="js/vendor/summernote.js"></script>';
    require_once('footer.php')
?>