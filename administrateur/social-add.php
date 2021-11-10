<?php
    $title = "Ajouter un nouvel article";
    $before_css = '<link rel="stylesheet" href="css/vender/summernote.css">';
    require_once('header.php')
?>
<?php 
  if(isset($_POST['formN'])){
      $valid = 1;
      if(empty($_POST['social_name'])){
          $valid = 0;
          $error_message = "le nom de platfome obligatoire";
      }

      if($valid ==1){
        $statement = $pdo->prepare("INSERT INTO social(social_name,social_url,social_icon) VALUES(?,?,?)");
        $statement->execute(array($_POST['social_name'],$_POST['social_url'],$_POST['social_icon']));

        $success_message="platforme ajouter avec success";
    }
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
        <h6 class="m-0 font-weight-bold text-primary">Mes Rèsaux sociaux</h6>
        <div>
            <a href="social.php" class="btn btn-info">
                <span class="text">Afficher Mes Rèsaux</span>
            </a>
        </div>
    </div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name-article">Nom de platforme<span class="text-danger">*</span></label>
                        <input type="text" class="form-control text-capitalize" required id="social_name" name="social_name" placeholder="Entrez le nom de platfome">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category">Choisir une platforme <span class="text-danger">*</span></label>
                        <select class="form-control" name="social_icon" id="social_icon" required>
                            <option value="" hidden>Choisir une platforme</option>
                            <option value='<i class="fab fa-facebook"></i>'>facebook</option>
                            <option value='<i class="fab fa-instagram"></i>'>instagrame</option>
                            <option value='<i class="fab fa-youtube"></i>'>youtube</option>
                            <option value='<i class="fab fa-linkedin"></i>'>linkedin</option>
                            <option value='<i class="fab fa-twitter"></i>'>twitter</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="slug-page">Lien<span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control text-lowercase" id="social_url" name="social_url" placeholder="">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 offset-md-6 d-flex justify-content-around">
                            <button type="submit" name="formN"  class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Ajouter un nouvel article</span>
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