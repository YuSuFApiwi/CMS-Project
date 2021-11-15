<?php require_once('inc/header.php'); ?>

<?php
if (!isset($_REQUEST['slug'])) {
    header('location: ' . BASE_URL);
    exit;
} else {
    $statement = $pdo->prepare("SELECT * FROM categories WHERE category_slug=?");
    $statement->execute(array($_REQUEST['slug']));
    $total = $statement->rowCount();
    if ($total == 0) {
        header('location: ' . BASE_URL);
        exit;
    }
}

$statement = $pdo->prepare("SELECT * FROM categories WHERE category_slug=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $category_name = $row['category_name'];
    $category_slug = $row['category_slug'];
    $category_id = $row['id'];
}
?>
<!--Breadcrumb Area-->
<section class="breadcrumb-area banner-3">
    <div class="text-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 v-center">
                    <div class="bread-inner">
                        <div class="bread-menu">
                            <ul>
                                <li><a href="<?php echo BASE_URL ?>">Accueil</a></li>
                                <li><a href="<?php echo BASE_URL ?>category/<?php echo $category_slug ?>"><?php echo $category_name ?></a></li>
                            </ul>
                        </div>
                        <div class="bread-title text-capitalize">
                            <h2><?php echo $category_name ?></h2>
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
                <?php
                $statement = $pdo->prepare("SELECT * FROM news WHERE category_id=?");
                $statement->execute(array($category_id));
                $total = $statement->rowCount();
                ?>

                <?php if (!$total) : ?>
                    <section>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 text-center mt50 mb50">
                                    <div class="layer-div">
                                        <div class="error-block">
                                            <h3>Désolée ! Aucune actualité n'est trouvée.</h3>
                                            <p>Il n'y a pas d'articles liés à cette catégorie.</p>
                                            <a href="<?php echo BASE_URL ?>" class="btn-outline">Aller à la page d'accueil</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php else : ?>
                    
                    <?php
                    $statement = $pdo->prepare("SELECT * FROM news WHERE category_id=?");
                    $statement->execute(array($category_id));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                    ?>
                        <div class="isotope_item vrbloglist">
                            <div class="item-image">
                                <a href="#"><img src="<?php echo BASE_URL ?>assets/uploads/news/<?php echo $row['photo']; ?>" alt="blog" class="img-fluid"> </a>
                                <span class="category-blog"><a href="<?php echo BASE_URL ?>category/<?php echo $category_slug; ?>"><?php echo $category_name ?></a></span>
                            </div>
                            <div class="item-info blog-info">
                                <div class="entry-blog">
                                    <span class="bypost"><a href="javascript:void(0);"><i class="fas fa-user"></i> <?php echo $row['publisher'] ?></a></span>
                                    <span class="posted-on">
                                        <a href="javascript:void(0);"><i class="fas fa-clock"></i> <?php echo $row['news_date'] ?></a>
                                    </span>
                                    <span><a href="javascript:void(0);"><i class="fas fa-comment-dots"></i> (<?php echo $row['total_view'] ?>)</a></span>
                                </div>
                                <h4><a href="<?php echo BASE_URL ?>article/<?php echo $row['news_slug']; ?>"><?php echo $row['news_title']; ?></a></h4>
                                <p>
                                    <?php echo substr($row['news_content'], 0, 200) . ' ...'; ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                <?php endif; ?>
            </div>
            <!--End Blog Details-->
            <?php require_once('inc/sidebar.php') ?>
        </div>
    </div>
</section>


<?php
require_once('inc/footer.php')
?>