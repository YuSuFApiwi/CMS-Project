<?php
    $title = 'Ajouter une nouvelle menu';
    require_once('header.php')
?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;
	if(empty($_POST['menu_category_and_slug'])) {
        $valid = 0;
        $error_message = "Vous devez avoir à sélectionner une catégorie comme nom de menu";
    }
    if(empty($_POST['menu_order'])) {
        $valid = 0;
        $error_message = "L'ordre des menus ne peut pas être vide";
    }
    if($_POST['menu_avant'] == '') {
        $valid = 0;
        $error_message = "Vous devez avoir à sélectionner un parent pour ce menu";
    }

	if($valid == 1) {
    	$menu_cns = explode('@1@',$_POST['menu_category_and_slug']);

		$statement = $pdo->prepare("INSERT INTO menu (menu_type,menu_name,category_or_page_slug,menu_order,menu_parent,menu_url) VALUES (?,?,?,?,?,?)");
		$statement->execute(array('Catégorie',$menu_cns[0],$menu_cns[1],$_POST['menu_order'],$_POST['menu_avant'],''));

    	$success_message = 'Le menu a été ajouté avec succès.';
    }

}
?>


<?php
if(isset($_POST['form2'])) {
	$valid = 1;

	if(empty($_POST['menu_page_and_slug'])) {
        $valid = 0;
        $error_message = "Vous devez avoir à sélectionner une page comme nom de menu";
    }
    if(empty($_POST['menu_order'])) {
        $valid = 0;
        $error_message = "L'ordre des menus ne peut pas être vide";
    }
    if($_POST['menu_avant'] == '') {
        $valid = 0;
        $error_message = "Vous devez avoir à sélectionner un parent pour ce menu";
    }

	if($valid == 1) {
    	$menu_nps = explode('@1@',$_POST['menu_page_and_slug']);
		$statement = $pdo->prepare("INSERT INTO menu (menu_type,menu_name,category_or_page_slug,menu_order,menu_parent,menu_url) VALUES (?,?,?,?,?,?)");
		$statement->execute(array('Page',$menu_nps[0],$menu_nps[1],$_POST['menu_order'],$_POST['menu_avant'],''));

    	$success_message = 'Le menu a été ajouté avec succès.';
    }

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
    <form action="" method="post">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="menu-category">Choisir une catégorie <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="menu_category_and_slug" id="menu-category" required>
                        <option value="" hidden>Choisir une catégorie</option>
                        <?php
                            $statement = $pdo->prepare("SELECT * FROM categories ORDER BY category_name ASC");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);		
                            foreach ($result as $row) {
                                echo '<option value="'.$row['category_name'].'@1@'.$row['category_slug'].'">'.$row['category_name'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="avant-menu-category">Avant le menu <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="menu_avant" id="avant-menu-category" required>
                        <option value="" hidden>Sélectionnez un parent pour ce menu</option>
                        <option value="0">Aucun parent</option>
                        <?php
                            $statement = $pdo->prepare("SELECT * FROM menu ORDER BY menu_order ASC");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);		
                            foreach ($result as $row) {
                                echo '<option value="'.$row['id'].'">'.$row['menu_name'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="order-1">Ordre <span class="text-danger">*</span></label>
                    <input type="number" step="0" class="form-control text-lowercase" required id="order-1" name="menu_order" placeholder="Ordre">
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 offset-md-6 d-flex flex-row justify-content-end">
                        <button type="submit" name="form1"  class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Ajouter la liste</span>
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
                    <input type="password" class="form-control" name="new_password" id="new-password" autocomplete="new-password">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="conferm-passwrod">Retaper le mot de passe <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="conferm_password" id="conferm-password" autocomplete="new-password">
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 offset-md-6 d-flex flex-row justify-content-end">
                        <button type="submit" name="form2"  class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
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