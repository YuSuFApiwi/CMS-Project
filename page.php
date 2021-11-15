<?php
require_once('inc/header.php');

if (!isset($_REQUEST['slug'])) {
    header('location: ' . BASE_URL);
    exit;
} else {
    $statement = $pdo->prepare("SELECT * FROM page WHERE page_slug=? AND status=?");
    $statement->execute(array($_REQUEST['slug'], 'Active'));
    $total = $statement->rowCount();
    if ($total == 0) {
        header('location: ' . BASE_URL);
        exit;
    }
}

$statement = $pdo->prepare("SELECT * FROM page WHERE page_slug=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $page_name    = $row['page_name'];
    $page_slug    = $row['page_slug'];
    $page_content = $row['page_content'];
    $page_layout  = $row['page_layout'];
    $banner       = $row['banner'];
    $status       = $row['status'];
}

// If a page is not active, redirect the user while direct URL press
if ($status == 'Inactive') {
    header('location: index.php');
    exit;
}
?>
<!--Breadcrumb Area-->
<section class="breadcrumb-area" style="background-size: cover;background-image: url(<?php echo BASE_URL ?>assets/uploads/banners/<?php echo $banner ?>);">
    <div class="text-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 v-center">
                    <div class="bread-inner">
                        <div class="bread-menu">
                            <ul>
                                <li><a href="<?php echo BASE_URL ?>">Accueil</a></li>
                                <li><a href="#">Page</a></li>
                            </ul>
                        </div>
                        <div class="bread-title text-capitalize">
                            <h2><?php echo $page_name ?></h2>
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
            <div class="col-lg-8">

                <?php if ($page_layout == 'full width') : ?>
                    <div class="isotope_item vrbloglist">
                        <div class="item-info blog-info">
                            <p>
                                <?php echo $page_content ?>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>



            </div>
            <!--End Blog Details-->
            <?php require_once('inc/sidebar.php') ?>
        </div>
    </div>
</section>

<?php require_once('inc/footer.php') ?>