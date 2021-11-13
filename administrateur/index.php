<?php require_once('header.php'); ?>

<?php
$statement = $pdo->prepare("SELECT * FROM categories");
$statement->execute();
$total_category = $statement->rowCount();

$statement = $pdo->prepare("SELECT * FROM news");
$statement->execute();
$total_news = $statement->rowCount();
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tableau de bord</h1>
</div>
<div>
    <?php 
        
    ?>
</div>
<!-- Content Row -->
<div class="row">
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            TOTAL DES CATÉGORIES 
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_category ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            NOUVELLES TOTALES    
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_news ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-paste fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Row -->

<div class="row mb-5">
    <div class="col-md-12 mb-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Derniers articles</h6>
            </div>
            <div class="card-body">
                <?php
                    $i=0;
                    $statement = $pdo->prepare("SELECT * FROM news ORDER BY id DESC limit 3");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);							
                    foreach ($result as $row) {
                        $i++;
                        ?>
                            <a target="_blank" class="d-block" href="<?php echo BASE_URL; ?>news/<?php echo $row['news_slug']; ?>"><?php echo $row['news_title']; ?> &rarr;</a>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
    require_once('footer.php')
?>
