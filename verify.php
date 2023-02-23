<?php
require_once __DIR__ . "/inc/session.php";
if(!empty($info['is_verify'])){
    echo "<script>window.location.href='./';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Verify Account|<?=$_ENV['APP_NAME'];?></title>
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
   <style>
        .loader {
            display: none;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
            margin-left: 15%;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
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
        <div class="auth-card">
            <div class="loader"></div>
            <div class="verify-password-card">
                <p class="msg" style="color:#ec5598;text-align: center;"></p>
                <h1>Verify your Email</h1>
                <h6>we’ve sent a link to your email address <span><?= $info['email']; ?></span></h6>
                <p>Didnt receive an email? <a href="#" id="resend-mail" data-email="<?= $info['email']; ?>" class="pointer underline">Resend</a></p>
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
  <script src="js/mailchimp.js"></script>
  <script>
        $(document).ready(function() {
            $("#resend-mail").on('click', function() {
                var email = $(this).data('email');
                $.ajax({
                    url: "validate/resend-email",
                    method: "POST",
                    data: {
                        "email": email
                    },
                    beforeSend: function() {
                        $(".loader").show();
                    },
                    success: function(data) {
                        $(".msg").html("Mail has been sent to your mail, check your mail and click on verify");
                        $(".loader").hide();

                    }
                })

            });
        });
    </script>
  
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
