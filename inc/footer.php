<?php
$statement = $pdo->prepare("SELECT * FROM settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    //$logo = $row['logo'];
    $footer_about     = $row['footer_about'];
    $footer_copyright = $row['footer_copyright'];
    $contact_address  = $row['contact_address'];
    $contact_email    = $row['contact_email'];
    $contact_phone    = $row['contact_phone'];
    $contact_fax      = $row['contact_fax'];
}
?>
<!--Start Footer-->
<footer>
    <div class="footer-row1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="email-subs">
                        <h3>ABONNEMENT AU NEWSLETTER</h3>
                        <p>N'hésitez pas à vous inscrire à notre newsletter. Tous les mois, vous recevrez les activités et publications, mais également des conseils</p>
                    </div>
                </div>
                <div class="col-lg-6 v-center">
                    <div class="email-subs-form">
                        <form action="" method="GET">
                            <input type="email" placeholder="Entrez votre adresse Email" name="emails" required>
                            <button type="submit" name="submit" class="lnk btn-main bg-btn">S'abonner <i class="fas fa-chevron-right fa-icon"></i><span class="circle"></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-row2">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-3 col-sm-6  ftr-brand-pp">
                    <a class="navbar-brand mt30 mb25" href="#"> <img src="<?php echo BASE_URL ?>assets/uploads/logo/<?php echo $logo ?>" alt="Logo" width="100" /></a>
                    <p><?php echo $footer_about ?></p>
                    <a href="contact.php" class="btn-main bg-btn3 lnk mt20">Devenir partenaire <i class="fas fa-chevron-right fa-icon"></i><span class="circle"></span></a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h5>Contactez nous</h5>
                    <ul class="footer-address-list ftr-details">
                        <li>
                            <span><i class="fas fa-envelope"></i></span>
                            <p>Email <span> <a href="emilto:<?php echo $contact_email; ?>"><span class="__cf_email__"><?php echo $contact_email; ?></span></a></span></p>
                        </li>
                        <li>
                            <span><i class="fas fa-phone-alt"></i></span>
                            <p>Téléphone
                                <span>
                                    <a href="tel:<?php echo $contact_phone ?>" class="ml-1"><?php echo $contact_phone ?></a> / <a href="tel:<?php echo $contact_fax ?>" class="mr-1"><?php echo $contact_fax ?></a>
                                </span>
                            </p>
                        </li>
                        <li>
                            <span><i class="fas fa-map-marker-alt"></i></span>
                            <p>Adresse <span class="text-capitalize"> <?php echo $contact_address ?> </span></p>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <h5>Informations</h5>
                    <ul class="footer-address-list link-hover">
                        <?php
                        $i = 0;
                        $statement = $pdo->prepare("SELECT * FROM page where status = 'active' limit 4");
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            $i++;
                        ?>
                            <li>
                                <a href="<?php echo BASE_URL ?>page/<?php echo $row['page_slug']; ?>"><?php echo $row['page_name']; ?></a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-lg-4 col-sm-6 footer-blog-">
                    <h5>Derniers articles</h5>
                    <?php
                    $i = 0;
                    $statement = $pdo->prepare("SELECT * FROM news ORDER BY id DESC limit 4");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        $i++;
                    ?>
                        <div class="single-blog-">
                            <div class="post-thumb">
                                <a href="<?php echo BASE_URL; ?>news/<?php echo $row['news_slug']; ?>">
                                    <img src="<?php echo BASE_URL; ?>assets/uploads/news/<?php echo $row['photo'] ?>" alt="blog">
                                </a>
                            </div>
                            <div class="content">
                                <p class="post-meta"><span class="post-date"><i class="far fa-clock"></i><?php echo $row['news_date'] ?></span></p>
                                <h4 class="title">
                                    <a href="<?php echo BASE_URL; ?>news/<?php echo $row['news_slug']; ?>"><?php echo $row['news_title']; ?></a>
                                </h4>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-row3">
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="footer-social-media-icons col-md-12">
                        <?php
                            $statement = $pdo->prepare("SELECT * FROM social");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);							
                            foreach ($result as $row) 
                            {
                                if($row['social_url']!='' && $row['social_url'] != '#')
                                {
                                    echo '<a target="_blank" href="'.$row['social_url'].'"><i class="'.$row['social_icon'].'"></i></a>';
                                }
                            }
						?>
                    </div>
                    <div class="col-md-12">
                        <div class="footer-">
                            <p><?php echo $footer_copyright ?> <a href="<?php echo BASE_URL; ?>" target="blank">Hand'Comm</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--End Footer-->

<!-- js placed at the end of the document so the pages load faster -->
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="js/vendor/modernizr-3.5.0.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/jquery.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/plugin.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/preloader.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/dark-mode.js"></script>
<!--common script file-->
<script src="<?php echo BASE_URL ?>assets/js/main.js"></script>
</body>

</html>