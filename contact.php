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
                                <li><a href="<?php BASE_URL ?>">Accueil</a></li>
                                <li><a href="#">Contact</a></li>
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
                                <a href="tel:+10000000000">01.76.43.04.02</a>
                            </div>
                        </div>
                    </div>
                    <div class="email-card mt30 wow fadeIn" data-wow-delay=".5s">
                        <div class="info-card v-center">
                            <span><i class="fas fa-envelope"></i> Email:</span>
                            <div class="info-body">
                                <p>Notre équipe d'assistance vous répondra dans les 24 heures pendant les heures ouvrables standard.</p>
                                <a href="#">contact@handcomm.fr</a>
                            </div>
                        </div>
                    </div>
                    <div class="skype-card mt30 wow fadeIn" data-wow-delay=".9s">
                        <div class="info-card v-center">
                            <span><i class="fab fa-facebook"></i> Facebook:</span>
                            <div class="info-body">
                                <p><a href="https://web.facebook.com/handcomm/">https://web.facebook.com/handcomm/</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Enquire Form-->
<?php require_once('inc/footer.php') ?>