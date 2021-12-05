<?php
    $title = "Mise à jour Mes Rèsaux sociaux";
    $before_css = '<link rel="stylesheet" href="css/font-awesome.min.css">';
    require_once('header.php')
?>
<?php 
 if(isset($_POST['formS'])){
    
	$statement = $pdo->prepare("UPDATE social SET social_url=? WHERE social_name=?");
	$statement->execute(array($_POST['facebook'],'Facebook'));

	$statement = $pdo->prepare("UPDATE social SET social_url=? WHERE social_name=?");
	$statement->execute(array($_POST['twitter'],'Twitter'));

	$statement = $pdo->prepare("UPDATE social SET social_url=? WHERE social_name=?");
	$statement->execute(array($_POST['linkedin'],'LinkedIn'));

	$statement = $pdo->prepare("UPDATE social SET social_url=? WHERE social_name=?");
	$statement->execute(array($_POST['pinterest'],'Pinterest'));

	$statement = $pdo->prepare("UPDATE social SET social_url=? WHERE social_name=?");
	$statement->execute(array($_POST['youtube'],'YouTube'));

	$statement = $pdo->prepare("UPDATE social SET social_url=? WHERE social_name=?");
	$statement->execute(array($_POST['instagram'],'Instagram'));

	$statement = $pdo->prepare("UPDATE social SET social_url=? WHERE social_name=?");
	$statement->execute(array($_POST['snapchat'],'Snapchat'));

	$statement = $pdo->prepare("UPDATE social SET social_url=? WHERE social_name=?");
	$statement->execute(array($_POST['whatsapp'],'WhatsApp'));

	$success_message = 'Les URL des réseaux sociaux sont mises à jour avec succès.';


 }

?>

<h1 class="h3 mb-2 text-gray-800">Mes Rèsaux sociaux</h1>

<?php

    if (isset($success_message) && $success_message != '') {
        $name_alert = 'Fait avec succès';
        $msg_alert = $success_message;
        require_once('alert/success.php');
    }
        
?>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Entrer les liens de réseaux sociaux</h6>
    </div>

    <div class="card-body">
        <form action="" method="post">
            <div class="row">
            <?php 
                $statement = $pdo->prepare("SELECT * FROM social");
                $statement->execute();
                $total = $statement->rowCount();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $row): ?>
                    <div class="col-md-6">
                        <label for="<?php echo $row['social_name']?>"><?php echo $row['social_name']?></label>
                        <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <i class='<?php echo $row['social_icon']?>'></i>
                            </span>
                        </div>
                        <input type="url" class="form-control" value='<?php echo $row['social_url'] == '#'? '': $row['social_url'] ?>' name="<?php echo strtolower($row['social_name'])?>" id="<?php echo $row['social_name']?>" placeholder="<?php echo $row['social_name']?>">
                        </div>
                    </div>                
            <?php endforeach    ?>
                <div class="col-md-12 mt-4">
                    <div class="row">
                        <div class="col-md-6 offset-md-6 d-flex flex-row justify-content-end">
                            <button type="submit" name="formS"  class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span class="text">Mise à jour sociale</span>
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