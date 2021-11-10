<?php
    $title = "Mes Parametre";
    $before_css = '<link rel="stylesheet" href="css/vender/summernote.css">';
    require_once('header.php')
?>

<?php
    if(isset($_POST['formP'])){
        $valid = 1;
        if(empty($_POST['footer_about'])){
            $valid = 0;
            $error_message = "footer abour ne peut pas être vide";
        }else{
            $statement = $pdo->prepare("SELECT * FROM settings");
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $old_footer_about =$result['footer_about'];

            $statement = $pdo->prepare("SELECT * FROM settings WHERE footer_about=? and footer_about!=?");
            $statement->execute(array($_POST['footer_about'],$old_footer_about));
            $total = $statement->rowCount();
            if($total){
                $valid = 1; 
                $error_message ="footer about existe dèjà";
            }
        }

        $path = $_FILES['logo']['name'];
        $path_tmp = $_FILES['logo']['tmp_name'];
        

        $path_fav = $_FILES['favicon']['name'];
        $path_tmp_fav = $_FILES['favicon']['tmp_name'];

        
        if(!$path!='' && !$path_fav!=''){
            $ext = pathinfo($path,PATHINFO_EXTENSION);
            $file_name = basename($path,'.'.$ext);
            if($ext!='jpg' && $ext!='png' && $ext !='jpeg' && $ext!='gif'){
                $valid = 0;
                $error_message = 'vous devez avoir à télécharger  un fichier jpg, jpeg, gif ou png pour le logo';
            }
        }

        if($valid ==1){
            if($path == ''){
                $statement = $pdo->prepare("UPDATE settings SET footer_about=?, footer_copyeight=?,contct_adress=?,contact_email=?,contact_phone=?,meta_title=?,meta_key=?,meta_description=? WHERE id=1");
                $statement->execute(array($_POST['footer_about'],$_POST['footer_copyeight'],$_POST['contct_adress'],$_POST['contact_email'],$_POST['contact_phone'],$_POST['meta_title'],$_POST['meta_key'],$_POST['meta_description']));
            }else{
                unlink('../assets/uplods/logo/'.$_POST['old_logo']);

                $final_name ='logo-'.random_int(10,9999).'@'.time().'.'.$ext;
                move_uploaded_file($path_tmp,'../assets/uplode/logo/'.$final_name);



                unlink('../assets/uplods/favicon/'.$_POST['old_favicone']);

                $final_name_favc ='favicon-'.random_int(10,9999).'@'.time().'.'.$ext;
                move_uploaded_file($path_tmp_fav,'../assets/uplode/favicon/'.$final_name_favc);

                $statement = $pdo->prepare("UPDATE settings SET footer_about=?, footer_copyeight=?,logo=?,favicon=?,contct_adress=?,contact_email=?,contact_phone=?,meta_title=?,meta_key=?,meta_description=? WHERE id=1");
                $statement->execute(array($_POST['footer_about'],$_POST['footer_copyeight'],$final_name,$final_name_favc,$_POST['contct_adress'],$_POST['contact_email'],$_POST['contact_phone'],$_POST['meta_title'],$_POST['meta_key'],$_POST['meta_description']));
            }

            $success_message = 'les parmetre est mis à jour avec success.';
        }
    }
    
?>

<?php
   
	$statement = $pdo->prepare("SELECT * FROM settings");
    //var_dump($statement);
	 $statement->execute();
	//$total = $statement->rowCount();
	$result = $statement->fetch(PDO::FETCH_ASSOC);

        $footer_about = $result['footer_about'];
        $footer_copyeight = $result['footer_copyeight'];
        $contct_adress = $result['contct_adress'];
        $contact_email = $result['contact_email'];
        $contact_phone = $result['contact_phone'];
        $logo = $result['logo'];
        $favicon  = $result['favicon'];
        $meta_title = $result['meta_title'];
        $meta_keyword = $result['meta_key'];
        $meta_description = $result['meta_description'];

   
?>

<?php
   
	 $stat = $pdo->prepare("SELECT * FROM social");
	 $stat->execute();
	//$total = $statement->rowCount();
	$res = $stat->fetchAll(PDO::FETCH_ASSOC);
    foreach($res as $row)
    {
        $social_name = $row['social_name'];
        $social_url = $row['social_url'];
        $social_icon = $row['social_icon'];
    }
   
?>

<h1 class="h3 mb-2 text-gray-800">Modifier les Parametres</h1>

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
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active mt-4" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Informations sur les parmaetres</h6>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="footer_about">footer_about <span class="text-danger">*</span></label>
                        <input type="text" class="form-control text-capitalize" required id="footer_about" value="<?php echo $footer_about; ?>" name="footer_about" placeholder="Entrez footer about">
                    </div>
                </div>
                <input type="hidden" name="old_banner" value="<?php echo $banner ?>">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="footer_copyeight">footer copyright<span class="text-danger">*</span></label>
                        <input type="text" class="form-control text-capitalize" required id="footer_copyeight" value="<?php echo $footer_copyeight; ?>" name="footer_copyeight" placeholder="Entrez  footer copyright">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="contct_adress">contct adress <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control text-lowercase" id="contct_adress" value="<?php echo $contct_adress; ?>" name="contct_adress" placeholder="contct adress">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="contact_email">contact email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control text-lowercase" id="contact_email" value="<?php echo $contact_email; ?>" name="contact_email" placeholder="exempel@mail.com">
					</div>	
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="contact_phone">contact phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control text-lowercase" id="contact_phone" value="<?php echo $contact_phone; ?>" name="contact_phone" placeholder="+33">
					</div>	
                </div>
                <input type="hidden" name="old_logo" value="<?php echo $logo ?>">
                <input type="hidden" name="old_favicone" value="<?php echo $favicon ?>">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="height: 23vh;" class="parent-img">
                                <img class="h-100 img-thumbnail w-100" id="img-logo" src="<?php echo BASE_URL; ?>assets/uploads/banners/<?php echo $logo; ?>" alt="logo">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="logo">Logo<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="logo" id="logo">
                                <span class="text-muted text-sm-left">Seuls les jpg, jpeg, gif et png sont autorisés.</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div style="height: 23vh;" class="parent-img">
                                <img class="h-100 img-thumbnail w-100" id="img-logo" src="<?php echo BASE_URL; ?>assets/uploads/banners/<?php echo $logo; ?>" alt="logo">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="favicon">favicon<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="favicon" id="favicon">
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
                        <label for="meta_title">Meta title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required value="<?php echo $meta_title; ?>" id="meta_title" name="meta_title" placeholder="Meta Title">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="key">Meta Keyword <span class="text-muted">(Optional)</span></label>
                        <textarea rows="4" class="form-control" id="key" name="meta_key" style="min-height: 50px;" placeholder="Example: handcomm,blog,website,..."><?php echo $meta_keyword; ?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Meta Description <span class="text-muted">(Optional)</span></label>
                        <textarea rows="8" class="form-control" id="description" placeholder="Meta Description..." name="meta_description" style="min-height: 150px;"><?php echo $meta_description; ?></textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 offset-md-6 d-flex justify-content-around">
                            <button type="submit" name="formP"  class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Mettre à jour les parametre</span>
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
