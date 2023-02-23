<?php
session_start();
require_once __DIR__."/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>

<title>Contact Us|<?=$_ENV['APP_NAME'];?></title>
  <?php require_once __DIR__."/inc/head.php";?>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  

</head>

<body id="body" class="body-wrapper static">
  <div class="se-pre-con"></div>
  <div class="main-wrapper">
    <!-- HEADER -->
    <?php require_once __DIR__."/inc/header.php";?>

<!-- PAGE TITLE SECTION -->
    <section class="clearfix pageTitleArea" style="background-image: url(img/blog/pageTitle-bg02.jpg);">
        <div class="container">
	        <div class="pageTitle">
	            <h1>Contact Us</h1>
	        </div>
        </div>
    </section>


<!-- CONTACT US SECTION -->
    <section class="clearfix contactSection padding">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-7 col-xl-8">
            <div class="contactTitle">
              <h3>Get in touch</h3>
            </div>

            <div class="contactForm">
              <div id="alert"></div><!--Response Holder-->
              <form  id="ContactForm" method="post">
              <div class="form-group">
                  <input type="text" name="name" id="name" class="form-control" placeholder="Your Name">
                </div>
                <div class="form-group">
                  <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" >
                </div>
               <div class="form-group">
                  <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Mobile" >
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" id="message" placeholder="Your Message"></textarea>
                </div>
                <div class="form-group">
                  <button type="submit" id="contact-submit-btn" class="btn btn-primary first-btn">send Message</button>

                </div>
              </form>
            </div>
          </div>

          <div class="col-md-6 col-lg-5 col-xl-4">
            <div class="holdingInfo patternbg">
              <p>Feel Free to Visit, Call, WhatsApp and Email us.</p>
              <ul>
                <li><i class="fa fa-map-marker" aria-hidden="true"></i> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatem deserunt animi iusto assumenda ipsam!</li>
                <li><i class="fa fa-phone" aria-hidden="true"></i> <?=$_ENV['APP_PHONE'];?><br></li>
                <li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="<?=$_ENV['APP_EMAIL'];?>"><?=$_ENV['APP_EMAIL'];?></a> </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>


<!-- MAP SECTION -->
    <section class="clearfix mapSection">
      <div class="mapArea">
        <div id="map"></div>
      </div>
    </section>


    <!-- FOOTER -->
    <?php require_once __DIR__."/inc/footer.php";?>
   
  </div>


  <!-- JAVASCRIPTS -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/mailchimp.js"></script>
  
  <?php require_once __DIR__."/ajax/contact.php";?>
  
  
  
  
  
  
  <script src="plugins/lazyestload/lazyestload.js"></script>
  
  
  <script src="plugins/smoothscroll/SmoothScroll.js"></script>
  <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyDU79W1lu5f6PIiuMqNfT1C6M0e_lq1ECY'></script>
  <script src='js/google-map.js'></script>
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
