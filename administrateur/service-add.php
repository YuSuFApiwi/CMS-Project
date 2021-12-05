<?php
    $title = "Ajouter un nouvel service";
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
        } else {
            $valid = 0;
            $error_message = 'Vous devez avoir à sélectionner une photo pour la photo';
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
        } else {
            $valid = 0;
            $error_messag = 'Vous devez avoir à sélectionner une photo pour la bannière';
        }
    
        if($valid == 1) {
    
            if($_POST['slug'] == '') {
                $auto_str = strtolower($_POST['name']);
                $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $auto_str);
            } else {
                $auto_str = strtolower($_POST['slug']);
                $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $auto_str);
            }
            $statement = $pdo->prepare("SELECT * FROM service WHERE slug=?");
            $statement->execute(array($slug));
            $total = $statement->rowCount();
            if($total) {
                $slug = $slug.'-1';
            }
    
            $final_name = 'service-'.random_int(99,9999). '-@-' . time() .'.'.$ext;
            move_uploaded_file( $path_tmp, '../assets/uploads/services/'.$final_name );
    
            $final_name1 = 'service-banner-'.random_int(99,9999). '-@-' . time() .'.'.$ext1;
            move_uploaded_file( $path_tmp1, '../assets/uploads/services/'.$final_name1 );
    
            $statement = $pdo->prepare("INSERT INTO service (name,slug,description,section_left,section_right,short_description,photo,banner) VALUES (?,?,?,?,?,?,?,?)");
            $statement->execute(array($_POST['name'],$slug,$_POST['content'],$_POST['section_left'],$_POST['section_right'],$_POST['short_description'],$final_name,$final_name1));
                
            $success_message = 'Le service a été ajouté avec succès !';
    
            unset($_POST['name']);
            unset($_POST['slug']);
            unset($_POST['content']);
            unset($_POST['short_description']);
    }
}
?>
<h1 class="h3 mb-2 text-gray-800">Ajouter une nouvelle Service</h1>

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
                        <input type="text" class="form-control" required id="name" name="name" placeholder="Entrez le nom du service">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="slug-page">Lien personnalisé <span class="text-muted">(Optionnel)</span></label>
                        <input type="text" class="form-control text-lowercase" id="slug-page" name="slug" placeholder="Exemple: nom-du-service">
                        <span class="text-muted text-sm-left">laisse vide pour génerer automatiquement</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="content-news">Contenu de l'actualité <span class="text-danger">*</span></label>
                        <textarea rows="15" minlength="200" class="form-control" name="content" style="min-height: 150px;" required id="content-news"></textarea>
					</div>	
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Section de contenu à gauche <span class="text-muted">(Optionnel)</span></label>
                        <textarea rows="15" minlength="200" class="form-control" name="section_left" style="min-height: 150px;" id="content-news"></textarea>
					</div>	
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Section de contenu à droite <span class="text-muted">(Optionnel)</span></label>
                        <textarea rows="15" minlength="200" class="form-control" name="section_right" style="min-height: 150px;" id="content-news"></textarea>
					</div>	
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="short-description">Brève description <span class="text-danger">*</span></label>
                        <textarea rows="5" minlength="20" class="form-control" id="short-description" name="short_description" required></textarea>
					</div>	
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="height: 50vh;" class="parent-banner">
                                <img class="h-100 img-thumbnail w-100" id="img-banner" src="../assets/uploads/services/defualt-service.jpg" alt="image service">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="banner">Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="banner" id="banner" required>
                                <span class="text-muted text-sm-left">Seuls les jpg, jpeg, gif et png sont autorisés.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="height: 50vh;" class="parent-img">
                                <img class="h-100 img-thumbnail w-100" id="img-banner" src="../assets/uploads/services/defualt-service.jpg" alt="image service">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="photo">Photo en vedette <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="photo" id="photo" required>
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
                                <span class="text">Ajouter un nouveau service</span>
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