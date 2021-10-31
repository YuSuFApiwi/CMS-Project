<?php require_once('header.php') ?>

<h1 class="h3 mb-2 text-gray-800">Ajouter une nouvelle page</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Informations sur les pages</h6>
        <div>
            <a href="page.php" class="btn btn-info">
                <span class="text">Afficher Les Pages</span>
            </a>
        </div>
    </div>

    <div class="card-body">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name-page">Page de nom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control text-capitalize" required id="name-page" name="page_name" placeholder="Entrez le nom de la page">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="layout-page">Choisissez un type de mise en page <span class="text-danger">*</span></label>
                        <select class="form-control" name="page_layout" id="layout-page" required>
                            <option value="full width">Mise en page pleine largeur</option>
                            <option value="gallery">Gallery</option>
                            <option value="blog">Blog</option>
                            <option value="faq">Mise en page de la FAQ</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="slug-page">Slug <span class="text-danger">*</span></label>
                        <input type="text" class="form-control text-lowercase" required id="slug-page" name="slug" placeholder="Example: about-us">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="content">Contenu de la page <span class="text-danger">*</span></label>
                        <textarea rows="15" class="form-control" name="content" style="min-height: 150px;" id="content"></textarea>
					</div>	
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="photo">Bannière <span class="text-muted">(optionnel)</span></label>
                                <input type="file" class="form-control" name="photo" id="photo"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="active">Active? <span class="text-danger">*</span></label>
                                <div class="form-control">
                                    <input type="radio" name="active" id="active" value="active" class="custom-radio" checked>
                                    <label for="active" class="custom-control-inline">Oui</label>
                                    <input type="radio" name="active" id="inactive" value="inactive" class="custom-radio">
                                    <label for="inactive" class="custom-control-inline">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">Meta title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required id="title" name="meta_title" placeholder="Meta Title">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="key">Meta Keyword <span class="text-muted">(Optional)</span></label>
                        <textarea rows="4" class="form-control" id="key" name="meta_keyword" style="min-height: 50px;" placeholder="Example: handcomm,blog,website,..."></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Meta Description <span class="text-muted">(Optional)</span></label>
                        <textarea rows="8" class="form-control" id="description" placeholder="Meta Description..." name="meta_description" style="min-height: 150px;"></textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 offset-md-6 d-flex justify-content-around">
                            <button type="submit"  class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Ajouter une nouvelle page</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



<?php require_once('footer.php') ?>