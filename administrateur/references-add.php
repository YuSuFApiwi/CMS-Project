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
    
        if($path == '') {
            $valid = 0;
            $error_message = "Vous devez avoir tô sélectionner une photo";
        } else {
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
            $final_name = 'photo-'.random_int(99,9999). '-@-' . time() .'.'.$ext;
            move_uploaded_file($path_tmp, '../assets/uploads/references/'.$final_name );
    
            $statement = $pdo->prepare("INSERT INTO `references` (photo_caption,photo_name,category_id) VALUES (?,?,?)");
            $statement->execute(array($_POST['photo_caption'],$final_name,$_POST['category_id']));
    
            $success_message = 'La référence a été ajoutée avec succès.';
        }
    }
?>

<h1 class="h3 mb-2 text-gray-800">Ajouter une nouvelle référence</h1>

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
                        <input type="text" class="form-control" required id="name-ref" name="photo_caption" placeholder="Entrez Légende de la photo">
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
										echo '<option value="'.$row['id'].'">'.$row['category_name'].'</option>';
									}
									?>
                        </select>                    
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="height: 50vh;" class="parent-banner">
                                <img class="h-100 img-thumbnail w-100" id="img-banner" src="../assets/uploads/references/defualt-references.jpg" alt="image service">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="banner">Photo <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="photo" id="banner" required>
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
                                <span class="text">Ajouter un nouveau référence</span>
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