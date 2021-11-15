<!--Start Sidebar-->
<div class="col-lg-4 m-mt30">
    <div class="sidebar">
        <!--Start Recent post-->
        <div class="recent-post widgets mt60">
            <h3 class="mb30">Derniers articles</h3>
            <?php
                $i=0;
                $statement = $pdo->prepare("SELECT * FROM news ORDER BY id DESC limit 5");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);							
                foreach ($result as $row) {
                    $i++;
                    ?>
                    <div class="media">
                        <div class="post-image bdr-radius">
                            <a href="<?php echo BASE_URL; ?>news/<?php echo $row['news_slug']; ?>">
                                <img src="<?php echo BASE_URL; ?>assets/uploads/news/<?php echo $row['photo'] ?>" alt="<?php echo substr($row['news_title'],0,10) ?>" class="img-fluid" />
                            </a>
                        </div>
                        <div class="media-body post-info">
                            <h5><a href="<?php echo BASE_URL; ?>article/<?php echo $row['news_slug']; ?>"><?php echo $row['news_title']; ?></a></h5>
                            <p><?php echo $row['news_date'] ?></p>
                        </div>
                    </div>
                    <?php
                }
			?>
        </div>
        <!--Start Recent post-->
        <!--Start Blog Category-->
        <div class="recent-post widgets mt60">
            <h3 class="mb30">Catégorie de blog</h3>
            <div class="blog-categories">
                <ul>
                <?php
                    $statement = $pdo->prepare("SELECT * FROM categories ORDER BY category_name ASC");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);							
                    foreach ($result as $row) {
                        $statement = $pdo->prepare("SELECT * FROM news where category_id =?");
                        $statement->execute(array($row['id']));
                        $total_news_by_category = $statement->rowCount();
                    ?>
                        <li>
                            <a href="<?php echo BASE_URL; ?>category/<?php echo $row['category_slug']; ?>"><?php echo $row['category_name']; ?> <span class="categories-number">(<?php echo $total_news_by_category; ?>)</span></a>
                        </li>
                <?php } ?>
                </ul>
            </div>
        </div>
        <!--End Blog Category-->
    </div>
</div>
<!--End Sidebar-->