<?php
session_start();
require_once __DIR__."/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>About Us|<?=$_ENV['APP_NAME'];?></title>
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
    <section class="clearfix pageTitleArea" style="background-image: url(img/blog/pageTitle-bg.jpg);">
        <div class="container">
	        <div class="pageTitle">
	            <h1>About Us</h1>
	        </div>
        </div>
    </section>


<!-- ABOUT SECTION -->
    <section class="container-fluid clearfix aboutSection patternbg" >
      <div class="aboutInner">
        <div class="sepcialContainer">
          <div class="row">
            <div class="col-sm-6 col-xs-12 rightPadding">
              <div class="imagebox ">
                <img class="img-responsive lazyestload" data-src="img/home/home-about.jpg" src="img/home/home-about.jpg" alt="Image About">
              </div>
            </div>
            <div class="col-sm-6 col-xs-12">
              <div class="aboutInfo">
                <h2><?=$_ENV['APP_NAME'];?></h2>
             <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque accusamus itaque repudiandae aliquam sed praesentium adipisci sequi eos ea excepturi facilis et aspernatur modi natus ex, expedita dignissimos rerum commodi placeat veniam possimus libero? Autem dolorum architecto quam laboriosam! Accusamus officiis nobis mollitia, incidunt ipsa esse necessitatibus cum distinctio autem quaerat recusandae animi quidem omnis inventore repellendus vero blanditiis nihil nam asperiores atque eius. Culpa debitis illo architecto quod voluptatum? Ducimus nemo alias, ut est, error nisi iste eos ex numquam excepturi optio tempora inventore accusamus quos? Cupiditate dolores, voluptas minus ab perferendis quasi dolor rerum! Nisi dolore voluptatibus error pariatur, a atque culpa id, officiis quis alias ullam maiores. Ut, laudantium ratione atque, nesciunt velit eaque veritatis commodi eius quod reprehenderit beatae voluptatem sapiente quam necessitatibus nihil? Quam dicta eum quo at quos necessitatibus natus est cupiditate neque consequuntur? Eveniet cum earum fuga! Aspernatur sunt culpa enim molestias voluptatum at sint nisi eveniet suscipit asperiores iste aliquid libero voluptatem omnis vel unde, accusantium ab. Error, praesentium fugiat. Ex molestiae quas similique maxime debitis deserunt cum pariatur, ea magni reprehenderit iste, sunt tempora voluptas natus quisquam aliquid sequi, recusandae eaque? Minus vel ullam laborum omnis dolor. Sapiente libero aut vitae.</p>
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

  <script src='plugins/selectbox/jquery.selectbox-0.1.3.min.js'></script>
  <script src='plugins/owl-carousel/owl.carousel.min.js'></script>
  
  <script src="js/mailchimp.js"></script>
  
  
  <script src='plugins/datepicker/bootstrap-datepicker.min.js'></script>
  
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

