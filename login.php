<?php
session_start();
require_once __DIR__ . "/inc/token_generate.php";
require_once __DIR__."/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login|<?=$_ENV['APP_NAME'];?></title>
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
              <div class="panel-heading patternbg">log in your <span>account</span></div>
              <div class="panel-body">
              <p style="color:#ec5598;" id="login-msg"></p>
                 <form id="login-form" method="POST">
                  <div class="form-group">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off">
                  </div>

                  <div class="form-group">
                     <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
                  </div>

                  <!-- <div class="checkbox form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck0">
                    <label class="form-check-label" for="defaultCheck0">
                      Remember me
                    </label>
                  </div> -->
                  <a href="forgot-password">Forgot password?</a>
                  <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                  <input type="hidden" id="order" name="order" value="<?=$_GET['order']??"";?>">
                  <button type="submit" class="btn btn-primary btn-block" id="login" name="login">Log In</button>
                </form>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-5 col-xl-4">
            <div class="panel panel-default formPart">
              <div class="panel-heading patternbg">Create an <span>account</span></div>
              <div class="panel-body">
              <p style="color:#ec5598;" id="register-msg"></p>
                <form id="register-form">
                  <div class="form-group">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name"  autocomplete="off">
                  </div>

                  <div class="form-group">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off">
                  </div>

                  <div class="form-group">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="+2348168737623" autocomplete="off">
                  </div>

                  <div class="form-group">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
                  </div>
                  <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                   <button type="submit" id="register" name="register" class="btn btn-primary btn-block">Sign UP</button>
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

  <?php require_once __DIR__."/ajax/login.php";?>
  <?php require_once __DIR__."/ajax/register.php";?>
  
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
