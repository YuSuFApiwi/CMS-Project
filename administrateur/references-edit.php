<?php
    $title = "Ajouter une nouvelle référence";
    $before_css = '<link rel="stylesheet" href="css/vender/summernote.css">';
    require_once('header.php')
?>

<?php
    if (isset($_POST['form1'])) {
        $valid = 1;
        if(empty($_POST['photo_caption'])) {
            $valid = 0;
            $error_message = "Le nom de la légende de référence ne peut pas être vide";
        }
    
        $path = $_FILES['photo']['name'];
        $path_tmp = $_FILES['photo']['tmp_name'];
    
        if($path != '') {
            $ext = pathinfo($path, PATHINFO_EXTENSION );
            $file_name = basename( $path, '.' . $ext );
            if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
                $valid = 0;
                $error_message = 'Vous devez avoir à télécharger un fichier jpg, jpeg, gif ou png';
            }
        }
    
        if(empty($_POST['category_id'])) {
            $valid = 0;
            $error_message = "Vous devez sélectionner une catégorie de référence";
        }
        
        if($valid == 1) {

            if($path == '') {
                $statement = $pdo->prepare("UPDATE `references` SET photo_caption=?, category_id=? WHERE id=?");
                $statement->execute(array($_POST['photo_caption'],$_POST['category_id'],$_REQUEST['id']));
            } else {
                unlink('../assets/uploads/references/'.$_POST['previous_photo']);
    
                $final_name = 'photo-'.random_int(99,9999). '-@-' . time() .'.'.$ext;
                move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );
    
                $statement = $pdo->prepare("UPDATE `references` SET photo_caption=?, photo_name=?, category_id=? WHERE id=?");
                $statement->execute(array($_POST['photo_caption'],$final_name,$_POST['category_id'],$_REQUEST['id']));
            }
            
            $success_message = 'Référence est mise à jour avec succès.';
        }
    }
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	$statement = $pdo->prepare("SELECT * FROM `references` WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<h1 class="h3 mb-2 text-gray-800">Modifier la référence</h1>

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
	$photo_caption = $row['photo_caption'];
	$photo_name = $row['photo_name'];
	$category_id = $row['category_id'];
}
?>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Informations de référence</h6>
        <div>
            <a href="references.php" class="btn btn-info">
                <span class="text">Afficher tous les références</span>
            </a>
        </div>
    </div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name-ref">Légende de la photo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="<?php echo $photo_caption; ?>" required id="name-ref" name="photo_caption" placeholder="Entrez Légende de la photo">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category-ref">Catégories Références <span class="text-danger">*</span></label>
                        <select class="form-control" name="category_id" id="category-ref" required="required">
                            <option value="" hidden>Sélectionnez la catégorie de référence</option>
									<?php
									$statement = $pdo->prepare("SELECT * FROM category_references ORDER BY category_name ASC");
									$statement->execute();
									$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
									foreach ($result as $row) {
                                        if ($row["id"] == $category_id) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        
										echo '<option value="'.$row['id'].'" '. $selected .'>'.$row['category_name'].'</option>';
									}
									?>
                        </select>                    
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="height: 50vh;" class="parent-banner">
                            <?php 
                                if ($photo_name != "") {
                                    echo '<img class="h-100 img-thumbnail w-100" id="img-banner" src="../assets/uploads/references/'.$photo_name.'" alt="image service">';
                                } else {
                                    echo '<img class="h-100 img-thumbnail w-100" id="img-banner" src="../assets/uploads/references/defualt-references.jpg" alt="image service">';
                                }                                    
                            ?>
                            </div>
                        </div>
                        <input type="hidden" name="previous_photo" value="<?php echo $photo_name; ?>" hidden>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="banner">Photo <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="photo" id="banner">
                                <span class="text-muted text-sm-left">Seuls les jpg, jpeg, gif et png sont autorisés.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 offset-md-6 d-flex flex-row justify-content-end">
                            <button type="submit" name="form1"  class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Mettre à jour la référence</span>
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