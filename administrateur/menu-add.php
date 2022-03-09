<?php
    $title = 'Ajouter un nouveau menu';
    require_once('header.php')
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


<?php
if(isset($_POST['form3'])) {
	$valid = 1;

	if(empty($_POST['menu_name'])) {
        $valid = 0;
        $error_message = "Le nom du menu ne peut pas être vide";
    }
    if(empty($_POST['menu_order'])) {
        $valid = 0;
        $error_message = "L'ordre des menus ne peut pas être vide";
    }
    if(empty($_POST['menu_url'])) {
        $valid = 0;
        $error_message = "L'URL du menu ne peut pas être vide";
    }
    if( $_POST['menu_avant'] == '') {
        $valid = 0;
        $error_message = "Vous devez avoir à sélectionner un parent pour ce menu";
    }

	if($valid == 1) {
		$statement = $pdo->prepare("INSERT INTO menu (menu_type,menu_name,category_or_page_slug,menu_order,menu_parent,menu_url) VALUES (?,?,?,?,?,?)");
		$statement->execute(array('Autre',$_POST['menu_name'],'',$_POST['menu_order'],$_POST['menu_avant'],$_POST['menu_url']));

    	$success_message = 'Le menu a été ajouté avec succès.';
    }

}
?>

<h1 class="h3 mb-2 text-gray-800">Ajouter un nouveau menu</h1>
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
    <a class="nav-link active" id="nav-page-tab" data-toggle="tab" href="#nav-page" role="tab" aria-controls="nav-profile" aria-selected="false">Page comme menu</a>
    <a class="nav-link" id="nav-autre-tab" data-toggle="tab" href="#nav-autre" role="tab" aria-controls="nav-contact" aria-selected="false">Autre menu</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active mt-4" id="nav-page" role="tabpanel" aria-labelledby="nav-page-tab">
    <form action="" method="post">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="menu-page">Choisissez une page <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="menu_page_and_slug" id="menu-page" required>
                        <option value="" hidden>Choisissez une page</option>
                        <?php
                            $statement = $pdo->prepare("SELECT * FROM page ORDER BY page_name ASC");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);		
                            foreach ($result as $row) {
                                echo '<option value="'.$row['page_name'].'@1@'.$row['page_slug'].'">'.$row['page_name'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="avant-menu-page">Avant le menu <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="menu_avant" id="avant-menu-page" required>
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
                    <label for="order-2">Ordre <span class="text-danger">*</span></label>
                    <input type="number" step="0" class="form-control text-lowercase" required id="order-2" name="menu_order" placeholder="Ordre">
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 offset-md-6 d-flex flex-row justify-content-end">
                        <button type="submit" name="form2"  class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Ajouter une rubrique</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
  </div>
  <div class="tab-pane fade mt-4" id="nav-autre" role="tabpanel" aria-labelledby="nav-autre-tab">
  <form action="" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu-name">Nom du menu <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Nom du menu" name="menu_name" id="menu-name" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu-url">URL du menu <span class="text-danger">*</span></label>
                    <input type="url" class="form-control" placeholder="URL du menu" name="menu_url" id="menu-url" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="avant-menu-autre">Avant le menu <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="menu_avant" id="avant-menu-autre" required>
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
            <div class="col-md-6">
                <div class="form-group">
                    <label for="order-3">Ordre <span class="text-danger">*</span></label>
                    <input type="number" step="0" class="form-control text-lowercase" required id="order-3" name="menu_order" placeholder="Ordre">
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 offset-md-6 d-flex flex-row justify-content-end">
                        <button type="submit" name="form3"  class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Ajouter une rubrique</span>
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