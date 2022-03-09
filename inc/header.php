<?php
ob_start();
session_start();
include("administrateur/config.php");
?>
<?php
$statement = $pdo->prepare("SELECT * FROM settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
	$logo = $row['logo'];
	$favicon = $row['favicon'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
	//Get URL Now
	$now_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

	if($now_page == 'article.php')
	{
		$statement = $pdo->prepare("SELECT * FROM news WHERE news_slug=?");
		$statement->execute(array($_REQUEST['slug']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) 
		{
		    $og_photo = $row['photo'];
		    $og_title = $row['news_title'];
		    $og_slug = $row['news_slug'];
			$og_description = substr(strip_tags($row['news_content']),0,200).'...';
			echo '<meta name="description" content="'.$row['meta_description'].'">';
			echo '<meta name="keywords" content="'.$row['meta_keyword'].'">';
			echo '<title>'.$row['meta_title'].'</title>';
		}
	}

	if($now_page == 'page.php')
	{
		$statement = $pdo->prepare("SELECT * FROM page WHERE page_slug=?");
		$statement->execute(array($_REQUEST['slug']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) 
		{
			echo '<meta name="description" content="'.$row['meta_description'].'">';
			echo '<meta name="keywords" content="'.$row['meta_keyword'].'">';
			echo '<title>'.$row['meta_title'].'</title>';
		}
	}

	if($now_page == 'category.php')
	{
		$statement = $pdo->prepare("SELECT * FROM categories WHERE category_slug=?");
		$statement->execute(array($_REQUEST['slug']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row)
		{
			echo '<meta name="description" content="'.$row['meta_description'].'">';
			echo '<meta name="keywords" content="'.$row['meta_keyword'].'">';
			echo '<title>'.$row['meta_title'].'</title>';
		}
	}

	if($now_page == 'index.php')
	{
		$statement = $pdo->prepare("SELECT * FROM settings WHERE id=1");
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) 
		{
			echo '<meta name="description" content="'.$row['meta_description'].'">';
			echo '<meta name="keywords" content="'.$row['meta_keyword'].'">';
			echo '<title>'.$row['meta_title'].'</title>';
		}
	}
	?>
	<link href="<?php echo BASE_URL; ?>assets/uploads/favicon/<?php echo $favicon; ?>" rel="icon" type="image/png">
    <!-- Style Website -->
    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/plugin.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/style.css" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>assets/css/responsive.css" rel="stylesheet">	
	<link href="<?php echo BASE_URL; ?>assets/css/darkmode.css" rel="stylesheet">	

    <?php if($now_page == 'article.php'): ?>
		<meta property="og:title" content="<?php echo $og_title; ?>">
		<meta property="og:type" content="website">
		<meta property="og:url" content="<?php echo BASE_URL; ?>article/<?php echo $og_slug; ?>">
		<meta property="og:description" content="<?php echo $og_description; ?>">
		<meta property="og:image" content="<?php echo BASE_URL; ?>assets/uploads/<?php echo $og_photo; ?>">
	<?php endif; ?>
</head>
<body>

    <!--Start Header -->
    <header class="header-pr nav-bg-w main-header navfix fixed-top menu-white">
        <div class="container-fluid m-pad">
            <div class="menu-header">
                <div class="dsk-logo"><a class="nav-brand" href="<?php echo BASE_URL; ?>">
                    <img src="<?php echo BASE_URL; ?>assets/uploads/logo/<?php echo $logo; ?>" alt="Logo" class="mega-darks-logo"/>
                <!--    <img src="<?php echo BASE_URL; ?>assets/uploads/logo/<?php echo $logo; ?>" alt="Logo" class="mega-white-logo"/>-->                    </a>
                </div>
                <div class="custom-nav" role="navigation">
					  <ul class="nav-list">
						 <li class="menu">
							<a href="<?php echo BASE_URL; ?>" class="menu-links">Accueil</a>
						 </li>
                            <?php
								$statement = $pdo->prepare("SELECT * FROM menu ORDER BY menu_order ASC");
								$statement->execute();
								$result = $statement->fetchAll(PDO::FETCH_ASSOC);			
								foreach ($result as $row) 
								{
                                    $clsval = 'menu';                                   
									if($row['menu_parent']==0)
									{
                                        $statement = $pdo->prepare("SELECT * FROM menu");
                                        $statement->execute();
                                        $result2 = $statement->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result2 as $row2) {
                                            if ($row['id'] == $row2['menu_parent']) {
                                                $clsval = 'sbmenu rpdropdown';
                                            }
                                        }
                                        echo '<li class="'.$clsval.'">';
										if($row['menu_type']=='Category')
										{
											echo '
											<a href="'.BASE_URL.'category/'.$row['category_or_page_slug'].'" class="menu-links">';
											echo $row['menu_name'];
											echo '</a>';
										}
										if($row['menu_type']=='Page')
										{
											echo '
											<a href="'.BASE_URL.'page/'.$row['category_or_page_slug'].'" class="menu-links">';
											echo $row['menu_name'];
											echo '</a>';
										}
										if($row['menu_type']=='Autre')
										{
											echo '<a href="'.$row['menu_url'].'" class="menu-links">';
											echo $row['menu_name'];
											echo '</a>';
										}
									}

                                    $statement1 = $pdo->prepare("SELECT * FROM menu WHERE menu_parent=?");
									$statement1->execute(array($row['id']));
									$total = $statement1->rowCount();
									if($total)
									{
										echo '<div class="nx-dropdown menu-dorpdown">';
										echo '<div class="sub-menu-section">';
										echo '<div class="sub-menu-center-block">';
                                        echo '<div class="sub-menu-column smfull">';
										$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);							
										foreach ($result1 as $row1) 
										{
											echo '<ul><li>';
											if($row1['menu_type']=='Category')
											{
												echo '<a href="'.BASE_URL.'category/'.$row1['category_or_page_slug'].'">';
											}
											if($row1['menu_type']=='Page')
											{
												echo '<a href="'.BASE_URL.'page/'.$row1['category_or_page_slug'].'">';
											}
											if($row1['menu_type']=='Autre')
											{
												echo '<a href="'.$row1['menu_url'].'">';
											}											
                                                echo $row1['menu_name'];
                                                echo '</a>';
											echo '</li></ul>';
										}
										echo '</div>';
                                        echo '</div>';
										echo '</div>';
										echo '</div>';
									}
									echo '</li>';
								}


                            ?>
						 
                         <li class="right-bddr"></li>
						<li>
                            <a href="<?php echo BASE_URL ?>contact" class="btn-br bg-btn3 btshad-b2 lnk">Devis en ligne <span class="circle"></span></a>
                        </li>
					  </ul>
				</div>
                <div class="mobile-menu2">
					  <ul class="mob-nav2">
						 <li>
                            <a href="javascript:void(0);" class="btn-round- btn-br bg-btn btshad-b1"  data-toggle="modal" data-target="#menu-popup">
                                <i class="fas fa-envelope-open-text"></i>
                            </a>
                        </li>
						 <li class="navm-">
                             <a class="toggle" href="javascript:void(0);"><span></span>
                        </a></li>
					  </ul>
				</div>
			</div>
            <!-- responsive -->
            <nav id="main-nav">
				   <ul class="first-nav">
                   <?php
                        $statement = $pdo->prepare("SELECT * FROM menu ORDER BY menu_order ASC");
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);			
                        foreach ($result as $row) 
                        {                                  
                            if($row['menu_parent']==0)
                            {
                                if($row['menu_type']=='Category')
                                {
                                    echo '<li class="">
                                    <a href="'.BASE_URL.'category/'.$row['category_or_page_slug'].'" class="menu-links">';
                                    echo $row['menu_name'];
                                    echo '</a>';
                                }
                                if($row['menu_type']=='Page')
                                {
                                    echo '<li class="">
                                    <a href="'.BASE_URL.'page/'.$row['category_or_page_slug'].'" class="menu-links">';
                                    echo $row['menu_name'];
                                    echo '</a>';
                                }
                                if($row['menu_type']=='Autre')
                                {
                                    echo '<li class=""><a href="'.$row['menu_url'].'" class="menu-links">';
                                    echo $row['menu_name'];
                                    echo '</a>';
                                }
                            }

                            $statement1 = $pdo->prepare("SELECT * FROM menu WHERE menu_parent=?");
                            $statement1->execute(array($row['id']));
                            $total = $statement1->rowCount();
                            if($total)
                            {
                                $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);							
                                foreach ($result1 as $row1) 
                                {
                                    echo '<ul><li>';
                                    if($row1['menu_type']=='Category')
                                    {
                                        echo '<a href="'.BASE_URL.'category/'.$row1['category_or_page_slug'].'">';
                                    }
                                    if($row1['menu_type']=='Page')
                                    {
                                        echo '<a href="'.BASE_URL.'page/'.$row1['category_or_page_slug'].'">';
                                    }
                                    if($row1['menu_type']=='Autre')
                                    {
                                        echo '<a href="'.$row1['menu_url'].'">';
                                    }											
                                        echo $row1['menu_name'];
                                        echo '</a>';
                                    echo '</li></ul>';
                                }
                            }
                            echo '</li>';
                        }


                    ?>					  
				   </ul>
				   <ul class="bottom-nav">
                        <?php
                            $statement = $pdo->prepare("SELECT * FROM social");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);							
                            foreach ($result as $row) 
                            {
                                if($row['social_url']!='' && $row['social_url'] != '#')
                                {
                                    echo '<li class="prb"><a target="_blank" href="'.$row['social_url'].'"><i class="'.$row['social_icon'].'"></i></a></li>';
                                }
                            }
						?>
				   </ul>
				</nav>
		</div>
	</header>
    
