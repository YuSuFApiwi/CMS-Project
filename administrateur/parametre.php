<?php
    $title = 'Mes paramètres';
    $before_css = '<link rel="stylesheet" href="css/vender/summernote.css">';
    require_once('header.php')
?>

<?php
if(isset($_POST['form1'])) {
	$statement = $pdo->prepare("UPDATE settings SET footer_about=?, footer_copyright=?, contact_address=?, contact_email=?, contact_phone=?, contact_fax=? WHERE id=1");
	$statement->execute(array($_POST['content'],$_POST['footer_copyright'],$_POST['contact_address'],$_POST['contact_email'],$_POST['phone'],$_POST['fax']));

	$success_message = 'Les paramètres de contenu généraux ont été mis à jour avec succès.';
}

if(isset($_POST['form2'])) {
	$statement = $pdo->prepare("UPDATE settings SET meta_title=?, meta_keyword=?, meta_description=? WHERE id=1");
	$statement->execute(array($_POST['meta_title'],$_POST['meta_keyword'],$_POST['meta_description']));

	$success_message = 'Les paramètres Home Meta sont mis à jour avec succès.';
}

if(isset($_POST['form3'])) {
    $valid = 1;

    $path = $_FILES['photo_logo']['name'];
    $path_tmp = $_FILES['photo_logo']['tmp_name'];

    if($path == '') {
        $valid = 0;
        $error_message = 'Vous devez obligatoirement sélectionner une photo';
    } else {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='JPG' && $ext!='PNG' && $ext!='JPEG' && $ext!='GIF' ) {
            $valid = 0;
            $error_message = 'Vous devez avoir à télécharger un fichier jpg, jpeg, gif ou png';
        }
    }

    if($valid == 1) {
        $statement = $pdo->prepare("SELECT * FROM settings WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);							
        foreach ($result as $row) {
            $logo = $row['logo'];
            unlink('../assets/uploads/logo/'.$logo);
        }
        
        $final_name = 'logo'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../assets/uploads/logo/'.$final_name );

        $statement = $pdo->prepare("UPDATE settings SET logo=? WHERE id=1");
        $statement->execute(array($final_name));

        $success_message = 'Le logo est mis à jour avec succès.';
    }
}

if(isset($_POST['form4'])) {
	$valid = 1;
	$path = $_FILES['photo_favicon']['name'];
    $path_tmp = $_FILES['photo_favicon']['tmp_name'];

    if($path == '') {
    	$valid = 0;
        $error_message = 'Vous devez obligatoirement sélectionner une photo';
    } else {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='JPG' && $ext!='PNG' && $ext!='JPEG' && $ext!='GIF' ) {
            $valid = 0;
            $error_message = 'Vous devez avoir à télécharger un fichier jpg, jpeg, gif ou png';
        }
    }

    if($valid == 1) {
    	$statement = $pdo->prepare("SELECT * FROM settings WHERE id=1");
    	$statement->execute();
    	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
    	foreach ($result as $row) {
    		$favicon = $row['favicon'];
    		unlink('../assets/uploads/favicon/'.$favicon);
    	}
    	$final_name = 'favicon'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../assets/uploads/favicon/'.$final_name );
		$statement = $pdo->prepare("UPDATE settings SET favicon=? WHERE id=1");
		$statement->execute(array($final_name));

        $success_message = 'Favicon est mis à jour avec succès.';
    	
    }
}

?>





<?php
$statement = $pdo->prepare("SELECT * FROM settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$logo              = $row['logo'];
	$favicon           = $row['favicon'];

	$footer_about      = $row['footer_about'];
	$footer_copyright  = $row['footer_copyright'];
	$contact_address   = $row['contact_address'];
	$contact_email     = $row['contact_email'];
	$contact_phone     = $row['contact_phone'];
	$contact_fax       = $row['contact_fax'];

	$meta_title        = $row['meta_title'];
	$meta_keyword      = $row['meta_keyword'];
	$meta_description  = $row['meta_description'];
}
?>

