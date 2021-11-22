<?php require_once('inc/header.php'); ?>

<?php
if (!isset($_REQUEST['slug'])) {
    header('location: ' . BASE_URL);
    exit;
}
$statement = $pdo->prepare("SELECT
							t1.news_title,
							t1.news_slug,
							t1.news_content,
							t1.news_date,
							t1.publisher,
							t1.photo,
							t1.category_id,
							
							t2.id,
							t2.category_name,
							t2.category_slug

                           	FROM news t1
                           	JOIN categories t2
                           	ON t1.category_id = t2.id
                           	WHERE t1.news_slug=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $news_title    = $row['news_title'];
    $news_content  = $row['news_content'];
    $news_date     = $row['news_date'];
    $publisher     = $row['publisher'];
    $photo         = $row['photo'];
    $category_id   = $row['category_id'];
    $category_slug = $row['category_slug'];
    $category_name = $row['category_name'];
}

$statement = $pdo->prepare("SELECT * FROM news WHERE news_slug=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $current_total_view = $row['total_view'];
}
$updated_total_view = $current_total_view + 1;
$statement = $pdo->prepare("UPDATE news SET total_view=? WHERE news_slug=?");
$statement->execute(array($updated_total_view, $_REQUEST['slug']));
?>
<!--Breadcrumb Area-->
<section class="breadcrumb-area">
    <div class="text-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 v-center">
                    <div class="bread-inner">
                        <div class="bread-menu">
                            <ul>
                                <li><a href="<?php echo BASE_URL ?>">Accueil</a></li>
                                <li><a href="<?php echo BASE_URL ?>page/blog">Blog</a></li>
                            </ul>
                        </div>
                        <div class="bread-title text-capitalize">
                            <h1><?php echo $news_title ?></h1>
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
            <div class="isotope_item vrbloglist col-md-8 col-lg-8">
                <div class="item-image">
                    <a href="#"><img src="<?php echo BASE_URL ?>assets/uploads/news/<?php echo $photo; ?>" alt="Article <?php echo substr($news_title, 0, 15) ?>" class="img-fluid"> </a>
                </div>
                <div class="item-info blog-info">
                    <div class="entry-blog">
                        <span>
                            <a href="<?php echo BASE_URL ?>category/<?php echo $category_slug; ?>">
                                <i class="fas fa-tag"></i>
                                <?php echo $category_name ?>
                            </a>
                        </span>
                        <span class="bypost">
                            <a href="javascript:void(0);">
                                <i class="fas fa-user"></i>
                                <?php echo $publisher ?>
                            </a>
                        </span>
                        <span class="posted-on">
                            <a href="javascript:void(0);">
                                <i class="fas fa-clock"></i>
                                <?php echo $news_date ?>
                            </a>
                        </span>
                        <span>
                            <a href="javascript:void(0);">
                                <i class="fas fa-street-view"></i>
                                (<?php echo $current_total_view ?>)
                            </a>
                        </span>
                    </div>
                    <h4><?php echo $news_title; ?></h4>
                    <p>
                        <?php echo $news_content ?>
                    </p>
                </div>
            </div>
            <!--End Blog Details-->
            <?php require_once('inc/sidebar.php') ?>
        </div>
    </div>
</section>
<?php require_once('inc/footer.php') ?>