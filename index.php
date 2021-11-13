<?php
require_once('inc/header.php')
?>
<!--Start Hero-->
<section class="hero-section hero-bg-bg1">
    <div class="text-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 v-center">
                    <div class="header-heading">
                        <h1 class="wow fadeInUp" data-wow-delay=".2s">Agenge Digitale HAND'COMM</h1>
                        <p class="wow fadeInUp" data-wow-delay=".4s">Une offre de compétences en télétravail ou sur site, des consultants expérimentés dans leur spécialité, des durées d’intervention modulables,
                            en fonction de vos besoins. Un seul site, un interlocuteur unique, pour augmenter vos résultats.</p>
                        <a href="contact.php" class="btn-main bg-btn lnk wow fadeInUp" data-wow-delay=".6s">Demandez un devis gratuit<i class="fas fa-chevron-right fa-icon"></i><span class="circle"></span></a>
                    </div>
                </div>
                <div class="col-lg-6 v-center">
                    <div class="single-image wow fadeIn" data-wow-delay=".5s">
                        <img src="<?php echo BASE_URL ?>assets/uploads/slider/slide.png" alt="web development" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Hero-->
<!--Start Service-->
<section class="service-section web-servic pad-tb">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="common-heading">
                    <span>Services que nous offrons</span>
                    <h2 class="mb30">Secrétariat Et Accueil Téléphonique</h2>
                </div>
            </div>
        </div>
        <div class="row upset link-hover shape-num justify-content-center">
            <?php
            $statement = $pdo->prepare("SELECT * FROM service ORDER BY id ASC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
            ?>
                <div class="col-lg-3 col-sm-6 mt30 shape-loc wow fadeInUp" data-wow-delay="0.2s">
                    <div class="s-block" data-tilt data-tilt-max="5" data-tilt-speed="1000">
                        <div class="s-card-icon"><img src="<?php BASE_URL ?>assets/uploads/services/<?php echo $row['photo'] ?>" alt="service" class="img-fluid" /></div>
                        <h4><?php echo $row['name']; ?></h4>
                        <p><?php echo $row['short_description']; ?></p>
                        <a href="<?php echo BASE_URL; ?>service/<?php echo $row['slug']; ?>">Pour en savoir plus <i class="fas fa-chevron-right fa-icon"></i></a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<!--End Service-->

<!--Start About-->
<section class="about-agency">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 v-center">
                <div class="image-block">
                    <img src="assets/uploads/images/about.jpg" alt="about" class="img-fluid no-shadow" />
                </div>
            </div>
            <div class="col-lg-6">
                <div class="common-heading text-l">
                    <span>SAVOIR FAIRE</span>
                    <h2>HAND’COMM</h2>
                    <p>Hand’Comm travaille avec un vaste réseau de consultants, tous spécialisés et expérimentés dans leur domaine
                        de compétences respectif. Secrétaires, graphistes, développeurs, référenceurs, community managers, rédacteurs, traducteurs… </p>
                    <p class="quote">Ils interviennent à votre demande de manière ponctuelle ou régulière, selon vos besoins et votre budget.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End About-->

<!--Start Portfolio-->
<section class="portfolio-page pad-tb">
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-lg-6">
                <div class="common-heading pp">
                    <span>Nos derniers projets</span>
                    <h2>Nos Références</h2>
                </div>
            </div>
            <div class="col-lg-6 v-center">
                <div class="filters">
                    <ul class="filter-menu">
                        <li data-filter="*" class="is-checked">Tous</li>
                        <li data-filter=".website">Site Web</li>
                        <li data-filter=".app">Applications</li>
                        <li data-filter=".graphic">Graphisme</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row card-list">
            <div class="col-lg-4 col-md-6 grid-sizer"></div>
            <div class="col-lg-4 col-sm-6 single-card-item app">
                <div class="isotope_item hover-scale">
                    <div class="item-image">
                        <a href="#"><img src="assets/uploads/images/app-img1.jpg" alt="portfolio" class="img-fluid" /> </a>
                    </div>
                    <div class="item-info">
                        <h4><a href="#">Application Android</a></h4>
                        <p>Android, design</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 single-card-item graphic">
                <div class="isotope_item hover-scale">
                    <div class="item-image">
                        <a href="#"><img src="assets/uploads/images/app-img2.jpg" alt="image" class="img-fluid" /> </a>
                    </div>
                    <div class="item-info">
                        <h4><a href="#">Conception Brochure</a></h4>
                        <p>Graphisme, Impression</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 single-card-item website">
                <div class="isotope_item hover-scale">
                    <div class="item-image">
                        <a href="#"><img src="assets/uploads/images/app-img3.jpg" alt="image" class="img-fluid" /> </a>
                    </div>
                    <div class="item-info">
                        <h4><a href="#">Site E-commerce</a></h4>
                        <p>Création de site E-commerce</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="-cta-btn mt70">
        <div class="free-cta-title v-center wow zoomInDown" data-wow-delay=".9s">
            <p>Découvrez plus de <span>références</span></p>
            <a href="#" class="btn-main bg-btn2 lnk">Voir maintenant<i class="fas fa-chevron-right fa-icon"></i><span class="circle"></span></a>
        </div>
    </div>
</section>
<!--End Portfolio-->

<!--Start Clients-->
<section class="clients-section pad-tb">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="common-heading">
                    <span>Ils nous font confiance</span>
                    <h2>Nos partenaires</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="opl">
                    <ul>
                        <li class=" wow fadeIn" data-wow-delay=".2s">
                            <div class="clients-logo"><img src="assets/uploads/images/clients/reviewer-a.png" alt="text" class="img-fluid" /></div>
                        </li>
                        <li class=" wow fadeIn" data-wow-delay=".4s">
                            <div class="clients-logo"><img src="assets/uploads/images/clients/reviewer-a.png" alt="text" class="img-fluid" /></div>
                        </li>
                        <li class=" wow fadeIn" data-wow-delay=".6s">
                            <div class="clients-logo"><img src="assets/uploads/images/clients/reviewer-a.png" alt="text" class="img-fluid" /></div>
                        </li>
                        <li class=" wow fadeIn" data-wow-delay=".8s">
                            <div class="clients-logo"><img src="assets/uploads/images/clients/reviewer-a.png" alt="text" class="img-fluid" /></div>
                        </li>
                        <li class=" wow fadeIn" data-wow-delay=".10s">
                            <div class="clients-logo"><img src="assets/uploads/images/clients/reviewer-a.png" alt="text" class="img-fluid" /></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="-cta-btn mt70">
            <div class="free-cta-title v-center wow zoomInDown" data-wow-delay="1.2s">
                <p>On <span>promet.</span> Nous <span>livrons. </span></p>
                <a href="#" class="btn-main bg-btn2 lnk">Travaillons ensemble<i class="fas fa-chevron-right fa-icon"></i><span class="circle"></span></a>
            </div>
        </div>
    </div>
</section>
<!--End Clients-->



<!--Start Enquire Form-->
<section class="enquire-form pad-tb">
    <div class="container">
        <div class="row light-bgs">
            <div class="col-lg-6">
                <div class="common-heading text-l">
                    <span>Vous avez des questions?</span>
                    <h2 class="mt0">CONTACTEZ NOUS</h2>
                </div>
                <div class="form-block">
                    <form action="#" method="post" name="feedback-form">
                        <div class="fieldsets row">
                            <div class="col-md-6"><input type="text" placeholder="Nom & Prénom" name="name" required></div>
                            <div class="col-md-6"><input type="email" placeholder="Email" name="email" required></div>
                        </div>
                        <div class="fieldsets row">
                            <div class="col-md-6"><input type="number" placeholder="Téléphone" name="phone" required></div>
                            <div class="col-md-6"><input type="text" placeholder="Sujet" name="subject" required></div>
                        </div>
                        <div class="fieldsets"><textarea placeholder="Message" name="message"></textarea></div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck" name="example1" checked="checked">
                            <label class="custom-control-label" for="customCheck">J'accepte <a href="javascript:void(0)"> les termes et conditions</a> du nom commercial.</label>
                        </div>
                        <div class="fieldsets mt20"> <button type="submit" name="submit" class="lnk btn-main bg-btn">Envoyer <i class="fas fa-chevron-right fa-icon"></i><span class="circle"></span></button> </div>
                        <p class="trm"><i class="fas fa-lock"></i>Nous détestons le spam et respectons votre vie privée.</p>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 v-center">
                <div class="enquire-image">
                    <img src="assets/uploads/about/about-image.png" alt="enquire" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Enquire Form-->



<?php
require_once('inc/footer.php');
?>