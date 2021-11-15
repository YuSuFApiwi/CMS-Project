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
<!--Start Blog Details-->
<section class="blog-page mt-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div class="isotope_item vrbloglist">
                    <div class="item-image">
                        <a href="<?php echo BASE_URL ?>service/<?php echo $slug; ?>">
                            <img src="<?php echo BASE_URL ?>assets/uploads/services/<?php echo $photo; ?>" alt="service" class="img-fluid">
                        </a>
                    </div>
                    <div class="item-info blog-info">
                        <p>
                            <?php echo $description ?>
                        </p>
                    </div>
                </div>
            </div>
            <!--End Blog Details-->
            <!--Start Sidebar-->
            <div class="col-lg-4 col-md-4 m-mt30">
                <div class="sidebar">
                    <!--Start services-->
                    <div class="recent-post widgets mt60">
                        <h3 class="mb30">Prestations de service</h3>
                        <div class="blog-categories">
                            <ul>
                                <?php
                                $statement = $pdo->prepare("SELECT * FROM service ORDER BY name ASC");
                                $statement->execute();
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                ?>
                                    <li><a href="<?php echo BASE_URL; ?>service/<?php echo $row['slug']; ?>"><?php echo $row['name']; ?></a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once('inc/footer.php')?>