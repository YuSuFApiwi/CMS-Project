<?php require_once('header.php') ?>


<h1 class="h3 mb-2 text-gray-800">Les Pages</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Afficher toutes les pages</h6>
        <div>
            <a href="page-add.php" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Ajouter une nouvelle page</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom de la page</th>
                        <th>Slug</th>
                        <th>Mise en page</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
            	$i=0;
            	$statement = $pdo->prepare("SELECT * FROM page ORDER BY id ASC");
            	$statement->execute();
            	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
            	foreach ($result as $row) {
            		$i++;
            		?>
					<tr>
	                    <td class="text-center"><?php echo $i; ?></td>
	                    <td><?php echo $row['page_name']; ?></td>
	                    <td><?php echo $row['page_slug']; ?></td>
	                    <td><?php echo $row['page_layout']; ?></td>
	                    <td><?php echo $row['status']; ?></td>
	                    <td>
	                        <a href="page-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-circle btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
	                        <a href="#" class="btn btn-danger btn-circle btn-sm" data-href="page-delete.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm-delete">
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
                        <th>Nom de la page</th>
                        <th>Slug</th>
                        <th>Mise en page</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Prêt à partir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                Sélectionnez « Déconnexion » ci-dessous si vous êtes prêt à mettre fin à votre session en cours.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    <a class="btn btn-info btn-confirm">Suprime</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php') ?>