<?php
session_start();
require_once __DIR__ . "/inc/token_generate.php";
require_once __DIR__."/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Forgot Password|<?=$_ENV['APP_NAME'];?></title>
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
              <div class="panel-heading patternbg">Forgot <span>Password</span></div>
              <div class="panel-body">
              <p>Enter the email associated with your account and we'll send an email with instructions to reset your password</p>
              <p style="color:#ec5598;" id="reset-msg"></p>
                 <form id="forgot-password-form" method="POST">
                  <div class="form-group">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" autocomplete="off">
                  </div>

                 
                  <a href="./">Login Here.</a>
                  <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                   <button type="submit" class="btn btn-primary btn-block" id="forgot-password-btn">Reset Password</button>
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

  <?php require_once __DIR__."/ajax/forgot-password.php";?>  
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
