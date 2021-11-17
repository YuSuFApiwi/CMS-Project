<?php
    $title = 'Voir toutes les services';
    $before_css ='<link href="css/vender/dataTables.bootstrap4.min.css" rel="stylesheet">';
    require_once('header.php')
?>


<h1 class="h3 mb-2 text-gray-800">Les services</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Afficher toutes les services</h6>
        <div>
            <a href="service-add.php" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Ajouter un nouvel service</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Image</th>
                        <th>Nom du service</th>
                        <th>Slug</th>
                        <th>Brève description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i=0;
                        $statement = $pdo->prepare("SELECT id,name,slug,short_description,photo FROM service");
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);							
                        foreach ($result as $row) {
                        $i++;
                    ?>
					<tr>
	                    <td class="text-center"><?php echo $i; ?></td>
	                    <td>
                            <?php
                                if($row['photo'] == '')
                                {
                                    echo '<img class="align-middle img-thumbnail" src="../assets/uploads/services/defualt-service.jpg" height="60px" width="100px" alt="défaut Photo news" style="width:100px;">';
                                }
                                else
                                {
                                    echo '<img class="align-middle img-thumbnail" src="../assets/uploads/services/'.$row['photo'].'" height="60px" width="100px" alt="'.substr($row['name'],0,10).'" style="width:100px;">';
                                }
							?>
                        </td>
	                    <td>
                            <?php echo $row['name'] ?>
                        </td>
	                    <td>
                            <?php echo $row['slug']?>
                        </td>
	                    <td><?php echo substr($row['short_description'],0,50). '.'; ?></td>
	                    <td>
	                        <a href="service-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-circle btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
	                        <a href="#" class="btn btn-danger btn-circle btn-sm" data-href="service-delete.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm-delete">
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
                        <th>Image</th>
                        <th>Nom du service</th>
                        <th>Slug</th>
                        <th>Brève description</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Voulez-vous supprimer cette service?
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