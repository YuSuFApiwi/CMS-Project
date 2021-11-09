<?php
    $title = "Ajouter un nouvel article";
    $before_css = '<link rel="stylesheet" href="css/vender/summernote.css">';
    require_once('header.php')
?>
<?php
    if (isset($_POST['formN'])) {
        $valid = 1;

        if(empty($_POST['name_article'])) {
            $valid = 0;
            $error_message = "Le titre de l'actualité ne peut pas être vide";
        } else {
            $statement = $pdo->prepare("SELECT * FROM news WHERE news_title=?");
            $statement->execute(array($_POST['name_article']));
            $total = $statement->rowCount();
            if($total) {
                $valid = 0;
                $error_message = "Le titre de l'actualité existe déjà";
            }
        }
    
        if(empty($_POST['content'])) {
            $valid = 0;
            $error_message = 'Le contenu des actualités ne peut pas être vide';
        }
    
        if(empty($_POST['news_date'])) {
            $valid = 0;
            $error_message = 'La date de publication des nouvelles ne peut pas être vide';
        }
    
        if(empty($_POST['category_id'])) {
            $valid = 0;
            $error_message = 'Vous devez obligatoirement sélectionner une catégorie';
        }
    
    
        if($_POST['publisher'] == '') {
            $publisher = $_SESSION["utilisateur"]["nom_complet"];
        } else {
            $publisher = $_POST['publisher'];	
        }
    
    
        $path = $_FILES['photo']['name'];
        $path_tmp = $_FILES['photo']['tmp_name'];
    
    
        if($path!='') {
            $ext = pathinfo( $path, PATHINFO_EXTENSION );
            $file_name = basename( $path, '.' . $ext );
            if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
                $valid = 0;
                $error_message = 'Vous devez avoir à télécharger un fichier jpg, jpeg, gif ou png';
            }
        }
        
    
        if($valid == 1) {
    
            if($_POST['slug'] == '') {
                $old_name = strtolower($_POST['name_article']);
                $news_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $old_name);
            } else {
                $old_name = strtolower($_POST['slug']);
                $news_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $old_name);
            }

            $statement = $pdo->prepare("SELECT * FROM news WHERE news_slug=?");
            $statement->execute(array($news_slug));
            $total = $statement->rowCount();
            if($total) {
                $news_slug = $news_slug.'-1';
            }
    
            if($path=='') {
                $statement = $pdo->prepare("INSERT INTO news (news_title,news_slug,news_content,news_date,photo,category_id,publisher,total_view,meta_title,meta_keyword,meta_description) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                $statement->execute(array($_POST['name_article'],$news_slug,$_POST['content'],$_POST['news_date'],'',$_POST['category_id'],$publisher,0,$_POST['meta_title'],$_POST['meta_keyword'],$_POST['meta_description']));
            } else {
                $final_name = 'news-'. random_int(10,9999) . '@' .time().'.'.$ext;
                move_uploaded_file( $path_tmp, '../assets/uploads/news/'.$final_name );
    
                $statement = $pdo->prepare("INSERT INTO news (news_title,news_slug,news_content,news_date,photo,category_id,publisher,total_view,meta_title,meta_keyword,meta_description) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                $statement->execute(array($_POST['name_article'],$news_slug,$_POST['content'],$_POST['news_date'],$final_name,$_POST['category_id'],$publisher,0,$_POST['meta_title'],$_POST['meta_keyword'],$_POST['meta_description']));
            }
        
            $success_message = 'Les nouvelles ont été ajoutées avec succès !';
        }
    }
?>
<h1 class="h3 mb-2 text-gray-800">Ajouter une nouvelle Article</h1>

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
        <h6 class="m-0 font-weight-bold text-primary">Article information</h6>
        <div>
            <a href="news.php" class="btn btn-info">
                <span class="text">Afficher des articles</span>
            </a>
        </div>
    </div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name-article">Titre de l'actualité <span class="text-danger">*</span></label>
                        <input type="text" class="form-control text-capitalize" required id="name-article" name="name_article" placeholder="Entrez le titre de l'actualité">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category">Choisir une catégorie <span class="text-danger">*</span></label>
                        <select class="form-control" name="category_id" id="category" required>
                            <option value="" hidden>Choisir une catégorie</option>
                            <?php
                                $i=0;
                                $statement = $pdo->prepare("SELECT * FROM categories ORDER BY category_name ASC");
                                $statement->execute();
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
                                    <?php
                                }
					        ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="slug-page">Slug <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control text-lowercase" id="slug-page" name="slug" placeholder="Example: titre-de-l'actualite">
                        <span class="text-muted text-sm-left">generate slug automatic.</span>
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
                        <label for="date-news">Date de publication des nouvelles <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="news_date" id="date-news" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="publisher-name">Éditeur <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION["utilisateur"]["nom_complet"] ?>" name="publisher" id="publisher-name" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="height: 53vh;" class="parent-img">
                                <img class="h-100 img-thumbnail w-100" id="img-banner" src="../assets/uploads/news/defualt-news.jpg" alt="image baniere">
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