<?php
ob_start();
session_start();
include("config.php");
$error_message='';

if (isset($_SESSION["utilisateur"])) {
    header('location: index.php');
    exit;
}

if(isset($_POST['form1'])) {
    if(empty($_POST['email']) || empty($_POST['password'])) {
        $error_message = "L'email et/ou le mot de passe ne peuvent pas être vides<br>";
    } else {

        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);

        $statement = $pdo->prepare("SELECT * FROM utilisateur WHERE email=? AND status=?");
        $statement->execute(array($email,'1'));
        $total = $statement->rowCount();    
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if($total==0) {
            $error_message = "L'adresse de messagerie ne correspond pas<br>";
        } else {       
            foreach($result as $row) { 
                $row_password = $row['password'];
            }
        
            if( $row_password != md5($password) ) {
                $error_message = 'Le mot de passe ne correspond pas<br>';
            } else {
                $_SESSION['utilisateur'] = $row;
                header("location: index.php");
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8"/>
  <title>Login Administrateur</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--plugin-css-->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!-- template-style-->
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
      <!--Start login Form-->
  <section class="pad-tb">
    <div class="v-center m-auto">
      <a href="#" class="d-block text-center mb30"><img src="images/logo.png" alt="Logo" class="mega-darks-logo"></a>
      <div class="login-form-div">        
        <h4 class="mb40 text-center">Connectez-vous à votre compte</h4>
        <div class="form-block">
        <?php 
        if( (isset($error_message)) && ($error_message!='') ):
            echo '<div class="blockquote text-danger text-sm-left">'.$error_message.'</div><hr>';
        endif;
        ?>
          <form id="contact-form" action="" method="post">
            <div class="fieldsets row">
              <div class="col-md-12 form-group">
                <input id="form_name" type="text" name="email" placeholder="e-mail" required="required">
              </div>
              <div class="col-md-12 form-group">
                  <input  type="password"  placeholder="Mot de passe" name="password" required="required">
              </div>
            </div>
            <div class="fieldsets row mt20">
              <div class="col-md-6 form-group v-center">
                <button type="submit" name="form1" class="lnk btn-main bg-btn">Connexion <span class="circle"></span> </button>
              </div>
              <div class="col-md-6 form-group v-center text-right">
                  <a href="#" class="psforgt">Mot de passe oublié?</a>
              </div>
            </div>            
          </form>
        </div>
      </div>      
      </div>      
    </section>
    <!--End login Form-->
</body>