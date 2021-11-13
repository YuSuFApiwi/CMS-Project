<?php
    $title = 'Ajouter une nouvelle menu';
    require_once('header.php')
?>

<?php
if(isset($_POST['form1'])) {

    if($_SESSION['utilisateur']['role'] == 'Admin') {
		$valid = 1;

	    if(empty($_POST['fullname'])) {
	        $valid = 0;
	        $error_message = "Le nom ne peut pas être vide";
	    }

	    if(empty($_POST['email'])) {
	        $valid = 0;
	        $error_message = "L'adresse e-mail ne peut pas être vide";
	    } else {
	    	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
		        $valid = 0;
		        $error_message = "L'adresse e-mail doit être valide";
		    } else {
		    	$statement = $pdo->prepare("SELECT * FROM utilisateur WHERE id=?");
				$statement->execute(array($_SESSION['utilisateur']['id']));
				$result = $statement->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row) {
					$old_email = $row['email'];
				}

		    	$statement = $pdo->prepare("SELECT * FROM utilisateur WHERE email=? and email!=?");
		    	$statement->execute(array($_POST['email'],$old_email));
		    	$total = $statement->rowCount();					
		    	if($total) {
		    		$valid = 0;
		        	$error_message = "l'adresse mail existe déjà";
		    	}
		    }
	    }
        $path = $_FILES['photo']['name'];
        $path_tmp = $_FILES['photo']['tmp_name'];
    
        if($path!='') {
            $ext = pathinfo( $path, PATHINFO_EXTENSION );
            $file_name = basename( $path, '.' . $ext );
            if( $ext!='jpg' && $ext!='png' && $ext!='jpeg') {
                $valid = 0;
                $error_message = 'Vous devez avoir à télécharger un fichier jpg, jpeg ou png';
            }
        }
    
        if($valid == 1 && $path != '') {

            if($_SESSION['utilisateur']['photo']!='' && $_SESSION['utilisateur']['photo']!= 'avatar0.jpg') {
                unlink('../assets/uploads/avatars/'.$_SESSION['utilisateur']['photo']);	
            }

            $final_name = 'user-'. random_int(10,999) . '-@-' . time() . '.'.$ext;
            move_uploaded_file( $path_tmp, '../assets/uploads/avatars/'.$final_name);
            $_SESSION['utilisateur']['photo'] = $final_name;

            $statement = $pdo->prepare("UPDATE utilisateur SET photo=? WHERE id=?");
            $statement->execute(array($final_name,$_SESSION['utilisateur']['id'])); 
        }
	    if($valid == 1) {
			
			$_SESSION['utilisateur']['nom_complet'] = $_POST['fullname'];
	    	$_SESSION['utilisateur']['email'] = $_POST['email'];
            $_SESSION['utilisateur']['tele'] = $_POST['tele'];

			$statement = $pdo->prepare("UPDATE utilisateur SET nom_complet=?, email=?, tele=? WHERE id=?");
			$statement->execute(array($_POST['fullname'],$_POST['email'],$_POST['tele'],$_SESSION['utilisateur']['id']));

	    	$success_message = 'Les informations utilisateur sont mises à jour avec succès.';
	    }
	}

}
?>


<?php
if(isset($_POST['form2'])) {
	$valid = 1;

	if(empty($_POST['new_password']) || empty($_POST['conferm_password'])) {
        $valid = 0;
        $error_message = "Le mot de passe ne peut pas être vide.";
    }

    if( !empty($_POST['new_password']) && !empty($_POST['conferm_password']) ) {
    	if($_POST['new_password'] != $_POST['conferm_password']) {
	    	$valid = 0;
	        $error_message = "Les mots de passe ne correspondent pas.";	
    	}        
    }

    if($valid == 1) {

    	$_SESSION['utilisateur']['password'] = md5($_POST['new_password']);

		$statement = $pdo->prepare("UPDATE utilisateur SET password=? WHERE id=?");
		$statement->execute(array(md5($_POST['new_password']),$_SESSION['utilisateur']['id']));

    	$success_message = 'Le mot de passe utilisateur est mis à jour avec succès.';
    }

}
?>
<?php
$statement = $pdo->prepare("SELECT * FROM utilisateur WHERE id=?");
$statement->execute(array($_SESSION['utilisateur']['id']));
$statement->rowCount();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$full_name = $row['nom_complet'];
	$email     = $row['email'];
	$phone     = $row['tele'];
	$photo     = $row['photo'];
	$role      = $row['role'];
}
?>
<h1 class="h3 mb-2 text-gray-800">Renseignements personnels</h1>
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
    <a class="nav-link active" id="nav-info-tab" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-info" aria-selected="true">Modifier les informations</a>
    <a class="nav-link" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-controls="nav-password" aria-selected="false">Modifier le mot de passe</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active mt-4" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="avatar text-center ml-4">
                            <div class="avatar-inner parent-img mx-auto">
                                <?php if($photo == ''): ?>
                                    <img src="../assets/uploads/avatars/avatar0.jpg" alt="defualt avatar">
                                <?php else: ?>
                                    <img src="../assets/uploads/avatars/<?php echo $photo ?>" alt="<?php "Photo " . $full_name?>">
                                <?php endif ?>
                                <input type="file" name="photo" id="photo" class="avatar_custom">
                            </div>
                            <div>
                                <small class="muted-deep fw-normal">Seuls les <strong>jpg</strong>, <strong>jpeg</strong> et <strong>png</strong> sont autorisés.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nom et Prénom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-capitalize" value="<?php echo $full_name; ?>" required id="name" name="fullname" placeholder="Nom et Prénom">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Adresse e-mail <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" required id="email" value="<?php echo $email; ?>" name="email" placeholder="Adresse e-mail">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role">Rôle <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-capitalize" readonly id="role" value="<?php echo $role; ?>" name="role" placeholder="Le Rôle">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tele">Téléphone <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" required id="tele" value="<?php echo $phone; ?>" name="tele" placeholder="Téléphone">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 offset-md-6 d-flex flex-row justify-content-end">
                        <button type="submit" name="form1"  class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Editer le profil</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
  </div>
  <div class="tab-pane fade mt-4" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
    <form action="" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="new-password">Mot de passe <span class="text-danger">*</span></label>
                    <input type="password" required class="form-control" name="new_password" placeholder="Mot de passe" id="new-password" autocomplete="new-password">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="conferm-passwrod">Retaper le mot de passe <span class="text-danger">*</span></label>
                    <input type="password" required class="form-control" name="conferm_password" placeholder="Retaper le mot de passe" id="conferm-password" autocomplete="new-password">
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 offset-md-6 d-flex flex-row justify-content-end">
                        <button type="submit" name="form2"  class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Mettre à jour le mot de passe</span>
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