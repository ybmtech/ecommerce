<?php
session_start();
 require_once "config.php";
require_once __DIR__ . "/inc/token_generate.php";
use Spatie\UrlSigner\MD5UrlSigner;
//initialize verify temporary sign url
$urlSigner = new MD5UrlSigner('julieclinics');
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$verifyUrl = $urlSigner->validate($url);
if ($verifyUrl == false) {
    echo "<script>alert('Wrong link or expired link, click on forgot password again');window.location.href='login';</script>";
    exit();
} else {
    $table = 'password_resets';
    $query = $dbquery->row_with_one_parameter($table, 'token', $_GET['hash']);

    if ($query == false) {
        echo "<script>alert('This password reset token is invalid.');window.location.href='login';</script>";
        exit();
    }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Reset Password|<?=$_ENV['APP_NAME'];?></title>
  <?php require_once __DIR__."/inc/head.php";?>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>
    .error{
        color:#ec5598;
    }
    </style>
  

</head>

<body id="body" class="body-wrapper static">
  <div class="se-pre-con"></div>
  <div class="main-wrapper">
    <!-- HEADER -->
    <?php require_once __DIR__."/inc/header.php";?>
<!-- FORM AREA SECTION -->
    <section class="clearfix formArea">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
            <div class="panel panel-default formPart">
              <div class="panel-heading patternbg">Reset <span>Password</span></div>
              <div class="panel-body">
              <p style="color:#ec5598;" id="reset-msg"></p>
                 <form id="reset-password-form" method="POST">
                  <div class="form-group">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" class="form-control"  id="password" name="password" type="password" placeholder="Enter New Password" autocomplete="off">
                  </div>

                  <div class="form-group">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" class="form-control"  id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm Password"  autocomplete="off">
                  </div>

                  <a href="login">Login Here.</a>
                  <input type="hidden" name="hash" id="hash" value="<?= $_GET['hash']; ?>">
                  <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                   <button type="submit" class="btn btn-primary btn-block" id="reset-password" name="reset-password">Reset</button>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>


    <!-- FOOTER -->
    <?php require_once __DIR__."/inc/footer.php";?>
   
  </div>


  <!-- JAVASCRIPTS -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <?php require_once __DIR__."/ajax/reset-password.php";?>  
  <script src="js/mailchimp.js"></script>
  <script src="plugins/lazyestload/lazyestload.js"></script>
  
  
  <script src="plugins/smoothscroll/SmoothScroll.js"></script>
  
  
  <script src="js/custom.js"></script>

  <script>
  	//paste this code under head tag or in a seperate js file.
  	// Wait for window load
  	$(window).load(function() {
  		// Animate loader off screen
  		$(".se-pre-con").fadeOut("slow");
  	});
  </script>

</body>

</html>
