<?php require_once('inc/header.php'); ?>

<?php
if (!isset($_REQUEST['slug'])) {
    header('location: ' . BASE_URL);
    exit;
} else {
    // Check the page slug is valid or not.
    $statement = $pdo->prepare("SELECT * FROM service WHERE slug=?");
    $statement->execute(array($_REQUEST['slug']));
    $total = $statement->rowCount();
    if ($total == 0) {
        header('location: ' . BASE_URL);
        exit;
    }
}
$statement = $pdo->prepare("SELECT * FROM service WHERE slug=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $name              = $row['name'];
    $slug              = $row['slug'];
    $description       = $row['description'];
    $section_left      = $row['section_left'];
    $section_right     = $row['section_right'];
    $photo             = $row['photo'];
    $banner            = $row['banner'];
}
?>
<!--Breadcrumb Area-->
<section class="breadcrumb-area" style="background-size: cover;background-image: url(<?php echo BASE_URL ?>assets/uploads/services/<?php echo $banner ?>);">
    <div class="text-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 v-center">
                    <div class="bread-inner">
                        <div class="bread-menu">
                            <ul>
                                <li><a href="<?php echo BASE_URL ?>">Accueil</a></li>
                                <li><a href="<?php echo BASE_URL ?>service/<?php echo $slug ?>"><?php echo $name ?></a></li>
                            </ul>
                        </div>
                        <div class="bread-title text-capitalize">
                            <h2><?php echo $name ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Breadcrumb Area-->
<!--Start About-->
<section class="service pad-tb bg-gradient5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="image-block wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
                    <img src="<?php echo BASE_URL ?>assets/uploads/services/<?php echo $photo; ?>" alt="image <?php echo substr($name, 0, 10) ?>" class="img-fluid no-shadow">
                </div>
            </div>
            <div class="col-lg-8 block-1">
                <div class="common-heading text-l pl25">
                    <span>Overview</span>
                    <h2><?php echo $name ?></h2>
                    <p>
                        <?php echo $description; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End About-->
<!--Start Key points-->
<section class="service pad-tb light-dark">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="text-l service-desc-pr25">
                    <p><?php echo $section_left; ?></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="servie-key-points">
                    <p><?php echo $section_right; ?></p>    
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once('inc/footer.php') ?>