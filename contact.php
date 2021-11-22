<?php require_once('inc/header.php') ?>

<!--Breadcrumb Area-->
<section class="breadcrumb-area banner-6">
    <div class="text-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 v-center">
                    <div class="bread-inner">
                        <div class="bread-menu wow fadeInUp" data-wow-delay=".2s">
                            <ul>
                                <li><a href="<?php echo BASE_URL ?>">Accueil</a></li>
                                <li><a href="<?php echo BASE_URL ?>contact">Contact</a></li>
                            </ul>
                        </div>
                        <div class="bread-title wow fadeInUp" data-wow-delay=".5s">
                            <h2>Contact</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Breadcrumb Area-->
<?php
$statement = $pdo->prepare("SELECT * FROM settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $contact_address  = $row['contact_address'];
    $contact_email    = $row['contact_email'];
    $contact_phone    = $row['contact_phone'];
    $contact_fax      = $row['contact_fax'];
}
?>
<!--Start Enquire Form-->
<section class="contact-page pad-tb">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 v-center">
                <div class="common-heading text-l">
                    <span>Formulaire de contact</span>
                    <h2 class="mt0 mb0">Vous avez une question ?</h2>
                    <p class="mb60 mt20">Nous vous attraperons dès que nous recevrons le message</p>
                </div>
                <div class="form-block">
                    <form id="contactForm" data-toggle="validator" class="shake">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <input type="text" id="name" placeholder="Votre Nom" required data-error="Please fill Out">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-sm-6">
                                <input type="email" id="email" placeholder="Votre Email" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <input type="text" id="mobile" placeholder="Votre téléphone" required data-error="Please fill Out">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-sm-6">
                                <select name="Dtype" id="Dtype" required>
                                    <option value="">Votre demande</option>
                                    <option value="web">Site Web</option>
                                    <option value="graphic">Rédaction & Traduction</option>
                                    <option value="video">Conception graphique</option>
                                    <option value="video">Autres</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea id="message" rows="5" placeholder="Taper votre message ici" required></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <button type="submit" id="form-submit" class="btn lnk btn-main bg-btn"><span class="circle"></span>Envoyer votre message</button>
                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 v-center">
                <div class="contact-details">
                    <div class="contact-card wow fadeIn" data-wow-delay=".2s">
                        <div class="info-card v-center">
                            <span><i class="fas fa-phone-alt"></i> Téléphone:</span>
                            <div class="info-body">
                                <p>Nos horaires: Lundi – Samedi</p>
                                <a href="tel:<?php echo $contact_phone;?>"><?php echo $contact_phone; ?></a>
                                <span>&nbsp;/&nbsp;</span>
                                <a href="tel:<?php echo $contact_fax; ?>"><?php echo $contact_fax;?></a>
                            </div>
                        </div>
                    </div>
                    <div class="email-card mt30 wow fadeIn" data-wow-delay=".4s">
                        <div class="info-card v-center">
                            <span><i class="fas fa-envelope"></i> Email:</span>
                            <div class="info-body">
                                <p>Notre équipe d'assistance vous répondra dans les 24 heures pendant les heures ouvrables standard.</p>
                                <a href="mailto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="contact-card mt30 wow fadeIn" data-wow-delay=".6s">
                        <div class="info-card v-center">
                            <span><i class="fas fa-map-marker-alt"></i> Adresse:</span>
                            <div class="info-body">
                                <p><?php echo $contact_address; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="skype-card mt30 wow fadeIn" data-wow-delay=".8s">
                        <div class="info-card v-center text-center">
                            <?php
                                $statement = $pdo->prepare("SELECT * FROM social");
                                $statement->execute();
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);					
                                foreach ($result as $row) 
                                {
                                    if($row['social_url']!='' && $row['social_url'] != '#')
                                    {
                                        echo '<a target="_blank" href="'.$row['social_url'].'"><i class="'.$row['social_icon'].' fa-2x mr-3"></i></a>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Enquire Form-->
<?php require_once('inc/footer.php') ?>