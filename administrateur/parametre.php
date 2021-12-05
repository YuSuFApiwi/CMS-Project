<?php
$title = 'Mes paramètres';
$before_css = '<link rel="stylesheet" href="css/vender/summernote.css">';
require_once('header.php')
?>

<?php
/* Update Page Home Here by APiwi */
if (isset($_POST['form0'])) {
    $valid = 1;
    function updatePageHome()
    {
        global $pdo;
        $header_status = getStatus($_POST['header_status']);
        $service_status = getStatus($_POST['service_status']);
        $about_status = getStatus($_POST['about_status']);
        $references_status = getStatus($_POST['references_status']);
        $partner_status = getStatus($_POST['partner_status']);
        $contact_status = getStatus($_POST['contact_status']);
        /* updating the setting in database (Apiwi)*/
        $statement = $pdo->prepare("UPDATE settings SET
            header_title=?,
            header_subtitle=?,
            header_description=?,
            header_nameButton=?,
            header_buttonUrl=?,
            header_status=?,
            service_title=?,
            service_subtitle=?,
            service_status=?,
            about_title=?,
            about_subtitle=?,
            about_description=?,
            about_shortDescription=?,
            about_status=?,
            references_title=?,
            references_subtitle=?,
            references_nameButton=?,
            references_buttonUrl=?,
            references_shortLine=?,
            references_status=?,
            partner_title=?,
            partner_subtitle=?,
            partner_nameButton=?,
            partner_buttonUrl=?,
            partner_shortLine=?,
            partner_status=?,
            contact_title=?,
            contact_subtitle=?,
            contact_status=?
            WHERE id=1");
        /* Execute Query Here */
        $statement->execute(array(
            $_POST['header_title'],
            $_POST['header_subtitle'],
            $_POST['header_description'],
            $_POST['header_nameButton'],
            $_POST['header_buttonUrl'],
            $header_status,
            $_POST['service_title'],
            $_POST['service_subtitle'],
            $service_status,
            $_POST['about_title'],
            $_POST['about_subtitle'],
            $_POST['about_description'],
            $_POST['about_shortDescription'],
            $about_status,
            $_POST['references_title'],
            $_POST['references_subtitle'],
            $_POST['references_nameButton'],
            $_POST['references_buttonUrl'],
            $_POST['references_shortLine'],
            $references_status,
            $_POST['partner_title'],
            $_POST['partner_subtitle'],
            $_POST['partner_nameButton'],
            $_POST['partner_buttonUrl'],
            $_POST['partner_shortLine'],
            $partner_status,
            $_POST['contact_title'],
            $_POST['contact_subtitle'],
            $contact_status
        ));
        return true;
    }

    $path_header = $_FILES['header_image']['name'];
    $path_tmp_header = $_FILES['header_image']['tmp_name'];
    $path_about = $_FILES['about_image']['name'];
    $path_tmp_about = $_FILES['about_image']['tmp_name'];
    
    if ($path_header != '') {
        $ext = pathinfo($path_header, PATHINFO_EXTENSION);
        $file_name = basename($path_header, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'JPG' && $ext != 'PNG' && $ext != 'JPEG' && $ext != 'GIF') {
            $valid = 0;
            $error_message = 'Vous devez avoir à télécharger un fichier jpg, jpeg, gif ou png (<b>En-tête de page</b>)';
        }    
    }
    if ($path_about != '') {
        $ext = pathinfo($path_about, PATHINFO_EXTENSION);
        $file_name = basename($path_about, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'JPG' && $ext != 'PNG' && $ext != 'JPEG' && $ext != 'GIF') {
            $valid = 0;
            $error_message = 'Vous devez avoir à télécharger un fichier jpg, jpeg, gif ou png (<b>À propos de nous</b>)';
        }    
    }

    if ($valid == 1 || $path_about != '' || $path_header != '') {
        $statement = $pdo->prepare("SELECT header_image,about_image FROM settings WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $header_img = $row['header_image'];
            $aboute_img = $row['about_image'];
        }
        if ($path_header != '' && $header_img != '' && $header_img != 'defualt-accueil.jpg') {
            unlink('../assets/uploads/accueil/' . $header_img);
            $final_name_header = 'header-' . time() . '-@-' . random_int(999,99999) . '.' . $ext;
            move_uploaded_file($path_tmp_header, '../assets/uploads/accueil/' . $final_name_header);
            $statement = $pdo->prepare("UPDATE settings SET header_image=? WHERE id=1");   
            $statement->execute(array($final_name_header));
        }
        if ($path_about != '' && $aboute_img != '' && $aboute_img != 'defualt-accueil.jpg') {
            unlink('../assets/uploads/accueil/' . $aboute_img);
            $final_name_about = 'about-' . time() . '-@-' . random_int(999,99999) . '.' . $ext;
            move_uploaded_file($path_tmp_about, '../assets/uploads/accueil/' . $final_name_about);
            $statement = $pdo->prepare("UPDATE settings SET about_image=? WHERE id=1");   
            $statement->execute(array($final_name_about));
        }
    }
    if ($valid == 1 && updatePageHome()) {
        $success_message = "La page d'accueil a été mise à jour avec succès.";
    }

}

if (isset($_POST['form1'])) {
    $statement = $pdo->prepare("UPDATE settings SET footer_about=?, footer_copyright=?, contact_address=?, contact_email=?, contact_phone=?, contact_fax=? WHERE id=1");
    $statement->execute(array($_POST['content'], $_POST['footer_copyright'], $_POST['contact_address'], $_POST['contact_email'], $_POST['phone'], $_POST['fax']));

    $success_message = 'Les paramètres de contenu généraux ont été mis à jour avec succès.';
}

if (isset($_POST['form2'])) {
    $statement = $pdo->prepare("UPDATE settings SET meta_title=?, meta_keyword=?, meta_description=? WHERE id=1");
    $statement->execute(array($_POST['meta_title'], $_POST['meta_keyword'], $_POST['meta_description']));

    $success_message = 'Les paramètres Home Meta sont mis à jour avec succès.';
}

if (isset($_POST['form3'])) {
    $valid = 1;

    $path = $_FILES['photo_logo']['name'];
    $path_tmp = $_FILES['photo_logo']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        $error_message = 'Vous devez obligatoirement sélectionner une photo';
    } else {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'JPG' && $ext != 'PNG' && $ext != 'JPEG' && $ext != 'GIF') {
            $valid = 0;
            $error_message = 'Vous devez avoir à télécharger un fichier jpg, jpeg, gif ou png';
        }
    }

    if ($valid == 1) {
        $statement = $pdo->prepare("SELECT * FROM settings WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $logo = $row['logo'];
            unlink('../assets/uploads/logo/' . $logo);
        }

        $final_name = 'logo' . '.' . $ext;
        move_uploaded_file($path_tmp, '../assets/uploads/logo/' . $final_name);

        $statement = $pdo->prepare("UPDATE settings SET logo=? WHERE id=1");
        $statement->execute(array($final_name));

        $success_message = 'Le logo est mis à jour avec succès.';
    }
}