<h1 class="h3 mb-2 text-gray-800">Paramètres</h1>

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

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-link active" id="nav-content-tab" data-toggle="tab" href="#nav-content" role="tab" aria-controls="nav-content" aria-selected="true">Contenu Général</a>
    <a class="nav-link" id="nav-meta-tab" data-toggle="tab" href="#nav-meta" role="tab" aria-controls="nav-meta" aria-selected="true">Méta de la page d'accueil</a>
    <a class="nav-link" id="nav-logo-tab" data-toggle="tab" href="#nav-logo" role="tab" aria-controls="nav-logo" aria-selected="true">Logo</a>
    <a class="nav-link" id="nav-favicon-tab" data-toggle="tab" href="#nav-favicon" role="tab" aria-controls="nav-favicon" aria-selected="true">Favicon</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active mt-4" id="nav-content" role="tabpanel" aria-labelledby="nav-content-tab">
    <form action="" method="post">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="content_page">Pied de page <span class="text-muted">(footer)</span> - À propos de nous <span class="text-danger">*</span></label>
                    <textarea rows="15" minlength="100" class="form-control" name="content" required style="min-height: 150px;" id="content_page"><?php echo $footer_about ?></textarea>
                </div>	
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email du contact <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" value="<?php echo $contact_email ?>" required id="email" name="contact_email" placeholder="Entrez l'e-mail">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tele">Numéro de téléphone de contact <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control" value="<?php echo $contact_phone ?>" required id="tele" name="phone" placeholder="Entrer le numéro de téléphone">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fax">Numéro de Fax de contact <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control" value="<?php echo $contact_fax ?>" required id="fax" name="fax" placeholder="Entrer le numéro de fax">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Adresse de contact <span class="text-danger">*</span></label>
                    <input type="text" class="form-control text-lowercase"  value="<?php echo $contact_address ?>" required id="address" name="contact_address" placeholder="Entrer l'adresse de contact">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="copyright">Pied de page - Copyright <span class="text-danger">*</span></label>
                    <input type="text" class="form-control text-lowercase"  value="<?php echo $footer_copyright ?>" required id="copyright" name="footer_copyright" placeholder="Entrer pied de page - Copyright">
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="row">
                    <div class="col-md-6 offset-md-6 d-flex flex-row justify-content-end">
                        <button type="submit" name="form1"  class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Mettre à jour les paramètres généraux</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
  </div>
  <div class="tab-pane fade mt-4" id="nav-meta" role="tabpanel" aria-labelledby="nav-meta-tab">
    <form action="" method="post">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title">Meta titre <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" value="<?php echo $meta_title ?>" required id="title" name="meta_title" placeholder="Meta titre">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="key">Badger mot clé <span class="text-muted">(Optionnel)</span></label>
                    <textarea rows="4" class="form-control" id="key" name="meta_keyword" style="min-height: 50px;" placeholder="Exemple: handcomm,blog,website,..."><?php echo $meta_keyword ?></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">Meta Description <span class="text-muted">(Optionnel)</span></label>
                    <textarea rows="8" class="form-control" id="description" placeholder="Meta Description..." name="meta_description" style="min-height: 150px;"><?php echo $meta_description ?></textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="row">
                    <div class="col-md-6 offset-md-6 d-flex flex-row justify-content-end">
                        <button type="submit" name="form2"  class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Mettre à jour</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
  </div>
  <div class="tab-pane fade mt-4" id="nav-logo" role="tabpanel" aria-labelledby="nav-logo-tab">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="logo-setting text-center ml-4">
                        <div class="logo-setting-inner parent-img mx-auto">
                            <img src="../assets/uploads/logo/<?php echo $logo ?>" alt="logo handcomm">
                            <input type="file" name="photo_logo" id="photo" class="avatar_custom" required="required">
                        </div>
                        <div>
                            <small class="muted-deep fw-normal">Seuls les <strong>jpg</strong>, <strong>jpeg</strong> et <strong>png</strong> sont autorisés. (250x150)</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 offset-md-6 d-flex flex-row justify-content-end">
                        <button type="submit" name="form3"  class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Mettre à jour le logo</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
  </div>
  <div class="tab-pane fade mt-4" id="nav-favicon" role="tabpanel" aria-labelledby="nav-favicon-tab">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="favicon-setting text-center ml-4">
                        <div class="favicon-setting-inner parent-img mx-auto">
                            <img src="../assets/uploads/favicon/<?php echo $favicon ?>" alt="logo handcomm">
                            <input type="file" name="photo_favicon" id="favicon" class="avatar_custom" required="required">
                        </div>
                        <div>
                            <small class="muted-deep fw-normal">Seuls les <strong>jpg</strong>, <strong>jpeg</strong> et <strong>png</strong> sont autorisés.(16x16 or 32x34)</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 offset-md-6 d-flex flex-row justify-content-end">
                        <button type="submit" name="form4"  class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Mettre à jour le favicon</span>
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