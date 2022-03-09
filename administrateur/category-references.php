<?php
$title = 'Voir toutes Les catégories de référence';
$before_css = '<link href="css/vender/dataTables.bootstrap4.min.css" rel="stylesheet">';
require_once('header.php')
?>


<h1 class="h3 mb-2 text-gray-800">Les catégories de référence</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Afficher toutes les catégories de référence</h6>
        <div>
            <a href="category-references-add.php" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Ajouter une nouvelle catégorie pour référence</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom de catégorie</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $statement = $pdo->prepare("SELECT * FROM category_references ORDER BY id DESC");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['category_name']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <a href="category-references-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-circle btn-sm" data-href="category-references-delete.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm-delete">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <!-- Footer Table -->
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Nom de catégorie</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Voulez-vous supprimer cette catégorie de référence ?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    <a class="btn btn-danger btn-confirm">Effacer</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

$after_js = '<script src="js/vendor/jquery.dataTables.min.js"></script>';
$after_js .= '<script src="js/vendor/dataTables.bootstrap4.min.js"></script>';
$after_js .= '<script src="js/demo/datatables-demo.js"></script>';
require_once('footer.php')
?>