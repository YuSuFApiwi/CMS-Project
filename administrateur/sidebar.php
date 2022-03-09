<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex bg-white align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-logo mx-3">
            <img class="" src='images/logo.png' width="100%" height="70px" alt="" />
        </div>
    </a>

    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tableau de bord</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsepage"
            aria-expanded="true" aria-controls="collapsepage">
            <i class="fas fa-fw fa-photo-video"></i>
            <span>Pages</span>
        </a>
        <div id="collapsepage" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white collapse-inner rounded">
                <a class="collapse-item" href="page.php">Liste des pages</a>
                <a class="collapse-item" href="page-add.php">Créer une page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsemenu"
            aria-expanded="true" aria-controls="collapsemenu">
            <i class="fas fa-fw fa-bars"></i>
            <span>Menus</span>
        </a>
        <div id="collapsemenu" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="menu.php"> Liste des menus</a>
                <a class="collapse-item" href="menu-add.php">Créer un menu</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsenews"
                aria-expanded="true" aria-controls="collapsenews">
                <i class="fas fa-fw fa-paste"></i>
                <span>Blog</span>
            </a>
            <div id="collapsenews" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="category.php">Catégories</a>
                    <a class="collapse-item" href="news.php">Liste des articles</a>
                    <a class="collapse-item" href="news-add.php">Créer un article</a>
                </div>
            </div>
    </li>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseservice"
                aria-expanded="true" aria-controls="collapseservice">
                <i class="fas fa-fw fa-pause"></i>
                <span>Services</span>
            </a>
            <div id="collapseservice" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="service.php">Liste des services</a>
                    <a class="collapse-item" href="service-add.php">Créer un service</a>
                </div>
            </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- setting & social  -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="social.php">
            <i class="fas fa-hashtag"></i>         
            <span>Liens de réseaux sociaux</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="parametre.php">
          <i class="fas fa-fw fa-cog"></i>
         <span>Paramétres</span>
        </a>
   </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->