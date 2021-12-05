<?php
require_once('inc/header.php')
?>
<?php
$statement = $pdo->prepare("SELECT * FROM settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    /* Page Home Start */
    $header_title            = $row['header_title'];
    $header_subtitle         = $row['header_subtitle'];
    $header_description      = $row['header_description'];
    $header_image            = $row['header_image'];
    $header_nameButton       = $row['header_nameButton'];
    $header_buttonUrl        = $row['header_buttonUrl'];
    $header_status           = $row['header_status'];
    $service_title           = $row['service_title'];
    $service_subtitle        = $row['service_subtitle'];
    $service_status          = $row['service_status'];
    $about_title             = $row['about_title'];
    $about_subtitle          = $row['about_subtitle'];
    $about_description       = $row['about_description'];
    $about_shortDescription  = $row['about_shortDescription'];
    $about_image             = $row['about_image'];
    $about_status            = $row['about_status'];
    $references_title        = $row['references_title'];
    $references_subtitle     = $row['references_subtitle'];
    $references_nameButton   = $row['references_nameButton'];
    $references_buttonUrl    = $row['references_buttonUrl'];
    $references_shortLine    = $row['references_shortLine'];
    $references_status       = $row['references_status'];
    $partner_title           = $row['partner_title'];
    $partner_subtitle        = $row['partner_subtitle'];
    $partner_nameButton      = $row['partner_nameButton'];
    $partner_buttonUrl       = $row['partner_buttonUrl'];
    $partner_shortLine       = $row['partner_shortLine'];
    $partner_status          = $row['partner_status'];
    $contact_title           = $row['contact_title'];
    $contact_subtitle        = $row['contact_subtitle'];
    $contact_status          = $row['contact_status'];
    /* End Page Home */
}
?>
<!--Start Hero-->
<?php if ($header_status == 1): ?>
<section class="hero-section hero-bg-bg1">
    <div class="text-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 v-center">
                    <div class="header-heading">
                        <?php if($header_subtitle != ''): ?>
                        <span class="mb-1"><?php echo $header_subtitle; ?></span>
                        <?php endif; ?>
                        <h1 class="wow fadeInUp" data-wow-delay=".2s"><?php echo $header_title; ?></h1>
                        <p class="wow fadeInUp" data-wow-delay=".4s"><?php echo $header_description; ?></p>
                        <?php if ($header_nameButton != ''): ?>
                        <a href="<?php echo $header_buttonUrl != '' ? $header_buttonUrl : '#'; ?>" class="btn-main bg-btn lnk wow fadeInUp" data-wow-delay=".6s"><?php echo $header_nameButton; ?> <i class="fas fa-chevron-right fa-icon"></i><span class="circle"></span></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6 v-center">
                    <div class="single-image wow fadeIn" data-wow-delay=".5s">
                        <img src="<?php echo BASE_URL ?>assets/uploads/accueil/<?php echo $header_image; ?>" alt="Image Header Handcomm" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!--End Hero-->
<!--Start Service-->
<?php if($service_status == 1): ?>
<section class="service-section web-servic pad-tb mb-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="common-heading">
                    <span><?php echo $service_subtitle ?></span>
                    <h2 class="mb30"><?php echo $service_title; ?></h2>
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
<?php endif; ?>
<!--End Service-->

<!--Start About-->
<?php if($about_status == 1): ?>
<section class="about-agency">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 v-center">
                <div class="image-block">
                    <?php if($about_image != '' && $about_image != 'defualt-accueil.jpg'): ?>
                        <img src="<?php echo  BASE_URL ?>assets/uploads/accueil/<?php echo $about_image; ?>" alt="Photo About us Handcomm" class="img-fluid no-shadow" />
                    <?php else: ?>
                        <img src="<?php echo  BASE_URL ?>assets/uploads/images/about.jpg" alt="About us Handcomm" class="img-fluid no-shadow" />
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="common-heading text-l">
                    <span><?php echo $about_subtitle; ?></span>
                    <h2><?php echo $about_title; ?></h2>
                    <p><?php echo $about_description; ?></p>
                    <?php if($about_shortDescription != ''): ?>
                    <p class="quote"><?php echo $about_shortDescription; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!--End About-->

<!--Start Portfolio-->
<?php if ($references_status == 1):?>
<section class="portfolio-page pad-tb">
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-lg-6">
                <div class="common-heading pp">
                    <span><?php echo $references_subtitle ?></span>
                    <h2><?php echo $references_title; ?></h2>
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
            <p><?php echo $references_shortLine; ?></p>
            <?php if($references_nameButton != ''): ?>
            <a href="<?php echo $references_buttonUrl != '' ? $references_buttonUrl : '#'; ?>" class="btn-main bg-btn2 lnk"><?php echo $references_nameButton; ?> <i class="fas fa-chevron-right fa-icon"></i><span class="circle"></span></a>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!--End Portfolio-->

<!--Start Clients-->
<?php if($partner_status == 1): ?>
<section class="clients-section pad-tb">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="common-heading">
                    <span><?php echo $partner_subtitle; ?></span>
                    <h2><?php echo $partner_title; ?></h2>
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
                <p><?php echo $partner_shortLine; ?></p>
                <?php if ($partner_nameButton != ''): ?>
                <a href="<?php $partner_buttonUrl != '' ? $partner_buttonUrl : '#'; ?>" class="btn-main bg-btn2 lnk"><?php echo $partner_nameButton; ?> <i class="fas fa-chevron-right fa-icon"></i><span class="circle"></span></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!--End Clients-->



<!--Start Enquire Form-->
<?php if($contact_status == 1): ?>
<section class="enquire-form pad-tb">
    <div class="container">
        <div class="row light-bgs">
            <div class="col-lg-6">
                <div class="common-heading text-l">
                    <span><?php echo $contact_subtitle; ?></span>
                    <h2 class="mt0"><?php echo $contact_title; ?></h2>
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
<?php endif; ?>
<!--End Enquire Form-->



<?php
require_once('inc/footer.php');
?>