if (isset($_POST['form4'])) {
    $valid = 1;
    $path = $_FILES['photo_favicon']['name'];
    $path_tmp = $_FILES['photo_favicon']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        $error_message = 'Vous devez obligatoirement sélectionner une photo';
    } else {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'JPG' && $ext != 'PNG' && $ext != 'JPEG' && $ext != 'GIF') {
            $valid = 0;
            $error_message = 'Vous devez avoir à télécharger un fichier jpg, jpeg, gif ou png';
        }
    }

    if ($valid == 1) {
        $statement = $pdo->prepare("SELECT * FROM settings WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $favicon = $row['favicon'];
            unlink('../assets/uploads/favicon/' . $favicon);
        }
        $final_name = 'favicon' . '.' . $ext;
        move_uploaded_file($path_tmp, '../assets/uploads/favicon/' . $final_name);
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
    /* Page Home Start */
    $header_title            = $row['header_title'];
    $header_subtitle         = $row['header_subtitle'];
    $header_description      = $row['header_description'];
    $header_image            = $row['header_image'];
    $header_nameButton       = $row['header_nameButton'];
    $header_buttonUrl        = $row['header_buttonUrl'];
    $header_status           = $row['header_status'];
    $service_title           = $row['service_title'];
    $service_subtitle        = $row['service_subtitle'];
    $service_status          = $row['service_status'];
    $about_title             = $row['about_title'];
    $about_subtitle          = $row['about_subtitle'];
    $about_description       = $row['about_description'];
    $about_shortDescription  = $row['about_shortDescription'];
    $about_image             = $row['about_image'];
    $about_status            = $row['about_status'];
    $references_title        = $row['references_title'];
    $references_subtitle     = $row['references_subtitle'];
    $references_nameButton   = $row['references_nameButton'];
    $references_buttonUrl    = $row['references_buttonUrl'];
    $references_shortLine    = $row['references_shortLine'];
    $references_status       = $row['references_status'];
    $partner_title           = $row['partner_title'];
    $partner_subtitle        = $row['partner_subtitle'];
    $partner_nameButton      = $row['partner_nameButton'];
    $partner_buttonUrl       = $row['partner_buttonUrl'];
    $partner_shortLine       = $row['partner_shortLine'];
    $partner_status          = $row['partner_status'];
    $contact_title           = $row['contact_title'];
    $contact_subtitle        = $row['contact_subtitle'];
    $contact_status          = $row['contact_status'];
    /* End Page Home */
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
        <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Page d'accueil</a>
        <a class="nav-link" id="nav-content-tab" data-toggle="tab" href="#nav-content" role="tab" aria-controls="nav-content" aria-selected="true">Contenu Général</a>
        <a class="nav-link" id="nav-meta-tab" data-toggle="tab" href="#nav-meta" role="tab" aria-controls="nav-meta" aria-selected="true">Méta de la page d'accueil</a>
        <a class="nav-link" id="nav-logo-tab" data-toggle="tab" href="#nav-logo" role="tab" aria-controls="nav-logo" aria-selected="true">Logo</a>
        <a class="nav-link" id="nav-favicon-tab" data-toggle="tab" href="#nav-favicon" role="tab" aria-controls="nav-favicon" aria-selected="true">Favicon</a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active mt-4" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Start Row One OF this page -->
            <div class="row">
                <div class="col-md-12 col-12 accordion" id="accordionHome">
                    <!-- Start crad Header -->
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0 flex-row d-flex">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    En-tête de page
                                </button>
                                <span class="justify-content-end">
                                    <i class="fa fa-th-large"></i>
                                </span>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionHome">
                            <div class="card-body row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="header-title">Titre <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="<?php echo $header_title; ?>" required id="header-title" name="header_title" placeholder="Entrez le titre">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="header-subtitle">Sous-titre <span class="text-muted">(Optionnel)</span></label>
                                        <input type="text" class="form-control" value="<?php echo $header_subtitle; ?>" id="header-subtitle" name="header_subtitle" placeholder="Entrer le sous-titre">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="header_desc">Description de l'en-tête <span class="text-muted">(Optionnel)</span></label>
                                        <textarea rows="3" class="form-control home_page" name="header_description" style="min-height: 150px;" id="header_desc" date-heghit='10px'><?php echo $header_description ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="header-img">Image <span class="text-muted">(Optionnel)</span></label>
                                                <input type="file" class="form-control" id="header-img" name="header_image">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="header-Btn">Nom du bouton <span class="text-muted">(Optionnel)</span></label>
                                                <input type="text" class="form-control" value="<?php echo $header_nameButton; ?>" id="header-Btn" name="header_nameButton" placeholder="Entrer le nom du bouton">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="header-btn-url">Lien du bouton <span class="text-muted">(Optionnel)</span></label>
                                                <input type="url" class="form-control" value="<?php echo $header_buttonUrl; ?>" id="header-btn-url" name="header_buttonUrl" placeholder="Lien">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group d-flex">
                                                <label for="header-status" class="w-100 align-self-md-end">Afficher sur la page d'accueil ?</label>
                                                <input type="checkbox" class="form-control" value="1" <?php echo $header_status == 1 ? "checked" : ""; ?> id="header-status" name="header_status">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Voir la photo
                                            (<small class="muted-deep fw-normal">Seuls les <strong>jpg</strong>, <strong>jpeg</strong> et <strong>png</strong> sont autorisés. (570x570)</small>)
                                        </label>
                                        <div class="header-img text-center">
                                            <div class="header-img-inner parent-img mx-auto">
                                                <?php if ($header_image != '' && $header_image != 'defualt-accueil.jpg') : ?>
                                                    <img src="<?php echo BASE_URL ?>assets/uploads/accueil/<?php echo $header_image; ?>" alt="Photo Header Page d'accueil">
                                                <?php else : ?>
                                                    <img src="<?php echo BASE_URL ?>assets/uploads/accueil/defualt-accueil.jpg" alt="Photo default page d'accueil">
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End card -->

                    <!-- Start crad Serice -->
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0 flex-row d-flex">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    Zone de service
                                </button>
                                <span class="justify-content-end">
                                    <i class="fa fa-sitemap"></i>
                                </span>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionHome">
                            <div class="card-body row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="service-title">Titre <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="<?php echo $service_title; ?>" required id="service-title" name="service_title" placeholder="Entrez le titre">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="service-subtitle">Sous-titre <span class="text-muted">(Optionnel)</span></label>
                                        <input type="text" class="form-control" value="<?php echo $service_subtitle; ?>" id="service-subtitle" name="service_subtitle" placeholder="Entrer le sous-titre">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group d-flex">
                                        <label for="service-status" class="w-100 align-self-md-end">Afficher sur la page d'accueil ?</label>
                                        <input type="checkbox" class="form-control" value="1" <?php echo $service_status == 1 ? "checked" : ""; ?> id="service-status" name="service_status">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End card -->

                    <!-- Start crad About -->
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0 flex-row d-flex">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    À propos de nous
                                </button>
                                <span class="justify-content-end">
                                    <i class="fa fa-medal"></i>
                                </span>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionHome">
                            <div class="card-body row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="about-title">Titre <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="<?php echo $about_title; ?>" required id="about-title" name="about_title" placeholder="Entrez le titre">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="about-subtitle">Sous-titre <span class="text-muted">(Optionnel)</span></label>
                                                <input type="text" class="form-control" value="<?php echo $about_subtitle; ?>" id="about-subtitle" name="about_subtitle" placeholder="Entrer le sous-titre">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="about-img">Image <span class="text-muted">(Optionnel)</span></label>
                                                <input type="file" class="form-control" id="about-img" name="about_image">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group d-flex">
                                                <label for="about-status" class="w-100 align-self-md-end">Afficher sur la page d'accueil ?</label>
                                                <input type="checkbox" class="form-control" value="1" <?php echo $about_status == 1 ? "checked" : ""; ?> id="about-status" name="about_status">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Voir la photo
                                            (<small class="muted-deep fw-normal">Seuls les <strong>jpg</strong>, <strong>jpeg</strong> et <strong>png</strong> sont autorisés. (570x570)</small>)
                                        </label>
                                        <div class="header-img about-img text-center">
                                            <div class="header-img-inner parent-img mx-auto">
                                                <?php if ($about_image != '' && $about_image != 'defualt-accueil.jpg') : ?>
                                                    <img src="<?php echo BASE_URL ?>assets/uploads/accueil/<?php echo $about_image; ?>" alt="Photo About Page d'accueil">
                                                <?php else : ?>
                                                    <img src="<?php echo BASE_URL ?>assets/uploads/accueil/defualt-accueil.jpg" alt="Photo default page d'accueil">
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="about_desc">La description <span class="text-muted">(Optionnel)</span></label>
                                        <textarea rows="3" class="form-control home_page" name="about_description" style="min-height: 150px;" id="about_desc" date-heghit='10px'><?php echo $about_description ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="about-short-desc">Brève description <span class="text-muted">(Optionnel)</span></label>
                                        <textarea rows="3" class="form-control home_page" name="about_shortDescription" style="min-height: 150px;" id="about-short-desc" date-heghit='10px'><?php echo $about_description ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End card -->

                    <!-- Start crad References -->
                    <div class="card">
                        <div class="card-header" id="headingFor">
                            <h2 class="mb-0 flex-row d-flex">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFor" aria-expanded="true" aria-controls="collapseFor">
                                    Les références
                                </button>
                                <span class="justify-content-end">
                                    <i class="fa fa-record-vinyl"></i>
                                </span>
                            </h2>
                        </div>
                        <div id="collapseFor" class="collapse" aria-labelledby="headingFor" data-parent="#accordionHome">
                            <div class="card-body row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="references-title">Titre <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="<?php echo $references_title; ?>" required id="references-title" name="references_title" placeholder="Entrez le titre">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="references-subtitle">Sous-titre <span class="text-muted">(Optionnel)</span></label>
                                        <input type="text" class="form-control" value="<?php echo $references_subtitle; ?>" id="references-subtitle" name="references_subtitle" placeholder="Entrer le sous-titre">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="references-Btn">Nom du bouton <span class="text-muted">(Optionnel)</span></label>
                                        <input type="text" class="form-control" value="<?php echo $references_nameButton; ?>" id="references-Btn" name="references_nameButton" placeholder="Entrer le nom du bouton">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="references-btn-url">Lien du bouton <span class="text-muted">(Optionnel)</span></label>
                                        <input type="url" class="form-control" value="<?php echo $references_buttonUrl; ?>" id="references-btn-url" name="references_buttonUrl" placeholder="Lien">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="references-Line">Phrase courte <span class="text-muted">(Optionnel)</span></label>
                                        <input type="text" class="form-control" value="<?php echo $references_shortLine; ?>" id="references-Line" name="references_shortLine" placeholder="Entrez la phrase courte">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group d-flex">
                                        <label for="references-status" class="w-100 align-self-md-end">Afficher sur la page d'accueil ?</label>
                                        <input type="checkbox" class="form-control" value="1" <?php echo $references_status == 1 ? "checked" : ""; ?> id="references-status" name="references_status">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End card -->

                    <!-- Start crad Partenaire -->
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h2 class="mb-0 flex-row d-flex">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                    Les partenaires
                                </button>
                                <span class="justify-content-end">
                                    <i class="fa fa-users"></i>
                                </span>
                            </h2>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionHome">
                            <div class="card-body row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="partner-title">Titre <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="<?php echo $partner_title; ?>" required id="partner-title" name="partner_title" placeholder="Entrez le titre">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="partner-subtitle">Sous-titre <span class="text-muted">(Optionnel)</span></label>
                                        <input type="text" class="form-control" value="<?php echo $partner_subtitle; ?>" id="partner-subtitle" name="partner_subtitle" placeholder="Entrer le sous-titre">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="partner-Btn">Nom du bouton <span class="text-muted">(Optionnel)</span></label>
                                        <input type="text" class="form-control" value="<?php echo $partner_nameButton; ?>" id="partner-Btn" name="partner_nameButton" placeholder="Entrer le nom du bouton">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="partner-btn-url">Lien du bouton <span class="text-muted">(Optionnel)</span></label>
                                        <input type="url" class="form-control" value="<?php echo $partner_buttonUrl; ?>" id="partner-btn-url" name="partner_buttonUrl" placeholder="Lien">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="partner-Line">Phrase courte <span class="text-muted">(Optionnel)</span></label>
                                        <input type="text" class="form-control" value="<?php echo $partner_shortLine; ?>" id="partner-Line" name="partner_shortLine" placeholder="Entrez la phrase courte">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group d-flex">
                                        <label for="partner-status" class="w-100 align-self-md-end">Afficher sur la page d'accueil ?</label>
                                        <input type="checkbox" class="form-control" value="1" <?php echo $partner_status == 1 ? "checked" : ""; ?> id="partner-status" name="partner_status">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End card -->

                    <!-- Start crad Contactez-nous -->
                    <div class="card">
                        <div class="card-header" id="headingSix">
                            <h2 class="mb-0 flex-row d-flex">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                    Contactez-nous
                                </button>
                                <span class="justify-content-end">
                                    <i class="fa fa-envelope-open-text"></i>
                                </span>
                            </h2>
                        </div>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionHome">
                            <div class="card-body row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact-title">Titre <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="<?php echo $contact_title; ?>" required id="contact-title" name="contact_title" placeholder="Entrez le titre">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact-subtitle">Sous-titre <span class="text-muted">(Optionnel)</span></label>
                                        <input type="text" class="form-control" value="<?php echo $contact_subtitle; ?>" id="contact-subtitle" name="contact_subtitle" placeholder="Entrer le sous-titre">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group d-flex">
                                        <label for="contact-status" class="w-100 align-self-md-end">Afficher sur la page d'accueil ?</label>
                                        <input type="checkbox" class="form-control" value="1" <?php echo $contact_status == 1 ? "checked" : ""; ?> id="contact-status" name="contact_status">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End card -->
                    <!-- End tags & Script by Youssef Apiwi -->
                </div><!-- End Accordion -->
                <!-- Button Update -->
                <div class="col-md-12 mb-4 mt-4">
                    <div class="row">
                        <div class="col-md-6 offset-md-6 d-flex flex-row justify-content-end">
                            <button type="submit" name="form0" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span class="text">Mettre à jour la page d'accueil</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div><!-- End Row One OF this page -->
        </form>
    </div>
    <div class="tab-pane fade mt-4" id="nav-content" role="tabpanel" aria-labelledby="nav-content-tab">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="content_page">Pied de page <span class="text-muted">(footer)</span> - À propos de nous <span class="text-danger">*</span></label>
                        <textarea rows="15" class="form-control" name="content" required style="min-height: 150px;" id="content_page"><?php echo $footer_about ?></textarea>
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
                        <input type="text" class="form-control text-lowercase" value="<?php echo $contact_address ?>" required id="address" name="contact_address" placeholder="Entrer l'adresse de contact">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="copyright">Pied de page - Copyright <span class="text-danger">*</span></label>
                        <input type="text" class="form-control text-lowercase" value="<?php echo $footer_copyright ?>" required id="copyright" name="footer_copyright" placeholder="Entrer pied de page - Copyright">
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="row">
                        <div class="col-md-6 offset-md-6 d-flex flex-row justify-content-end">
                            <button type="submit" name="form1" class="btn btn-info btn-icon-split">
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
                            <button type="submit" name="form2" class="btn btn-info btn-icon-split">
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
                            <button type="submit" name="form3" class="btn btn-info btn-icon-split">
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
                            <button type="submit" name="form4" class="btn btn-info btn-icon-split">
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