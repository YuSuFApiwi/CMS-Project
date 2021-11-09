<?php
    $title = "Ajouter une nouvelle page";
    $before_css = '<link rel="stylesheet" href="css/vender/summernote.css">';
    require_once('header.php')
?>
<?php
    if (isset($_POST['formP'])) {
        $valid = 1;

        if(empty($_POST['page_name'])) {
            $valid = 0;
            $error_message = "Le nom de la page ne peut pas être vide";
        } else {
            $statement = $pdo->prepare("SELECT * FROM page WHERE page_name=?");
            $statement->execute(array($_POST['page_name']));
            $total = $statement->rowCount();
            if($total) {
                $valid = 0;
                $error_message = "Le nom de la page existe déjà";
            }
        }

        $path = $_FILES['photo']['name'];
        $path_tmp = $_FILES['photo']['tmp_name'];

        if($path!='') {
            $ext = pathinfo( $path, PATHINFO_EXTENSION );
            $file_name = basename( $path, '.' . $ext );
            if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
                $valid = 0;
                $error_message = 'Vous devez avoir à télécharger un fichier jpg, jpeg, gif ou png pour la bannière';
            }
        } else {
            $valid = 0;
            $error_message = 'Vous devez avoir à sélectionner une photo pour la bannière';
        }

        if($valid == 1) {

            if($_POST['slug'] == '') {
                $lower_name = strtolower($_POST['page_name']);
                $page_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $lower_name);
            } else {
                $lower_name = strtolower($_POST['slug']);
                $page_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $lower_name);
            }

            $statement = $pdo->prepare("SELECT * FROM page WHERE page_slug=?");
            $statement->execute(array($page_slug));
            $total = $statement->rowCount();
            if($total) {
                $page_slug = $page_slug.'-1';
            }

            $final_name = 'page-banner-'. random_int(10,9999) . '@' .time().'.'.$ext;
            move_uploaded_file($path_tmp, '../assets/uploads/banners/'.$final_name );
            $statement = $pdo->prepare("INSERT INTO page (page_name,page_slug,page_content,page_layout,banner,status,meta_title,meta_keyword,meta_description) VALUES (?,?,?,?,?,?,?,?,?)");
            $statement->execute(array($_POST['page_name'],$page_slug,$_POST['content'],$_POST['page_layout'],$final_name,$_POST['status'],$_POST['meta_title'],$_POST['meta_keyword'],$_POST['meta_description']));

            $success_message = 'La page a été ajoutée avec succès.';
        }
    }
?>
<h1 class="h3 mb-2 text-gray-800">Ajouter une nouvelle page</h1>

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
        <h6 class="m-0 font-weight-bold text-primary">Informations sur les pages</h6>
        <div>
            <a href="page.php" class="btn btn-info">
                <span class="text">Afficher Les Pages</span>
            </a>
        </div>
    </div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name-page">Page de nom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control text-capitalize" required id="name-page" name="page_name" placeholder="Entrez le nom de la page">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="layout-page">Choisissez un type de mise en page <span class="text-danger">*</span></label>
                        <select class="form-control" name="page_layout" id="layout-page" required>
                            <option value="full width">Mise en page pleine largeur</option>
                            <option value="gallery">Gallery</option>
                            <option value="blog">Blog</option>
                            <option value="faq">Mise en page de la FAQ</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="slug-page">Slug <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control text-lowercase" id="slug-page" name="slug" placeholder="Example: about-us">
                        <span class="text-muted text-sm-left">generate slug automatic.</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="content_page">Contenu de la page <span class="text-danger">*</span></label>
                        <textarea rows="15" minlength="200" class="form-control" name="content" required style="min-height: 150px;" id="content_page"></textarea>
					</div>	
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="height: 53vh;" class="parent-img">
                                <img class="h-100 img-thumbnail w-100" id="img-banner" src="../assets/uploads/banners/defualt-banner.jpg" alt="image baniere">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="photo">Bannière (1280x375) <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="photo" id="photo" required>
                                <span class="text-muted text-sm-left">Seuls les jpg, jpeg, gif et png sont autorisés.</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="active">Active? <span class="text-danger">*</span></label>
                                <div class="form-control">
                                    <input type="radio" name="status" id="active" required value="active" class="custom-radio" checked>
                                    <label for="active" class="custom-control-inline">Oui</label>
                                    <input type="radio" name="status" id="inactive" required value="inactive" class="custom-radio">
                                    <label for="inactive" class="custom-control-inline">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">Meta title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required id="title" name="meta_title" placeholder="Meta Title">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="key">Meta Keyword <span class="text-muted">(Optional)</span></label>
                        <textarea rows="4" class="form-control" id="key" name="meta_keyword" style="min-height: 50px;" placeholder="Example: handcomm,blog,website,..."></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Meta Description <span class="text-muted">(Optional)</span></label>
                        <textarea rows="8" class="form-control" id="description" placeholder="Meta Description..." name="meta_description" style="min-height: 150px;"></textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 offset-md-6 d-flex justify-content-around">
                            <button type="submit" name="formP"  class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Ajouter une nouvelle page</span>
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