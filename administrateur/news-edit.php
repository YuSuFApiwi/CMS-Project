<?php
    $title = "Modifier les actualités";
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
            $statement = $pdo->prepare("SELECT * FROM news WHERE id=?");
            $statement->execute(array($_REQUEST['id']));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row) {
                $old_news_title = $row['news_title'];
            }
    
            $statement = $pdo->prepare("SELECT * FROM news WHERE news_title=? and news_title!=?");
            $statement->execute(array($_POST['name_article'],$old_news_title));
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
    
        $old_photo = $_POST['old_photo'];
    
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
                $news_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $old_name);;
            } else {
                $old_name = strtolower($_POST['slug']);
                $news_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $old_name);
            }

            $statement = $pdo->prepare("SELECT * FROM news WHERE news_slug=? AND news_title!=?");
            $statement->execute(array($news_slug,$old_news_title));
            $total = $statement->rowCount();
            if($total) {
                $news_slug = $news_slug.'-1';
            }

            if($old_photo != '' && $path == '') {
                $statement = $pdo->prepare("UPDATE news SET news_title=?, news_slug=?, news_content=?, news_date=?, category_id=?, publisher=?, meta_title=?, meta_keyword=?, meta_description=? WHERE id=?");
                $statement->execute(array($_POST['name_article'],$news_slug,$_POST['content'],$_POST['news_date'],$_POST['category_id'],$publisher,$_POST['meta_title'],$_POST['meta_keyword'],$_POST['meta_description'],$_REQUEST['id']));
            }

            if($old_photo == 'defualt-news.jpg' && $path == '') {
                $statement = $pdo->prepare("UPDATE news SET news_title=?, news_slug=?, news_content=?, news_date=?, category_id=?, publisher=?, meta_title=?, meta_keyword=?, meta_description=? WHERE id=?");
                $statement->execute(array($_POST['name_article'],$news_slug,$_POST['content'],$_POST['news_date'],$_POST['category_id'],$publisher,$_POST['meta_title'],$_POST['meta_keyword'],$_POST['meta_description'],$_REQUEST['id']));
            }
    
            if($old_photo != 'defualt-news.jpg' && $path != '' && $old_photo == '') {
    
                $final_name = 'news-'. random_int(10,9999) . '@' .time().'.'.$ext;
                move_uploaded_file( $path_tmp, '../assets/uploads/news/'.$final_name );
                $statement = $pdo->prepare("UPDATE news SET news_title=?, news_slug=?, news_content=?, news_date=?, photo=?, category_id=?, publisher=?, meta_title=?, meta_keyword=?, meta_description=? WHERE id=?");
                $statement->execute(array($_POST['name_article'],$news_slug,$_POST['content'],$_POST['news_date'],$final_name,$_POST['category_id'],$publisher,$_POST['meta_title'],$_POST['meta_keyword'],$_POST['meta_description'],$_REQUEST['id']));
            }

            if($old_photo != 'defualt-news.jpg' && $path != '' && $old_photo != '') {
    
                unlink('../assets/uploads/news/'.$old_photo);
    
                $final_name = 'news-'. random_int(10,9999) . '@' .time().'.'.$ext;
                move_uploaded_file( $path_tmp, '../assets/uploads/news/'.$final_name );
    
                $statement = $pdo->prepare("UPDATE news SET news_title=?, news_slug=?, news_content=?, news_date=?, photo=?, category_id=?, publisher=?, meta_title=?, meta_keyword=?, meta_description=? WHERE id=?");
                $statement->execute(array($_POST['name_article'],$news_slug,$_POST['content'],$_POST['news_date'],$final_name,$_POST['category_id'],$publisher,$_POST['meta_title'],$_POST['meta_keyword'],$_POST['meta_description'],$_REQUEST['id']));
            }
            $success_message = 'Les nouvelles ont été mises à jour avec succès!';
        }
    }
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	$statement = $pdo->prepare("SELECT * FROM news WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>
<h1 class="h3 mb-2 text-gray-800">Modifier les actualités</h1>
<?php
$statement = $pdo->prepare("SELECT * FROM news WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$news_title       = $row['news_title'];
	$news_slug        = $row['news_slug'];
	$news_content     = $row['news_content'];
	$news_date        = $row['news_date'];
	$photo            = $row['photo'];
	$category_id      = $row['category_id'];
	$publisher        = $row['publisher'];
	$meta_title       = $row['meta_title'];
	$meta_keyword     = $row['meta_keyword'];
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
                        <input type="text" class="form-control" required value="<?php echo $news_title ?>" id="name-article" name="name_article" placeholder="Entrez le titre de l'actualité">
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
                                    <option value="<?php echo $row['id']; ?>" <?php echo ($category_id == $row['id']) ? 'selected':''; ?>><?php echo $row['category_name']; ?></option>
                                    <?php
                                }
					        ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="slug-page">Lien personnalisé <span class="text-muted">(Optionnel)</span></label>
                        <input type="text" class="form-control text-lowercase" id="slug-page" name="slug" value="<?php echo $news_slug ?>" placeholder="Exemple: titre-de-l'actualite">
                        <span class="text-muted text-sm-left">laisse vide pour génerer automatiquement</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="content-news">Contenu de l'actualité <span class="text-danger">*</span></label>
                        <textarea rows="15" minlength="200" class="form-control" name="content" style="min-height: 150px;" required id="content-news"><?php echo $news_content ?></textarea>
					</div>	
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date-news">Date de publication des nouvelles <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="news_date" value="<?php echo $news_date ?>" id="date-news" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="publisher-name">Éditeur <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="<?php echo $publisher ?>" name="publisher" id="publisher-name" required>
                    </div>
                </div>
                <input type="hidden" name="old_photo" value="<?php echo $photo; ?>">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="height: 53vh;" class="parent-img">
                                <?php if($photo == ''): ?>
                                    <img class="h-100 img-thumbnail w-100" id="img-banner" src="../assets/uploads/news/defualt-news.jpg" alt="image news">
                                <?php else: ?>
                                    <img class="h-100 img-thumbnail w-100" id="img-banner" src="../assets/uploads/news/<?php echo $photo ?>" alt="image news">
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
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">Meta titre <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required id="title" value="<?php echo $meta_title ?>" name="meta_title" placeholder="Meta titre">
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

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 offset-md-6 d-flex flex-row justify-content-end">
                            <button type="submit" name="formN"  class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span class="text">Mettre à jour l'article</span>
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