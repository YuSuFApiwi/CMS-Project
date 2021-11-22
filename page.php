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

                <?php if (strtolower($page_layout) == 'full width') : ?>
                    <div class="isotope_item vrbloglist">
                        <div class="item-info blog-info">
                            <p>
                                <?php echo $page_content ?>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (strtolower($page_layout) == 'blog') : ?>
                    <?php
                    $statement = $pdo->prepare("SELECT * FROM news");
                    $statement->execute();
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
                                                <a href="<?php echo BASE_URL ?>" class="btn-main bg-btn lnk wow fadeInUp" data-wow-delay=".6s">Aller à la page d'accueil <i class="fas fa-chevron-right fa-icon"></i><span class="circle"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php else : ?>

                        <?php 
                        $statement = $pdo->prepare("SELECT
								   t1.id,
                                   t1.news_title,
		                           t1.news_slug,
		                           t1.news_content,
                                   t1.publisher,
		                           t1.news_date,
                                   t1.total_view,
		                           t1.photo,
		                           t1.category_id,

		                           t2.id,
		                           t2.category_name,
		                           t2.category_slug
		                           FROM news t1
		                           JOIN categories t2
		                           ON t1.category_id = t2.id 		                           
		                           ORDER BY t1.id DESC");
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                        ?>
                            <div class="isotope_item vrbloglist">
                                <div class="item-image">
                                    <a href="#"><img src="<?php echo BASE_URL ?>assets/uploads/news/<?php echo $row['photo']; ?>" alt="blog" class="img-fluid"> </a>
                                    <span class="category-blog"><a href="<?php echo BASE_URL ?>category/<?php echo $row['category_slug']; ?>"><?php echo $row['category_name'] ?></a></span>
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
                                        <?php echo strlen($row['news_content']) > 300 ? substr($row['news_content'], 0, 300) . '...':$row['news_content']; ?>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
            <!--End Blog Details-->
            <?php require_once('inc/sidebar.php') ?>
        </div>
    </div>
</section>
<?php require_once('inc/footer.php') ?>